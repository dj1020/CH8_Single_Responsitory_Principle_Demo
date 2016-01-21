<?php

namespace App\Http\Controllers;

use App\MyCart\Account;
use App\MyCart\MyCart;
use App\MyCart\Order;
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
        $account = Account::findOrNew(1);
        $account->name = "梅宗主";
        $account->save();

        // 模擬加入購物車動作
        $cart = new MyCart($account);
        $cart->add(Product::updateOrCreate(['id' => 1], ['name' => '飛鴿', 'price' => '4000']));
        $cart->add(Product::updateOrCreate(['id' => 2], ['name' => '護心丹', 'price' => '12000']));
        $cart->add(Product::updateOrCreate(['id' => 3], ['name' => '密道鐵門', 'price' => '8000']));

        return view('checkout', [
            'cart'    => $cart,
            'account' => $account,
        ]);
    }

    public function checkout(Request $request)
    {
        return $request->all();
    }
}
