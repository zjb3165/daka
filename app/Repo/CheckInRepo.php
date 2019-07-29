<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Goal;
use App\Models\Member;
use App\Models\MemberGoalRecord;

/**
 * 打卡管理
 */
class CheckInRepo
{
    /**
     * 目标打卡
     * @param App\Models\Member     $member
     * @param App\Models\Goal       $goal
     * @param String                $picture
     */
    public function checkGoal(Member $member, Goal $goal, $picture)
    {
        $record = MemberGoalRecord::where('member_id', $member->id)
                ->where('goal_id', $goal->id)->first();
        if ($record == null) {
            $record = new MemberGoalRecord();
            $record->member_id = $member->id;
            $record->goal_id = $goal->id;
            $record->picture = $picture;
            $record->save();
        } else {
            $record->picture = $picture;
            $record->save();
        }

        return $record;
    }
    
    /**
     * 查询当前时间段是否有打卡目标
     * @param App\Models\Member     $member
     */
    public function searchGoal(Member $member)
    {
        $hour = intval(date('H'));

        $records = $this->getTodayGoalRecords($member);
        $exists_goal_ids = $records->map(function($item){
            return $item->goal_id;
        })->toArray();
        
        $goal = $this->getGoalByHour($hour, $exists_goal_ids);
        return $goal;
    }
    
    /**
     * 读取当前时段内可打卡目标
     * @param Integer   $hour
     * @param Array     $not_in_ids     不包含的id,默认空数组
     */
    public function getGoalByHour($hour, $not_in_ids=[])
    {
        $cursor = Goal::where('start_time', '>=', $hour)->where('end_time', '<', $hour);
        if (count($not_in_ids) > 0){
            $cursor->whereNotIn('id', $not_in_ids);
        }
        return $cursor->orderBy('order_index', 'desc')->orderBy('id', 'asc')->first();
    }
    
    /**
     * 读取用户今日的打卡记录
     * @param App\Models\Member     $member
     * @return Array
     */
    public function getTodayGoalRecords(Member $member)
    {
        $date = date('Y-m-d');
        return MemberGoalRecord::where('member_id', $member->id)->where('picture', '<>', '')
                ->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->get();
    }
}