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
        if ($this->isDuplicateOrder($order)) {
            throw new Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->getAccount()->id, $order->getAmount());

        $id = $this->orders->logOrder($order);

        return $id;
    }

    /**
     * @param $recent
     * @return bool
     */
    private function isDuplicateOrder($order)
    {
        $recent = $this->orders->getRecentOrderCount($order);

        return $recent > 0;
    }
}