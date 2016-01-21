<?php

namespace App\MyCart;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $account;

    protected $productIds;
    protected $amount;

    public function setProducts($product_ids)
    {
        $this->productIds = $product_ids;
        $this->calculateAmount($this->productIds);
    }

    private function calculateAmount($productIds)
    {
        $this->amount = 0;
        foreach ($productIds as $id) {
            $this->amount += Product::findOrFail($id)->price;
        }

        return $this->amount;
    }

    public function setAccount($account_id)
    {
        $this->account = Account::findOrFail($account_id);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getAccount()
    {
        return $this->account;
    }
}
