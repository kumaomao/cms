<?php
namespace app\admin\validate;
class Admin extends BaseValidate {
    protected $rule = [
        ['username','require|max:16|min:5|alphaNum','帐号不能为空|帐号位数超限|帐号最低5位|帐号只能为字母或数字'],
        ['password','require|max:16|min:5|alphaNum','密码不能为空|密码位数超限|密码最低5位|密码只能为字母或数字'],
    ];

    protected $scene = [
        'unlock'=>['password']
    ];
}