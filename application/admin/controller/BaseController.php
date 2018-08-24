<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/3 0003
 * Time: 上午 11:23
 */

namespace app\admin\controller;


use app\admin\service\Auth;
use app\admin\service\Token;
use app\lib\exception\ParameterException;
use app\lib\exception\UnauthException;
use think\Controller;
use think\Request;

class BaseController extends Controller
{
    protected $uid;
    protected $token=false;

    public function __construct()
    {
        $this->uid = Token::checkToken();
        if(is_array($this->uid)){
            $this->token = $this->uid['token'];
            $this->uid = $this->uid['id'];

        }
        $this->chackAuth($this->uid);
    }


    private function chackAuth($uid){
        //接口权限验证
        $auto = new Auth();
        $request = Request::instance();
        $module = $request->module();
        $controller  = $request->controller();
        $action = $request->action();
        $route = $request->route();
        //api版本号
        $version=strtoupper($route['version']);
        $rule = $module.'/'.str_replace($version,':version',$controller).'/'.$action;
        $auth = $auto->check($rule,$uid);
        if(!$auth){
            throw new ParameterException([
                'msg'=>'没有该接口权限',
                'errorCode'=>20000
            ]);
        }
    }

    protected function returnJson($data){
        if($this->token){
            $data =array_merge($data,['token'=>$this->token]);
        }
        return json($data);
    }
}