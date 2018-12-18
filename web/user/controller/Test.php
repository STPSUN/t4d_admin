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
}