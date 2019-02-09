<?php
/**
 * --------------------------------------------
 * Desc：
 * User: Jiafang.Wang
 * Date: 2017/4/28 13:24
 * File: UploadController.php
 * --------------------------------------------
 */


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UploadController
{
    public function uploadImages(Request $request)
    {
        $target = $request->input('target');
        if(!$target) {
            return 'target missing';
        }
        $file = Input::file('Filedata');
        if($file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            $allow_extension = ['jpg', 'jpeg', 'png'];
            if(!in_array($extension, $allow_extension)) {
                return 'invalid extension';
            }
            $newName = date('YmdHis').mt_rand(100,999).".".$extension;
            $file->move(base_path()."/public/uploads/".$target."/",$newName);
            $filepath = "/uploads/".$target."/".$newName;
            exit($filepath);
        }
    }
}