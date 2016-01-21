<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Processors;


use App\MyCart\Billers\BillerInterface;
use App\MyCart\Order;
use App\MyCart\Repository\OrderRepository;
use Carbon\Carbon;
use DB;
use Exception;

class OrderProcessor
{
    protected $orders;

    /**
     * OrderProcessor constructor.
     */
    public function __construct(BillerInterface $biller, OrderRepository $orders)
    {
        $this->biller = $biller;
        $this->orders = $orders;
    }

    public function process(Order $order)
    {
        $recent = $this->orders->getRecentOrderCount($order);

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
}