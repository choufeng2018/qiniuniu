<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 13:41
 */
namespace app\admin\controller;
use think\Controller;

class Login extends Controller{
    public function login(){
        return $this->fetch();
    }
}