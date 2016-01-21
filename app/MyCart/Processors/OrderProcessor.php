<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Processors;


use App\MyCart\Billers\BillerInterface;
use App\MyCart\Order;
use Carbon\Carbon;
use DB;
use Exception;

class OrderProcessor
{
    /**
     * OrderProcessor constructor.
     */
    public function __construct(BillerInterface $biller)
    {
        $this->biller = $biller;
    }

    public function process(Order $order)
    {
        echo "<h4>訂單處理中...</h4>";

        $recent = $this->getRecentOrderCount($order);

        if ($recent > 0) {
            throw new Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->getAccount()->id, $order->getAmount());

        $id = DB::table('orders')->insertGetId(array(
            'account'    => $order->getAccount()->id,
            'amount'     => $order->getAmount(),
            'created_at' => Carbon::now()
        ));

        return $id;
    }

    private function getRecentOrderCount(Order $order)
    {
        $timestamps = Carbon::now()->subMinutes(3);

        return DB::table('orders')
            ->where('account', $order->getAccount()->id)
            ->where('created_at', '>=', $timestamps)
            ->count();
    }
}