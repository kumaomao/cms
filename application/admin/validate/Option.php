<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 15:10
 */

namespace app\admin\validate;

/**
 *系统配置验证
 * Class Option
 * @package app\admin\validate
 */
class Option extends BaseValidate
{

    protected $rule = [
        'tokenSalt'=>'require|alphaNum',
        'time_expire'=>'require|number',
        'time_last'=>'require|number|<:time_expire',
        'status'=>'require|number',

        'img_id'=>'require',


    ];

    protected $scene =[
        'token'=>['tokenSalt','time_expire','time_last','status'],
        'login'=>['img_id','time_expire'],
    ];


}