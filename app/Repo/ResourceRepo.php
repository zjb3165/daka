<?php
/**
 * Author: Jumper Swordwave
 * Date:2019/08/04
 */
 
namespace App\Repo;

use App\Models\FileResource;
use App\Models\FileResourceTag;

class ResourceRepo
{
    private function appendTags(FileResource $resource, $tags=[])
    {
        $tagids = array_map(function($tag){return $tag->id;}, $tags);
        $resource->tags()->sync($tagids);
    }

    /**
     * 添加图片资源
     */
    public function addImage($title, $path, $size, $mime, $tags=[])
    {
        $resource = new FileResource();
        $resource->category = FileResource::IMAGE;
        $resource->title = $title;
        $resource->path = $path;
        $resource->src_path = $path;
        $resource->size = $size;
        $resource->status = FileResource::NORMAL;
        $resource->mime = $mime;
        $resource->save();
        
        $this->appendTags($resource, $tags);
    }

    /**
     * 添加视频资源
     */
    public function addVideo($title, $path, $size, $mime, $tags=[])
    {
        $resource = new FileResource();
        $resource->category = FileResource::VIDEO;
        $resource->title = $title;
        $resource->path = $path;
        $resource->src_path = $path;
        $resource->size = $size;
        $resource->status = FileResource::NEWS;
        $resource->mime = $mime;
        $resource->save();
        
        $this->appendTags($resource, $tags);
    }

    /**
     * 添加音频
     */
    public function addAudio($title, $path, $size, $mime, $tags=[])
    {
        $resource = new FileResource();
        $resource->category = FileResource::AUDIO;
        $resource->title = $title;
        $resource->path = $path;
        $resource->src_path = $path;
        $resource->size = $size;
        $resource->status = FileResource::NEWS;
        $resource->mime = $mime;
        $resource->save();

        $this->appendTags($resource, $tags);
    }

    /**
     * 读取资源列表
     * @param string    $category   默认image
     * @param string    $tag        默认为空
     * @param integer   $page       默认1
     * @param integer   $pagesize   默认10
     * @return array    [$count, $list]
     */
    public function getList($category='image', $tag='', $page=1, $pagesize=10)
    {
        $cursor = FileResource::where('category', $category)->where('status', FileResource::NORMAL);
        if ($tag != '') {
            $cursor->with(['tags' => function($query)use($tag){
                return $query->where('title', $tag)->select('title');
            }]);
        }
        $count = $cursor->count();
        $list = $cursor->skip(($page - 1) * $pagesize)->take($pagesize)->get();
        
        return [$count, $list];
    }

    /**
     * 读取标签列表
     * @return array
     */
    public function getTags()
    {
        $tags = FileResourceTag::query()->orderBy('id', 'asc')->get();
        return $tags;
    }

    /**
     * 读取资源
     * @param integer   $id
     * @return \App\Models\FileResource
     */
    public function getById($id)
    {
        return FileResource::where('id', $id)->with('tags')->first();
    }

    /**
     * 添加新标签
     * @param string|array      $tags
     * @return array
     */
    public function addTags($tags)
    {
        if (is_string($tags)) {
            $tags = [$tags];
        }
        
        $list = FileResourceTag::whereIn('title', $tags)->get();
        $exists_tags = $list->map(function($tag){return $tag->title;})->toArray();
        
        foreach($tags as $_tag){
            if (! in_array($_tag, $exists_tags)) {
                $newTag = new FileResourceTag();
                $newTag->title = $_tag;
                $newTag->count = 1;
                $newTag->save();
                $list[] = $newTag;
            }
        }
        return $list;
    }
}