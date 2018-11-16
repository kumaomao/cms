<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 11:18
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\admin\model\Article as ArticleModel;
use app\admin\validate\Article as ArticleValidate;
use app\admin\validate\IDcheck;
use app\admin\validate\Limit;

class Article extends BaseController
{

    public function getArticle($page,$limit){
        (new Limit())->goCheck();
        $article = ArticleModel::getArticle($page,$limit);
        return $this->returnJson(['code'=>0,'count'=>count($article),'data'=>$article]);
    }


    public function addArticle(){
        $validate = new ArticleValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule(input('post.'));
        $result = ArticleModel::addArticle($data);
        return $this->returnJson(['msg'=>'操作成功']);
    }

    public function delArticle($id){
        (new IDcheck())->goCheck();
        $result = ArticleModel::delArticle($id);
        return $this->returnJson(['msg'=>'操作成功']);
    }

}