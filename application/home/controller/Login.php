<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/18
 * Time: 15:14
 */
namespace app\home\controller;
use think\Controller;
use think\Db;

class Login extends Controller{
    public function index(){
        $list = Db::table('ceshi')->paginate(5);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function create(){
        $data['username'] = '阿迪';
        $data['pwd'] = '阿迪3';
        $id = Db::table('ceshi')->insertGetId($data);
        return $id;
    }

    public function login(){
        return $this->fetch();
    }
     public function hehe(){
            return $this->fetch();
        }



}