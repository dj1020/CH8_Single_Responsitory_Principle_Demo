<?php

namespace App\Http\Controllers;

use App\MyCart\Account;
use App\MyCart\MyCart;
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
        $account->name = "閃亮亮";
        $account->save();

        // 模擬加入購物車動作
        $cart = new MyCart($account);
        $cart->add(Product::updateOrCreate(['id' => 1], ['name' => '藍芽耳機', 'price' => '4000']));
        $cart->add(Product::updateOrCreate(['id' => 2], ['name' => '釣竿', 'price' => '2000']));
        $cart->add(Product::updateOrCreate(['id' => 3], ['name' => 'MacBook', 'price' => '50000']));

        return view('checkout', [
            'cart'    => $cart,
            'account' => $account,
        ]);
    }
}
