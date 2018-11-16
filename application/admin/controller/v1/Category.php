<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/24
 * Time: 17:18
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\admin\model\Category as CategoryModel;
use app\admin\validate\Category as CategoryValidate;
use app\admin\validate\IDcheck;

class Category extends BaseController
{


    /**
     * 获取分类列表
     * @param $page
     * @param $limit
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCategory($page,$limit){
        $validate = new Limit();
        $validate->goCheck();
        $info = CategoryModel::getCategory($page,$limit);
        return $this->returnJson(['code'=>0,'count'=>count($info),'data'=>$info]);
    }

    /**
     * 添加栏目
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function addCategory(){
        $validate = new CategoryValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule(input('post.'));
        $result = CategoryModel::addCategory($data);
        return $this->returnJson(['msg'=>'操作成功']);
    }


    /**
     * 删除栏目
     * @param $id
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function delCategory($id){
        (new IDcheck())->goCheck();
        $result = CategoryModel::delCategory($id);
        return $this->returnJson(['msg'=>'操作成功']);
    }
}