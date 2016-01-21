<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart;


class MyCart
{
    private $list;

    public function add($product)
    {
        $this->list[] = $product;
    }

    public function getList()
    {
        return $this->list;
    }
}