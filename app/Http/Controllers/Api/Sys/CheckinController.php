<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/07
 */
 
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\GoalRequest;
use App\Repo\CheckInRepo;
use App\Models\ApiErrorCode;
use App\Models\Goal;

class CheckinController extends BaseController
{
    /**
     * @var \App\Repo\CheckInRepo
     */
    private $repo;

    public function __construct(CheckInRepo $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * 读取目标列表
     * @route /api/sys/goal
     */
    public function getGoals()
    {
        $list = $this->repo->getGoalList();
        $list = $list->map(function($goal){
            return [
                'id' => $goal->id,
                'title' => $goal->title,
                'start_time' => $goal->start_time,
                'end_time' => $goal->end_time,
                'credits' => $goal->credits,
                'orderindex' => $goal->orderindex,
                'repeat' => $goal->repeat,
                'code' => $goal->code,
            ];
        })->toArray();

        return $this->success(['list'=>$list]);
    }
    
    /**
     * 读取目标详情
     * @route /api/sys/goal/{id}
     * @param integer   $id
     */
    public function getGoal($id)
    {
        $goal = $this->repo->getGoalById($id);
        if ($goal == null) {
            return $this->error(ApiErrorCode::NOTFOUND, '打卡目标不存在');
        }

        $goal = [
            'id' => $goal->id,
            'title' => $goal->title,
            'start_time' => $goal->start_time,
            'end_time' => $goal->end_time,
            'credits' => $goal->credits,
            'orderindex' => $goal->orderindex,
            'reply' => $goal->reply,
            'checked_reply' => $goal->checked_reply,
            'not_in_time_reply' => $goal->not_in_time_reply,
            'repeat' => $goal->repeat,
        ];
        return $this->success(['goal'=>$goal]);
    }

    /**
     * 更新目标设置
     * @route /api/sys/goal/{id}
     * @method post
     * @param integer   $id
     * @param string    $title
     */
    public function updateGoal(GoalRequest $request, $id)
    {
        $goal = $this->repo->getGoalById($id);
        if ($goal == null) {
            return $this->error(ApiErrorCode::NOTFOUND, '打卡目标不存在');
        }
        $data = $request->all();
        $goal = $this->repo->updateGoal($goal, $data);

        $goal = [
            'id' => $goal->id,
            'title' => $goal->title,
            'start_time' => $goal->start_time,
            'end_time' => $goal->end_time,
            'credits' => $goal->credits,
            'orderindex' => $goal->orderindex,
            'reply' => $goal->reply,
            'checked_reply' => $goal->checked_reply,
            'not_in_time_reply' => $goal->not_in_time_reply,
            'repeat' => $goal->repeat,
        ];
        return $this->success(['goal' => $goal]);
    }
}