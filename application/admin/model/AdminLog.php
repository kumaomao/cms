<?php
namespace app\admin\model;

class AdminLog extends BaseModel{
    
    //写入日志
    public static function setLog($id,$name,$content){
        $data=[
            'adminid'=>$id,
            'name'=>$name,
            'content'=>$content,
        ];
        $result = self::create($data);
        return $result;
    }
}