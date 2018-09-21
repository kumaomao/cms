<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 15:05
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\admin\validate\Option as OptionValidate;
use app\admin\model\Option as OptionModel;
use app\lib\exception\SuccessMessage;
use think\Cache;

/**
 * 网站配置项管理
 * Class Option
 * @package app\admin\controller\v1
 */
class Option extends BaseController
{



    /**
     * 设置token配置
     * @throws SuccessMessage
     * @throws \app\lib\exception\ParameterException
     * @throws \think\Exception
     */
    public function setTokenOption(){
        $this->setOption('token');
    }

    /**
     * 登录界面配置
     * @throws SuccessMessage
     * @throws \app\lib\exception\ParameterException
     * @throws \think\Exception
     */
    public function setLoginOption(){
        $this->setOption('login');
    }


    /**
     * 写入配置数据
     * @param $key 配置项名
     * @throws SuccessMessage
     * @throws \app\lib\exception\ParameterException
     * @throws \think\Exception
     */
    private function setOption($key){
        $validate = new OptionValidate();
        $validate->scene($key)->goCheck();
        $data = $validate->getDataByRule(input('post.'),$key);
        $result = OptionModel::setOption($key,$data);
        //更新缓存
        Cache::set('Option_'.$key,$result);
        throw new SuccessMessage();
    }


}