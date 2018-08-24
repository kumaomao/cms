<?php
namespace app\admin\model;
use think\Cache;
use token\Token;
use app\admin\model\AdminLog;
class AdminList extends BaseModel{

    public function img(){
        return $this->belongsTo('Image','head_id','id');
    }

    /**
     * 根据用户名获取用户信息
     * @param $usename
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getAdminInfoByUsername($usename){
        $adminInfo = self::with(['img'])
            ->where('username',$usename)
            ->find();
        return $adminInfo;
    }

    public static function getAdminInfoByUid($uid,$field="*"){
        $info = self::where('id','=',$uid)->field($field)->find();
        return $info;
    }

    
    /**
     * 修改用户表信息
     * @param $uid
     * @param array $data
     */
    public static function modifyUser($token,$data){
        //获取用户数据
        $user = Cache::get($token);
        //是否存在密码
        if(isset($data['password'])){
            $data['password']=Md5($data['password']);
        }
        $result = self::where(['id'=>$user['id']])->update($data);
        //写入操作log
        $log = AdminLog::setLog($user['id'],$user['username'],'管理员:'.$user['username'].'修改了自身信息');
        return $result;
    }
    
}