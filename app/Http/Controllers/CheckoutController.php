<?php

namespace App\Http\Controllers;

use App\MyCart\Account;
use App\MyCart\Billers\CreditCardBiller;
use App\MyCart\MyCart;
use App\MyCart\Order;
use App\MyCart\Processors\OrderProcessor;
use App\MyCart\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * 顯示結帳頁面
     */
    public function index()
    {
        // 建立客戶 Account
        $account = Account::updateOrCreate(['id' => 1], ['name' => "梅宗主"]);
        $account->save();

        // 模擬加入購物車動作
        $cart = new MyCart();
        $cart->add(Product::updateOrCreate(['id' => 1], ['name' => '暖爐', 'price' => '4000']));
        $cart->add(Product::updateOrCreate(['id' => 2], ['name' => '護心丹', 'price' => '12000']));
        $cart->add(Product::updateOrCreate(['id' => 3], ['name' => '密道鐵門', 'price' => '8000']));

        return view('checkout', [
            'cart'    => $cart,
            'account' => $account,
        ]);
    }

    public function checkout(Request $request)
    {
        // 建立訂單
        $order = new Order();
        $order->setProducts($request->get('product_ids'));
        $order->setAccount($request->get('account_id'));

        // 處理訂單
        $orderProcessor = new OrderProcessor(new CreditCardBiller());
        $orderId = $orderProcessor->process($order);

        return
            "<h2>Done, 訂單 ID: " . $orderId . "</h2>" .
            "<h2>{$order->getAccount()->name}</h2>" .
            "<h2>{$order->getAmount()}</h2>";
    }
}
