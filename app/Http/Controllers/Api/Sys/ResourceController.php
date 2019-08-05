<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/04
 */
 
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Api\BaseController;
use App\Models\ApiErrorCode;
use App\Models\FileResource;
use App\Repo\ResourceRepo;
use App\Utils\UploadTrait;
use App\Utils\Exceptions\UploadException;

class ResourceController extends BaseController 
{
    use UploadTrait;
    /**
     * @var \App\Repo\ResourceRepo;
     */
    private $repo;
    
    public function __construct(ResourceRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 上传文件
     * @route /api/sys/resource/upload
     * @method post
     * @param string    $type=image/video/audio/file
     */
    public function upload()
    {
        $type = 'image';
        if (request()->has('type')) {
            $type = request()->input('type');
        }
        try {
            switch($type) {
                case 'video':
                $result = $this->_video('file');
                $resource = $this->repo->addVideo($result['title'], $result['path'], $result['size'], $result['mime']);
                break;
                case 'audio':
                $result = $this->_audio('file');
                $resource = $this->repo->addAudio($result['title'], $result['path'], $result['size'], $result['mime']);
                break;
                case 'file':
                $result = $this->_files('file');
                $resource = $this->repo->addFiles($result['title'], $result['path'], $result['size'], $result['mime']);
                break;
                default:
                $result = $this->_image('file');
                $resource = $this->repo->addImage($result['title'], $result['path'], $result['size'], $result['mime']);
                break;
            }
            
            $info = [
                'id' => $resource->id,
                'title' => $resource->title,
                'path' => $resource->path,
                'url' => resource_url($resource->path),
                'tags' => $resource->tags->map(function($tag){
                    return [
                        'id' => $tag->id,
                        'title' => $tag->title,
                    ];
                })->toArray()
            ];
            return $this->success(['resource'=>$info]);
        } catch(UploadException $e) {
            return $this->_error(ApiErrorCode::UPLOAD_ERROR, '上传失败，原因：' . $e->getMessage());
        }
    }

    /**
     * 读取图片列表
     * @route /api/sys/resource
     * @param string    $category=image
     * @param integer   $tagid=0
     * @param integer   $page=1
     * @param integer   $pagesize=10
     */
    public function lists()
    {
        $category = request('category');
        $tagid = intval(request('tagid'));
        $page = min(1, intval(request('page', 1)));
        $pagesize = min(1, intval(request('pagesize', 10)));
        if (! in_array($category, [FileResource::IMAGE, FileResource::VIDEO, FileResource::AUDIO, FileResource::FILE])) {
            $category = FileResource::IMAGE;
        }

        list($count, $list) = $this->repo->getList($category, $tagid, $page, $pagesize);
        $pages = ceil($count / $pagesize);
        $list = $list->map(function($res){
            return [
                'id' => $res->id,
                'title' => $res->title,
                'path' => $res->path,
                'url' => resource_url($res->path),
            ];
        })->toArray();
        
        return $this->success(['list'=>$list, 'count'=>$count, 'pages'=>$pages]);
    }

    /**
     * 资源信息
     * @route /api/sys/resource/{id}
     * @param integer   $id
     */
    public function info($id)
    {
        $resource = $this->repo->getById($id);
        if ($resource == null) {
            return $this->error(ApiErrorCode::NOTFOUND_ERROR, '资源不存在');
        }
        
        $info = [
            'id' => $resource->id,
            'title' => $resource->title,
            'category' => $resource->category,
            'path' => $resource->path,
            'url' => resource_url($resource->path),
            'tags' => $resource->tags->map(function($tag){
                return [
                    'id' => $tag->id,
                    'title' => $tag->title,
                ];
            })->toArray(),
        ];
        
        return $this->success(['resource'=>$info]);
    }
    
    /**
     * 删除资源
     * @route /api/sys/resource/{id}
     * @method delete
     * @param integer   $id
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return $this->success();
    }
}