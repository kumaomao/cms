<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/24
 * Time: 10:11
 */

namespace app\admin\validate;


class Upload extends BaseValidate
{
    protected $rule=[
        'type'=>'require|number',
        'size'=>'require|number',
        'ext'=>'require',
        'path'=>'require',
    ];

}