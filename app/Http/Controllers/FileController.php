<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/24
 */
 
namespace App\Http\Controllers;

class FileController extends Controller
{
    public function imageShow($dir, $path, $size)
    {
        $file = upload_path($dir . '/' . $path);
        if (! file_exists($file)) {
            return abort(404, 'image not found');
        }
        
        list($src_width, $src_height) = getimagesize($file);
        //$ext = pathinfo($file, PATHINFO_EXTENSION);
        //$content = file_get_contents($file);
        //$filesize = filesize($file);
        $arr = explode('_', $size);
        $width = $height = null;
        if (count($arr) == 2) {
            $width = intval(substr($arr[0], 1));
            $height = intval(substr($arr[1], 1));
            if ($width > $src_width) $width = $src_width;
            if ($height > $src_height) $height = $src_height;
        } else if (count(arr) == 1) {
            if (substr($arr[0], 0, 1) == 'w') {
                $width = intval(substr($arr[0], 1));
                if ($width > $src_width) $width = $src_width;
                $height = intval($width * $src_height / $src_width);
            } else {
                $height = intval(substr($arr[0], 1));
                if ($height > $src_height) $height = $src_height;
                $width = intval($src_width * $height / $height);
            }
        } else {
            abort(404, 'image not found');
        }
        
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $new_path = $dir . '/' . $path . '_' . $width . 'x' . $height . '.' . $ext;
        $new_file = upload_path($new_path);
        if (! file_exists($new_file)) {
            $img = \Image::make($file);
            $img->crop($width, $height);
            $img->save($new_file);
        }

        $lastModify = filemtime($new_file);
        $etag = md5($lastModify);
        $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : '';
        if ($if_none_match == $etag) {
            $headers = [
                'Cache-Control:private, max-age=31536000',
                'Expires:' . date('D, d M Y H:i:s', time() + 365 * 24 * 3600) . ' GMT',
                'ETag:' . $etag,
                'Access-Control-Allow-Origin' => '*',
            ];
            return abort(304, '', $headers);
        }

        $filesize = filesize($new_file);
        $mime = mime_content_type($new_file);
        $headers = [
            'Cache-Contorl:private, max-age=31536000',
            'Expires:' . date('D, d M Y H:i:s', time() + 365 * 24 * 3600) . ' GMT',
            'ETag:' . $etag,
            'Content-Type' => $mime,
            'Content-Length' => $filesize,
            'Access-Control-Allow-Origin' => '*',
        ];
        return response(file_get_contents($new_file), 200, $headers);
    }
}