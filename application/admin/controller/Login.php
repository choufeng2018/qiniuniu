<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 13:41
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
class Login extends Controller{
    public function login(){
        return $this->fetch();
    }

    //点击登录
    public function loginsucc(){
        $map = Request::instance()->post();
        $info = Db::table('admin')->where($map)->find();
        if(!$info){
            echo '<script>alert("用户名或密码错误，请重新登录。")</script>';
        }else{
            session('username',$map['username']);
            $this->redirect('admin/index/index');
        }
    }
}