<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/05
 */
 
namespace App\Utils;

use App\Utils\Exceptions\UploadException;

trait UploadTrait
{
    /**
     * 上传图片
     * @param string    $form_name
     * @return array
     */
    private function _image($form_name)
    {
        $allow_ext = ['jpg', 'jpeg', 'gif', 'png'];
        $allow_mimes = [
            'image/gif', 'image/jpeg', 'image/jpg', 'image/png',
        ];
        
        return $this->_upload($form_name, $allow_ext, $allow_mimes);
    }
    
    /**
     * 上传视频
     * @param string    $form_name
     * @return array
     */
    private function _video($form_name)
    {
        $allow_ext = ['mp4', 'mov', 'mpeg', 'mpg'];
        $allow_mimes = [
            'video/mp4', 'video/mpeg', 'video/quicktime'
        ];
        return $this->_upload($form_name, $allow_ext, $allow_mimes);
    }
    
    /**
     * 上传音频
     * @param string    $form_name
     * @return array
     */
    private function _audio($form_name)
    {
        $allow_ext = ['mp4', 'wav'];
        $allow_mimes = [
            'audio/mp3', 'audio/wav'
        ];
        return $this->_upload($form_name, $allow_ext, $allow_mimes);
    }
    
    /**
     * 其它文件
     * @param string            $form_name
     * @param mixed|array       $exts = null
     * @param mixed|array       $mimes = null
     * @return array
     */
    private function _files($form_name, $exts=null, $mimes=null)
    {
        if ($exts == null) {
            $exts = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'wps', 'rar', 'zip', '7z'];
        }
        if ($mimes == null) {
            $mimes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/kswps',
                'application/x-rar-compressed',
                'application/zip',
                'application/x-7z-compressed',
                'application/octet-stream',
                'application/*',
            ];
        }
        
        return $this->_upload($form_name, $exts, $mimes);
    }

    /**
     * @param string        $name           上传form_name
     * @param array         $allow_exts     允许的扩展名
     * @param array         $allow_mimes    允许的mime
     * @return array
     */
    private function _upload($name, $allow_exts, $allow_mimes=[])
    {
        $upload_file = request()->file($name);
        if ($upload_file == null) {
            throw new UploadException('上传文件不存在');
        }
        
        $filename = $upload_file->getClientOriginalName();
        $ext = strtolower($upload_file->getClientOriginalExtension());
        $size = $upload_file->getSize();
        $mime = $upload_file->getMimeType();
        
        if (! in_array($ext, $allow_exts)) {
            throw new UploadException('上传文件格式错误');
        }
        
        if (count($allow_mimes) && ! in_array($mime, $allow_mimes)) {
            throw new UploadException('上传文件格式错误');
        }

        $new_name = time() . uniqid() . '.' . $ext;
        $new_path = date('Ymd');

        $upload_file->storeAs('uploads/' . $new_path, $new_name, ['disk'=>'public']);

        return [
            'path' => $new_path . '/' . $new_name,
            'title' => $filename,
            'size' => $size,
            'mime' => $mime,
            'ext' => $ext,
        ];
    }
}