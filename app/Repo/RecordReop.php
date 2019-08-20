<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Repo;

use App\Models\Member;
use App\Models\Goal;
use App\Models\MemberGoalRecord;
use App\Models\MemberRecordStat;
use App\Repo\Exceptions\RepoException;

/**
 * 打卡记录操作
 */
class RecordRepo
{
    /**
     * @var \App\Repo\MemberRepo;
     */
    private $memberRepo;
    
    public function __construct(MemberRepo $repo)
    {
        $this->memberRepo = $repo;
    }

    /**
     * 读取打卡状态列表
     */
    public function getGoalStatList(Member $member)
    {
        return MemberRecordStat::where('member_id', $member->id)->get();
    }

    /**
     * 读取打卡状态
     * @param \App\Models\Member        $member
     * @param string|\App\Models\Goal   $goal_or_code
     * @return \App\Models\MemberRecordStat
     */
    public function getGoalStat(Member $member, $goal_or_code)
    {
        $goal = $this->getGoal($goal_or_code);
        
        $stat = MemberRecordStat::where('member_id', $member->id)->where('goal_id', $goal->id)->first();
        if ($stat == null) {
            $stat = new MemberRecordStat();
            $stat->member_id = $member->id;
            $stat->goal_id = $goal->id;
            $stat->total_count = 0;
            $stat->link_count = 0;
            $stat->save();
        }
        return $stat;
    }

    /**
     * 读取单日记录
     * @param \App\Models\Member        $member
     * @param string|\App\Models\Goal   $goal
     * @param string                    $day        格式:yyyy-mm-dd $day=null返回最近的一条记录
     * @return \App\Models\MemberGoalRecord
     */
    public function getRecord(Member $member, $goal_or_code, $day=null)
    {
        $goal = $this->getGoal($goal_or_code);
        $cursor = MemberGoalRecord::where('member_id', $member->id)
                    ->where('goal_id', $goal->id);
        if ($day != null) {
            $cursor->whereBetween('created_at', [$day. ' 00:00:00', $day . ' 23:59:59']);
        }
        return $cursor->orderBy('id', 'desc')->first();
    }

    /**
     * 读取用户打卡记录
     * @param \App\Models\Member        $member
     * @param string|\App\Models\Goal   $goal
     * @param string                    $month  格式:yyyy-mm
     * @return \Illuminate\Support\Collection
     */
    public function getRecords(Member $member, $goal_or_code, $month)
    {
        $goal = $this->getGoal($goal_or_code);
        
        $start = $month . '-01 00:00:00';
        $end = date('Y-m-d 23:59:59', strtotime($start) + 31 * 24 * 3600);
        return MemberGoalRecord::where('member_id', $member->id)
                    ->where('goal_id', $goal->id)
                    ->whereBetween('created_at', [$start, $end])
                    ->get();
    }

    /**
     * 读取目标
     * @param string|\App\Models\Goal   $goal_or_code
     * @return \App\Models\Goal
     */
    public function getGoal($goal_or_code)
    {
        $goal = $goal_or_code;
        if (is_string($goal_or_code)) {
            $goal = Goal::where('code', $goal_or_code)->first();
        }
        if ($goal == null) {
            throw new RepoException('打卡目标不存在');
        }
        return $goal;
    }
    
    /**
     * 读取好友排名
     * @param \App\Models\Member    $member
     * @return \Illuminate\Support\Collection
     */
    public function getRanks(Member $member, $goal_or_code)
    {
        $goal = $this->getGoal($goal_or_code);
        $friends = $this->memberRepo->getFriendList($member, ['id', 'nickname', 'avatar']);
        $friends->put($member);
        $friend_ids = $friends->map(function($m){
            return $m->id;
        })->toArray();

        $records = MemberGoalRecord::whereIn('member_id', $friend_ids)
                ->where('goal_id', $goal->id)
                ->whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
                ->get();
        $friends->getDictionary();
        foreach($records as $record) {
            if (isset($friends[$record->member_id])){
                $friends[$record->member_id]->record = $record;
            }
        }

        return collect($friends)->sort(function($a, $b){
            if (isset($a->record) && isset($b->record)) {
                return $a->record->updated_at < $b->record->updated_at ? -1 : 1;
            } else if (isset($a->record)) {
                return -1;
            } else if (isset($b->record)) {
                return 1;
            } else {
                return $a->id < $b->id ? -1 : 1;
            }
        });
    }

    /**
     * 统计
     * @param \App\Models\Member        $member
     * @param string|\App\Models\Goal   $goal_or_code
     * @param boolean                   $isMonth    true=月, false=周
     * @return \Illuminate\Support\Collection
     */
    public function getStat(Member $member, $goal_or_code, $isMonth)
    {
        $goal = $this->getGoal($goal_or_code);
        if ($isMonth) {
            $start = date('Y-m-01 00:00:00');
            $end = date('Y-m-t 23:59:59');
        } else {
            $start = date('Y-m-d 00:00:00', strtotime('Monday this week'));
            $end = date('Y-m-d 23:59:59', strtotime('Sunday this week'));
        }
        
        return MemberGoalRecord::where('member_id', $member->id)
                        ->where('goal_id', $goal->id)
                        ->whereBetween('created_at', [$start, $end])
                        ->get();
    }
}