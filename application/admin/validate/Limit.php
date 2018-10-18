<?php
/**
 * Created by PhpStorm.
 * User: 10832
 * Date: 2018/10/18
 * Time: 21:27
 */

namespace app\admin\validate;


class Limit extends BaseValidate
{
    protected $rule=[
        'page'=>'require|number|gt:0',
        'limit'=>'require|number|gt:0',
    ];
}