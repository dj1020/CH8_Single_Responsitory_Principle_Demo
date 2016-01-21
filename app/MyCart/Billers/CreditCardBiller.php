<?php
/**
 * Author: twinkledj
 * Date: 1/21/16
 */

namespace App\MyCart\Billers;


use App\MyCart\Account;

class CreditCardBiller implements BillerInterface
{
    public function bill($accountId, $amount)
    {
        $account = Account::findOrFail($accountId);
        $reqAmount = intval($amount);

        echo "<h3>刷卡金額： $reqAmount, 刷卡人姓名：{$account->name}</h3>";
    }
}