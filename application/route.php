<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//测试文件
Route::get('/','admin/Test/index');


//login
Route::get('admin/login','admin/Login/index');
Route::post('admin/login','admin/Login/login');
//Setting
Route::get('admin/:version/lgimg','admin/:version.Login/getLoginImages');

//test
Route::get('admin/:version/test','admin/:version.Test/test');

//路由注册
$route = \app\admin\service\CacheList::getRouteConfig();
foreach ($route as $k=>$v){
    if(!empty($v)){
        Route::rule($v['route'],$v['name'],$v['method']);
    }
}
