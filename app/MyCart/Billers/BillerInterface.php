<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Billers;


interface BillerInterface
{
    public function bill($accountId, $amount);
}