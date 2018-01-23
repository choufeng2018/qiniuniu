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
        if($info){
            session('username',$map['username']);
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $date['success'] = 'success';
            $date['msg'] = '登录成功';
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $date['fail'] = 'fail';
            $date['msg'] = '登录失败';
        }
        echo json_encode($date);
    }

    //退出登录
    public function tc(){
        session(null);
        $this->redirect('admin/login/login');
    }
}