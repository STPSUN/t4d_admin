<?php

/**
 * Created by PhpStorm.
 * User: stp
 * Date: 2018/12/18
 * Time: 16:45
 */
class Crontab extends \web\common\controller\Controller
{
    public function bonusRelease()
    {
        $m = new \addons\fomo\index\controller\Crontab();
        $m->excute();
    }
}