<?php
/**
 * Created by PhpStorm.
 * User: stp
 * Date: 2018/12/23
 * Time: 15:28
 */

namespace addons\config\user\controller;


class Count extends \web\user\controller\AddonUserBase
{
    public function index()
    {
        $memM = new \addons\member\model\MemberAccountModel();
        $member_num = $memM->count();

        $gameM = new \addons\fomo\model\Game();
        $game_num = $gameM->count();

        $current_game_id = $gameM->where('status',1)->value('id');
        $rewardRecordM = new \addons\fomo\model\RewardRecord();
        $whole_award = $rewardRecordM->where(['game_id' => $current_game_id,'type' => 0])->sum('amount');
        $invite_award = $rewardRecordM->where(['game_id' => $current_game_id,'type' => 3])->sum('amount');
        $last_winner_award = $rewardRecordM->where(['game_id' => $current_game_id, 'type' => 4])->sum('amount');
        $big_winner_award = $rewardRecordM->where(['game_id' => $current_game_id, 'type' => 5])->sum('amount');
        $pool_parent_award = $rewardRecordM->where(['game_id' => $current_game_id, 'type' => 6])->sum('amount');
        $node_award = $rewardRecordM->where(['game_id' => $current_game_id, 'type' => 7])->sum('amount');
        $mid_award = $rewardRecordM->where(['game_id' => $current_game_id, 'type' => 8])->sum('amount');
        $current_award = array(
            'whole' => $whole_award,
            'invite' => $invite_award,
            'last_winner' => $last_winner_award,
            'big_winner'  => $big_winner_award,
            'pool_parent' => $pool_parent_award,
            'node'  => $node_award,
            'mid' => $mid_award
        );

        $total_whole_award = $rewardRecordM->where(['type' => 0])->sum('amount');
        $total_invite_award = $rewardRecordM->where(['type' => 3])->sum('amount');
        $total_last_winner_award = $rewardRecordM->where(['type' => 4])->sum('amount');
        $total_big_winner_award = $rewardRecordM->where(['type' => 5])->sum('amount');
        $total_pool_parent_award = $rewardRecordM->where(['type' => 6])->sum('amount');
        $total_node_award = $rewardRecordM->where(['type' => 7])->sum('amount');
        $total_mid_award = $rewardRecordM->where(['type' => 8])->sum('amount');
        $award = array(
            'whole' => $total_whole_award,
            'invite' => $total_invite_award,
            'last_winner' => $total_last_winner_award,
            'big_winner'  => $total_big_winner_award,
            'pool_parent' => $total_pool_parent_award,
            'node'  => $total_node_award,
            'mid' => $total_mid_award
        );

        $keyM = new \addons\fomo\model\KeyRecord();
        $current_key = $keyM->where(['game_id' => $current_game_id])->sum('key_num');
        $current_eops = $current_key * 10;

        $total_key = $keyM->sum('key_num');
        $total_eops = $total_key * 10;

        $tradingReord = new \addons\member\model\TradingRecord();
        $admin_eops = $tradingReord->where('type',6)->sum('amount');

        $balanceM = new \addons\member\model\Balance();
        $froze_amount = $balanceM->where(['coin_id' => 2,'type' => 1])->sum('amount');
        $froze_amount = round($froze_amount,2);
        $use_amount = $balanceM->where(['coin_id' => 2, 'type' => 2])->sum('amount');
        $use_amount = round($use_amount,2);

        $this->assign('member_num',$member_num);
        $this->assign('game_num',$game_num);
        $this->assign('current_award',$current_award);
        $this->assign('award',$award);
        $this->assign('current_eops',$current_eops);
        $this->assign('total_eops',$total_eops);
        $this->assign('admin_eops',$admin_eops);
        $this->assign('froze_amount',$froze_amount);
        $this->assign('use_amount',$use_amount);

        return $this->fetch();
    }
}





























