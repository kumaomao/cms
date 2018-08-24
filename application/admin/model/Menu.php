<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/21 0021
 * Time: 下午 12:41
 */

namespace app\admin\model;


class Menu extends BaseModel
{

    /**
     * 根据状态获取菜单
     * @param int $status
     */
    public static function getMenuByStatus($status = 1){
        $menu = self::where('status','=',$status)->order('order desc')->select();
        return $menu->hidden(['create_time','update_time','delete_time','order','status']);
    }

    /**
     * 获取全部菜单
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getMenuAll(){
        $menuAll = self::order('order desc')->select();
        return $menuAll;
    }
}