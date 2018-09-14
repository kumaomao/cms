<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 15:45
 */

namespace app\admin\controller;


use think\Controller;

class Test extends Controller
{

    public function index(){
        $key = 22.11;
        $res = explode('.',$key);
        dump($res);
    }

    public function test($value,$key){
        call_user_func($value,$key);
    }
}