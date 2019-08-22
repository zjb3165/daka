<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Http\Controllers\Api\Front;

use App\Repo\RecordRepo;

class MemberController extends BaseController
{
    /**
     * @var \App\Repo\RecordRepo;
     */
    private $recordRepo;

    public function __construct(RecordRepo $repo)
    {
        parent::__construct();
        $this->recordRepo = $repo;
    }

    /**
     * 返回登陆用户信息
     * @router /api/front/member
     */
    public function getMember()
    {
        $member = [
            'id' => $this->member->id,
            'nickname' => $this->member->nickname,
            'avatar' => $this->member->avatar,
        ];
        return $this->success(['member'=>$member]);
    }

    /**
     * 读取打卡历史
     * @route /api/front/member/history
     * @param string    $code
     * @param string    $month
     */
    public function getHistories()
    {
        $code = request('code');
        $month = request('month');

        $list = $this->recordRepo->getRecords($this->member, $code, $month);
        $list = $list->map(function($record){
            return [
                'id' => $record->id,
                'picture' => $record->picture,
                'date' => $record->created_at->format('YYYY-mm-dd'),
            ];
        })->toArray();

        return $this->success(['list'=>$list]);
    }

    /**
     * 读取当日打卡
     * @route /api/front/member/today
     * @param string $code
     */
    public function getTodayStat()
    {
        $code = request('code');
        $goal = $this->recordRepo->getGoal($code);
        $record = $this->recordRepo->getRecord($this->member, $goal, null);
        $stat = $this->recordRepo->getGoalStat($this->member, $goal);

        if ($record != null) {
            $record = [
                'picture' => $record->picture,
                'date' => $record->created_at->format('Y-m-d'),
            ];
        }

        $result = [
            'total' => $stat->total_count,
            'link' => $stat->link_count,
            'record' => $record,
        ];
        return $this->success(['stat'=>$result]);
    }

    /**
     * 今日好友排名
     * @route /api/front/member/ranks
     */
    public function getFriendRanks()
    {
        $code = request('code');
        
        $ranks = $this->recordRepo->getRanks($this->member, $code);
        $ranks = $ranks->map(function($f){
            return [
                'nickname' => $f->nickname,
                'avatar' => $f->avatar,
                'time' => $f->record != null ? $f->record->created_at->timestamp : 0,
            ];
        })->toArray();

        return $this->success(['ranks'=>$ranks]);
    }
}