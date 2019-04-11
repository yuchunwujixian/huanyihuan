<?php
namespace App\Http\Controllers\Member;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends BaseController
{
    public function uploadImages(Request $request)
    {
        $output = ['status' => 0,'message' => '上传失败，请重试'];
        if (!$request->hasFile('file')) {//图片
            $output['message'] = '请选择图片';
            return $this->tojson($output);
        }
        $type = $request->input('type', 'avatar');
        $path = $request->input('path');
        switch ($type){
            case 'avatar'://头像
                $output['path'] = $request->file('file')->store($path.'/'.$request->user()->id.'/avatar');
            break;
        }
        if ($output['path']){
            $output['status'] = 1;
            $output['message'] = '上传成功';
        }
        return $this->tojson($output);
    }
}