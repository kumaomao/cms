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
        'id'=>'require|checkIDs',
    ];

    protected function checkIDs($value)
    {

        $values = explode(',', $value);
        if (empty($values)) {
            if ($this->isPositiveInteger($value)) {
                // 必须是正整数
                return true;
            }
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                return false;
            }
        }
        return true;
    }



}