<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
 
if (!function_exists('upload_path')) {
    function upload_path($file)
    {
        return storage_path('app/public/uploads/' . $file);
    }
}