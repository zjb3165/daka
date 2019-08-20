<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Goal;
use App\Models\Member;
use App\Models\MemberGoalRecord;
use App\Models\MemberRecordStat;
use App\Models\MemberCreditRecord;
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

        \DB::beginTransaction();
        try {
            if ($record == null) {
                $record = new MemberGoalRecord();
                $record->member_id = $member->id;
                $record->goal_id = $goal->id;
                $record->picture = $picture;
                $record->save();

                $this->updateRcordStat($member, $goal);
                $this->updateMemberCredits($member, $goal->credits);
            } else {
                $record->picture = $picture;
                $record->save();
            }
            \DB::commit();
        } catch(\Exception $e) {
            \Log::info('打卡失败');
            \Log::info($e);
            \DB::rollBack();
        }

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

    /**
     * 更新用户打卡记录
     */
    private function updateRecordStat(Member $member, Goal $goal)
    {
        $stat = MemberRecordStat::where('member_id', $member->id)
                    ->where('goal_id', $goal->id)->first();
        if ($stat == null) {
            $stat = new MemberRecordStat();
            $stat->member_id = $member->id;
            $stat->goal_id = $goal->id;
            $stat->total_count = 0;
            $stat->link_count = 0;
        }
        
        $stat->total_count++;
        
        $yestory = date('Y-m-d', strtotime('-1 day'));
        $yestory_record = MemberGoalRecord::where('member_id', $member->id)
                                ->where('goal_id', $goal->id)
                                ->whereBetween('created_at', [$yestory . ' 00:00:00', $yestory . ' 23:59:59'])
                                ->first();
        if ($yestory_record == null) {
            $stat->link_count = 1;
        } else {
            $stat->link_count++;
        }
        $stat->save();
    }

    /**
     * 更新用户积分
     */
    private function updateMemberCredits(Member $member, $credits)
    {
        $member->credits += $credits;
        $member->save();

        $record = new MemberCreditRecord();
        $record->member_id = $member->id;
        $record->credit = $credits;
        $record->type = MemberCreditRecord::TYPE_INC;
        $record->category = MemberCreditRecord::CATEGORY_CREDIT;
        $record->remark = '用户打卡积分';
        $record->save();
    }
}