<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */
 
namespace App\Http\Controllers\Api\Sys;

use Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\AdminInsertRequest;
use App\Http\Requests\Api\AdminUpdateRequest;
use App\Repo\AdminRepo;
use App\Models\ApiErrorCode;

class AdminController extends BaseController 
{
    /**
     * @var \App\Repo\AdminRepo;
     */
    private $repo;

    public function __construct(AdminRepo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $list = $this->repo->getList();
        $list = $list->map(function($admin){
            return [
                'id' => $admin->id,
                'username' => $admin->username,
                'name' => $admin->name,
            ];
        })->toArray();
        return $this->success(['list'=>$list]);
    }

    public function store(AdminInsertRequest $request)
    {
        $data = $request->all();
        try {
            $admin = $this->repo->add($data['username'], $data['name'], $data['password']);
            $user = [
                'id' => $admin->id,
                'username' => $admin->username,
                'name' => $admin->name,
            ];
            return $this->success(['user'=>$user]);
        } catch(\Exception $e) {
            return $this->error(ApiErrorCode::INSERT_ERROR, '添加失败,原因：' . $e->getMessage());
        }
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $data = $request->all();
        try {
            $admin = $this->repo->update($id, $data['name'], $data['password'] ?? '');
            $user = [
                'id' => $admin->id,
                'username' => $admin->username,
                'name' => $admin->name,
            ];
            return $this->success(['user'=>$user]);
        } catch(\Exception $e) {
            return $this->error(ApiErrorCode::UPDATE_ERROR, '修改失败，原因：' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = $this->repo->delete($id);
        if ($result) {
            return $this->success();
        } else {
            return $this->error(ApiErrorCode::DELETE_ERROR, '删除失败，原因：用户不可删除');
        }
    }

    public function getInfo($id)
    {
        $admin = $this->repo->getById($id);
        if ($admin == null) {
            return $this->error(ApiErrorCode::GET_ERROR, '用户不存在');
        }
        
        $user = [
            'id' => $admin->id,
            'username' => $admin->username,
            'name' => $admin->name,
        ];
        return $this->success(['user'=>$user]);
    }
}