<?php
/**
* author: jumper swordwave
* copyright: 泽诚科技
*/
namespace App\Services\utils;

use GuzzleHttp\Client as GuzzleClient;

/**
 * 抓取服务
 */
class RemoteCatch
{
    private $client = null;
    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * 抓取远程json
     */
    public function catchJson($url, $method='get', $params=[]) {
        if (empty($url)) return null;

        if ($method == 'get') {
            $res = $this->client->get($url);
        } else {
            $res = $this->client->post($url, $params);
        }

        $file_content = '';
        if ($res->getStatusCode() == 200) {
            $file_content = $res->getBody();
        }
        
        if (empty($file_content)) return null;

        return json_decode($file_content, true);
    }

    /**
     * 抓取图片
     */
    public function catchImage($url)
    {
        if (empty($url)) return '';

        try {
            $img = \Image::make($url);
            $ext = pathinfo($url, PATHINFO_EXTENSION);
            $new_file = date('Ymd') . '/' . time() . uniqid() . '.' . $ext;
            $dir = pathinfo(upload_path($new_file), PATHINFO_DIRNAME);
            if (! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $img->save(upload_path(new_file), 60, $ext);
            return $new_file;
        } catch(\Exception $e) {
            \Log::info('catch image failed. url:' . $url . '. exception:' . $e->getMessage());
            \Log::info($e);
            return '';
        }
    }
}