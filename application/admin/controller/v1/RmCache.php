<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22 0022
 * Time: 上午 11:28
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\lib\exception\ParameterException;
use think\Cache;

class RmCache extends BaseController
{

    //清除缓存
    public function rmCache($key){
        $result  = Cache::rm($key);
        if($result){
            return json('清除成功');
        }
        throw new ParameterException([
            'msg'=>'清除失败',
            'errorCode'=>50000
        ]);
    }
}