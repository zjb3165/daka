<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/30
 */
 
namespace App\Services\weixin;

use EasyWeChat\OfficialAccount\Application;
use EasyWeChat\BasicService\QrCode\Client;

use App\Services\utils\RemoteCatch;

class QrHandler
{
    /**
     * @var \EasyWeChat\BasicService\QrCode\Client
     */
    private $qrcode;
    
    /**
     * @var \App\Services\utils\RemoteCatch
     */
    private $catch;

    public function __construct(Application $app, RemoteCatch $catch)
    {
        $this->qrcode = $app->qrcode;
        $this->catch = $catch;
    }
    
    /**
     * @param string    $content
     * @param integer   $expires    过期时间，默认7天
     * @return array    ['ticket'=>'adfadf', 'expire_seconds'=>234234, 'url'=> '', 'locale'=>'']
     */
    public function temporary($content, $expires=7)
    {
        $result = $this->qrcode->temporary($content, $expires * 24 * 3600);
        $result['locale'] = $this->catch->catchImage($result['url']);
        return $result;
    }

    /**
     * @param string    $content
     * @return array    ['ticket'=>'', 'url'=>'', 'locale'=>'']
     */
    public function forever($content)
    {
        $result = $this->qrcode->forever($content);
        $result['locale'] = $this->catch->catchImage($result['url']);
        return $result;
    }
}