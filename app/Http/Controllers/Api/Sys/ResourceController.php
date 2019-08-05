<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/04
 */
 
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Api\BaseController;
use App\Models\ApiErrorCode;
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
}