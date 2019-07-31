<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/31
 */

namespace App\Services\weixin;

use EasyWeChat\OfficialAccount\Application;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;

class ReplyHandler
{
    /**
     * @var \EasyWeChat\OfficialAccount\Material\Client
     */
    private $material;

    public function __construct(Application $app)
    {
        $this->material = $app->material;
    }

    /**
     * 回复文本内容
     * @param string    $content
     * @return \EasyWeChat\Kernel\Messages\Text
     */
    public function text($content)
    {
        //todo 文字处理
        $text = new Text();
        $text->content = $content;

        return $text;
    }

    /**
     * 回复图片素材
     * @param string    $image  uploads目录图片
     * @return \EasyWeChat\Kernel\Messages\Image
     */
    public function image($image)
    {
        $media_id = $this->upload($image);
        $img = new Image($media_id);
        return $img;
    }

    /**
     * 回复图文,被动消息与客服消息接口只能接受一条图文
     * @param array     $news
     * @return \EasyWeChat\Kernel\Messages\News
     */
    public function news($news)
    {
        $items = [];
        foreach($news as $_news) {
            if (! isset($_news['title'])) continue;
            $items[] = new NewsItem([
                'title' => $_news['title'],
                'description' => isset($_news['description']) ? $_news['description'] : '',
                'url' => isset($_news['url']) ? $_news['url'] : '',
                'image' => isset($_news['image']) ? $_news['image'] : '',
            ]);
        }
        return new News($items);
    }
    
    /**
     * 上传素材
     * @param string    $src    uploads目录本地素材资源
     * @param string    $type   素材类型，默认image
     * @param string    $title  上传type=video时，视频标题
     * @param string    $desc   上传type=video时，视频描述
     * @return string
     */
    public function upload($src, $type = 'image', $title='', $desc='')
    {
        if (! file_exists($src)){
            $src = upload_path($src);
        }
        if (! file_exists($src)) return null;
        if ($type == 'image') {
            return $this->material->uploadImage($src);
        } else if ($type == 'thumb') {
            return $this->material->uploadThumb($src);
        } else if ($type == 'audio') {
            return $this->material->uploadVoice($src);
        } else if ($type == 'video') {
            return $this->material->uploadVideo($src, $title, $desc);
        }
        return null;
    }
}