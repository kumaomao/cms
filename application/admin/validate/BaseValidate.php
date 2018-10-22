<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/3 0003
 * Time: 上午 11:26
 */

namespace app\admin\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{

    /**
     * 验证方法
     * @return bool
     * @throws ParameterException
     */
    public function goCheck(){
        $resquest = Request::instance();
        //获取所有传入参数
        $params = $resquest->param();
        //获取头部传入的token
        $params['token'] = $resquest->header('token');

        if(!$this->check($params)){

            $exception = new ParameterException(
                [

                    // $this->error有一个问题，并不是一定返回数组，需要判断
                    'msg' => is_array($this->error) ? implode(';', $this->error) : $this->error,
                ]);
            throw $exception;
        }
        return true;
    }


    /**
     * @param array $arrays 通常传入request.post变量数组
     * @return array 按照规则key过滤后的变量数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays,$sceneName=false)
    {
        $newArray = [];
        if(!$sceneName){
            $rule = $this->rule ;
        }else{
            $rule = $this->getNewArr($this->scene[$sceneName]);
        }
        foreach ($rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

    private function getNewArr($scene){
        // 处理场景验证字段
        $array  = [];
        foreach ($scene as $k => $val) {
            if (is_numeric($k)) {
                $array[$val] = 0;
            } else {
                $array[$k]    = 0;
            }
        }
        return $array;
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return $field . '不允许为空';
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }



}