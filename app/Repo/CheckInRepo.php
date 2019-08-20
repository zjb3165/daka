<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Goal;
use App\Models\Member;
use App\Models\MemberGoalRecord;
use App\Repo\Exceptions\RepoException;

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
        if ($goal == null) return null;
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
        
        //todo 重复打卡不计算积分和连续数量
        //todo 增加打卡积分
        //todo 连续打卡

        return $record;
    }
    
    /**
     * 查询当前时间段是否有打卡目标
     * @param App\Models\Member     $member
     * @param Integer               $hour
     */
    public function searchGoal(Member $member, $hour)
    {
        $records = $this->getTodayGoalRecords($member);
        $exists_goal_ids = $records->map(function($item){
            return $item->goal_id;
        })->toArray();
        
        return $this->getGoalByHour($hour, $exists_goal_ids);
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
     * @param App\Models\Goal       $goal   指定目标，默认为null;
     * @return Array
     */
    public function getTodayGoalRecords(Member $member, Goal $goal=null)
    {
        $date = date('Y-m-d');
        $cursor = MemberGoalRecord::where('member_id', $member->id);
        if ($goal != null) {
            $cursor->where('goal_id', $goal->id);
        }
        $cursor->where('picture', '<>', '')
                ->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59']);
        return $cursor->get();
    }

    /**
     * 读取打卡目标
     * @param integer $id
     * @return App\Models\Goal
     */
    public function getGoalById($id)
    {
        return Goal::where('id', $id)->first();
    }

    /**
     * 判断目标是否可以打卡
     * @param App\Models\Member         $member
     * @param App\Models\Goal           $goal
     * @param integer                   $hour
     * @param boolean
     */
    public function canCheckIn(Member $member, Goal $goal, $hour)
    {
        if ($goal->start_time >= $hour || $goal->end_time < $hour) return false;    //不在打卡时间内
        
        if ($goal->repeat) return true; //目标可重复打卡直接返回
        
        $records = $this->getTodayGoalRecords($member, $goal);
        if (count($records)) return false;  //今日已打卡
        
        return true;
    }

    /**
     * 是否在打卡时间内
     * @param App\Models\Goal       $goal
     * @param integer               $hour
     * @param boolean
     */
    public function inTime(Goal $goal, $hour)
    {
        if ($goal->start_time >= $hour || $goal->end_time < $hour) return true;
        return false;
    }

    /**
     * 判断目标是否已打过卡
     * @param App\Models\Member         $member
     * @param App\Models\Goal           $goal
     * @param integer                   $hour
     * @return boolean
     */
    public function checked(Member $member, Goal $goal, $hour)
    {
        $records = $this->getTodayGoalRecords($member, $goal);
        if (count($records)) return true;
        return false;
    }

    /**
     * 读取打卡目标列表
     */
    public function getGoalList()
    {
        return Goal::query()->orderBy('order_index', 'desc')->orderBy('id', 'asc')->get();
    }

    /**
     * 更新打卡目标
     * @param integer|\App\Models\Goal  $goal_or_id
     * @param array                     $datas
     * @return \App\Models\Goal
     */
    public function updateGoal($goal_or_id, $datas)
    {
        $goal = $goal_or_id;
        if (is_numeric($goal_or_id)) {
            $goal = Goal::find($goal_or_id);
        }
        if ($goal == null) {
            throw new RepoException('打卡目标不存在');
        }

        if (isset($datas['title']) && $datas['title'] != '') {
            $goal->title = $datas['title'];
        }
        $goal->fill($datas);
        $goal->save();

        return $goal;
    }
}