<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28 0028
 * Time: 上午 10:18
 */

namespace app\admin\controller\v1;


use think\Cache;
use think\Controller;

class Test extends Controller
{
    public function test(){
        Cache::rm('menuConfig');

    }
}