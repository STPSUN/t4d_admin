<?php
/**
 * Created by PhpStorm.
 * User: stp
 * Date: 2018/11/22
 * Time: 15:22
 */

namespace web\user\controller;
use addons\fomo\index\controller\Crontab;


class Test extends Base
{
    public function console()
    {
        $m = new Crontab();

        $m->excute();
    }

    public function updateBalance()
    {
        $memM = new \addons\member\model\MemberAccountModel();
        $data = $memM->alias('u')
            ->field('k.key_num,u.id')
            ->join('fomo_key_record k','u.id=k.user_id','right')
            ->where('u.is_frozen',0)
            ->select();

        $balanceM = new \addons\member\model\Balance();
        foreach ($data as $v)
        {
            $amount = $v['key_num'] * 10;
            $balanceM->save([
                'amount' => $amount,
            ],[
                'user_id' => $v['id'],
                'coin_id'   => 2,
                'type'      => 1,
            ]);
        }

        echo 11;
    }
}

























