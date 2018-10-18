<?php
namespace app\admin\controller\v1;
use app\admin\model\Image as ImageModel;
use app\admin\validate\Admin;
use think\Controller;
use app\admin\service\Login as LoginService;
use app\admin\model\Setting;
class Login extends Controller{



    public function login($username,$password){
        //验证用户传入数据
        (new Admin())->goCheck();
        $login = new LoginService();
        $token = $login->Login($username,$password);
        return json(['token'=>$token['token'],'msg'=>'登录成功','userInfo'=>$token['userInfo']]);
    }


    //获取登录背景图片
    public function getLoginImages(){
       //获取图片id
        $login = get_option('login');
        $bg = ImageModel::getImageById($login['img_id']);

    }


}