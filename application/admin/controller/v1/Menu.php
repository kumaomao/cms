<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/21 0021
 * Time: 下午 12:45
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\admin\service\CacheList;


class Menu extends BaseController
{
    /**
     * 获取菜单数据
     * @return \think\response\Json
     */
    public function getMenu(){
        $menu = CacheList::getMenuConfig();
        return $this->returnJson(['data'=>$menu]);
    }
}