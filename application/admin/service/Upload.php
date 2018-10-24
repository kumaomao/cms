<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 17:50
 */

namespace app\admin\service;


use app\admin\model\Image;
use app\lib\exception\ParameterException;

class Upload
{

    public static function upload($details=null){
        $result = [];
        // 获取表单上传文件s
        $files = request()->file();
        $rule = ['size'=>get_option('upload.size'),'ext'=>get_option('upload.ext')];
        $path = get_option('upload.path');
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate($rule)->move(ROOT_PATH .'public'. $path);
            if($info){
                // 成功上传后 获取上传信息
                $imgurl =  $path."/".$info->getSaveName();
                $image = ['url'=>$imgurl,'from'=>1,'details'=>$details];
                $result=[
                    'id'=>Image::setImage($image),
                    'url'=>'http://118.24.72.237/'.$imgurl
                ];
            }else{
                // 上传失败获取错误信息
                throw new ParameterException([
                    'msg'=>$file->getError()
                ]);
            }
        }
        return $result;
    }


}