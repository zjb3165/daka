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
        if (is_array($tags)) {
            $tagids = array_map(function($tag){return $tag->id;}, $tags);
        } else {
            $tagids = $tags->map(function($tag){return $tag->id;})->toArray();
        }
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
        
        if (count($tags)) {
            $this->appendTags($resource, $tags);
        }
        return $resource;
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
        
        if (count($tags)) {
            $this->appendTags($resource, $tags);
        }
        return $resource;
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

        if (count($tags)) {
            $this->appendTags($resource, $tags);
        }
        return $resource;
    }

    /**
     * 其它文件
     */
    public function addFiles($title, $path, $size, $mime, $tags=[])
    {
        $resource = new FileResource();
        $resource->category = FileResource::FILES;
        $resource->title = $title;
        $resource->path = $path;
        $resource->src_path = $path;
        $resource->size = $size;
        $resource->status = FileResource::NORMAL;
        $resource->mime = $mime;
        $resource->save();

        if (count($tags)) {
            $this->appendTags($resource, $tags);
        }
        return $resource;
    }

    /**
     * 读取资源列表
     * @param string    $category   默认image
     * @param string    $tagid      默认1
     * @param integer   $page       默认1
     * @param integer   $pagesize   默认10
     * @param array     $with       
     * @return array    [$count, $list]
     */
    public function getList($category='image', $tagid=0, $page=1, $pagesize=10, $with=[])
    {
        $cursor = FileResource::where('category', $category)->where('status', FileResource::NORMAL);
        if ($tagid > 0) {
            $cursor->with(['tags' => function($query)use($tagid){
                return $query->where('id', $tagid);
            }]);
        } else if (in_array('tags', $with)) {
            $cursor->with('tags');
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
    public function getById($id, $status=null)
    {
        $cursor = FileResource::where('id', $id);
        if ($status != null) {
            $cursor->where('status', $status);
        }
        return $cursor->with('tags')->first();
    }
    
    /**
     * 删除资源
     * @param integer|\App\Models\FileResource  $resource_or_id
     */
    public function delete($resource_or_id)
    {
        $resource = $resource_or_id;
        if (is_numeric($resource_or_id)) {
            $resource = FileResource::where('id', $resource_or_id)->first();
        }

        if ($resource != null) {
            $resource->tags()->delete();
            $resource->delete();
        }
    }
    
    /**
     * 更新资源
     * @param integer|\App\Models\FileResource  $resource_or_id
     * @param string                            $title
     * @param array                             $tags
     * @return \App\Models\FileResource
     */
    public function updateResource($resource_or_id, $title, $tags=[])
    {
        $resource = $resource_or_id;
        if (is_numeric($resource_or_id)) {
            $resource = FileResource::where('id', $resource_or_id)->with('tags')->first();
        }
        
        if ($resource == null) return null;

        $tagids = array_map(function($tag){return $tag->id;}, $tags);
        $resource->title = $title;
        $resource->tags()->sync($tagids);
        $resource->save();
        return $resource;
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