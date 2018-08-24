<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12 0012
 * Time: 下午 3:19
 */

namespace app\admin\validate;


class IDcheck extends BaseValidate
{
    protected $rule=[
        'id'=>'require|number|gt:0',
    ];


}