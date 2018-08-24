<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28 0028
 * Time: 下午 5:31
 */

namespace app\admin\controller\v1;

use app\admin\controller\BaseController;
use app\admin\service\CacheList;

class Setting extends BaseController
{

    /**
     * 获取网站配置
     * @param $key
     * @return \think\response\Json
     */
    public function getSetting($key="_all"){
        $settingInfo = CacheList::getSettingConfig($key);
        return json($settingInfo);
    }

}