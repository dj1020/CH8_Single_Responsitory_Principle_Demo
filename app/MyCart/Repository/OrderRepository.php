<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Repository;


use App\MyCart\Order;
use Carbon\Carbon;
use DB;

class OrderRepository
{
    public function getRecentOrderCount(Order $order)
    {
        $timestamps = Carbon::now()->subMinutes(2);

        return DB::table('orders')
            ->where('account', $order->getAccount()->id)
            ->where('created_at', '>=', $timestamps)
            ->count();
    }
}