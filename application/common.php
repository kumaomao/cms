<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


//判断文件是否是数组，不是则转换为数组
function changeArr($data,$key='_all'){
    if(!is_array($data))
    {
        $data = json_decode($data, true);
    }

    if($key == '_all'){
        return $data;
    }

    if (array_key_exists($key, $data)) {
        return $data[$key];
    }

    throw new \app\lib\exception\MissException([
        'msg'=>$key.'不存在',
        'errorCode'=>40003
    ]);
}

//获取系统配置信息
function get_option($key){
    return \app\admin\service\CacheList::getOptionConfig($key);
}

//将连表查询数据格式转换(一维数组)
function changeDataToOneArr($data,$key=false){
    static $newArr=[];
    foreach($data as $k => $v){
        $_k = $key?$key.'_'.$k:$k;
        if(is_array($v)){//
            changeDataToOneArr($data[$k],$_k);
        }else{
            $newArr[$_k]=$data[$k];
        }

    }
    return $newArr;
}

function allChangeDataToOneArr($data){
    foreach ($data as $k=>$v){
        $data[$k]=changeDataToOneArr($v);
    }
    return $data;
}


