<?php
/**
 * Created by PhpStorm.
 * User: stp
 * Date: 2018/12/24
 * Time: 14:28
 */

namespace addons\eth\user\controller;


class Transfer extends \web\user\controller\AddonUserBase
{
    public function index(){
        $status = $this->_get('status');
        if($status == ''){
            $status = 0; //未确认
        }
        $this->assign('status',$status);
        return $this->fetch();
    }

    public function loadList(){
        $keyword = $this->_get('keyword');
        $status = $this->_get('status');
//        $type = $this->_get('type');
//        $status = 3;
        $filter = 'o.change_type='.$status;
//        if($type != ''){
//            $filter .= ' and o.type='.$type;
//        }
        if ($keyword != null) {
//            $filter .= ' and b.username like \'%' . $keyword . '%\'';
            $filter .= ' and m.username like \'%' . $keyword . '%\'';
        }
//        $m = new \addons\eth\model\EthTradingOrder();
        $m = new \addons\member\model\TradingRecord();
        $total = $m->getTotal2($filter);
        $rows = $m->getList2($this->getPageIndex(), $this->getPageSize(), $filter);

        $marketM = new \addons\financing\model\Market();
        $cny = $marketM->getDetailByCoinName('ETH','cny');
        $eth_rate = bcdiv($cny,7,4);
//        $sysM = new \web\common\model\sys\SysParameterModel();
//        $eth_rate = $sysM->getValByName('eth_rate');

        $count_total = $m->getCountTotal2($filter);
        return $this->toTotalDataGrid($total, $rows,$count_total);
//        print_r($rows);exit();
//        $count_total = $m->getCountTotal($filter);
//        return $this->toTotalDataGrid($total, $rows,23);
    }

}