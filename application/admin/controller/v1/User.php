<?php
/**
 * 后台用户操作
 */
namespace app\admin\controller\v1;
use app\admin\controller\BaseController;
use app\admin\model\AdminList;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use think\Cache;
use think\Request;
use app\admin\validate\Admin;

class User extends BaseController {
    
    /**
     * 修改密码
     * 
     */
    public function modifyPassword(){
        if(request()->isPost()){
            $password['password'] = input('password');
            $result = AdminList::modifyUser($this->token,$password);
            if($result){
                $res=[
                    'code'=>200,
                    'msg'=>'修改密码成功',
                ];
                return returnJson($res);
            }
            //失败返回
            $res=[
                'code'=>0,
                'msg'=>'修改密码失败',
            ];
            return returnJson($res);
            
        }
    }


    //获取用户信息
    public function getUserInfo(){
        $request = Request::instance();
        $token = $request->header('token');
        $userInfo = Cache::get($token);
        return json($userInfo);
    }

    /**
     * 锁屏解锁
     * @param $password
     */
    public function unlock($password){
        $validate = new Admin();
        $validate->scene('unlock')->goCheck();
        $password = $validate->getDataByRule(input('post.'),'unlock');
        $adminInfo = AdminList::getAdminInfoByUid($this->uid,'password');
        if($adminInfo){
            if($adminInfo['password']==md5($password['password'])){
                throw new SuccessMessage();
            }
        }
        throw new ParameterException([
            'msg'=>'密码错误'
        ]);
    }
    
    
}