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

class Index extends Controller{
    public function index(){

        return $this->fetch();
    }

    public function create(){
        $data['username'] = '阿迪';
        $data['pwd'] = '阿迪3';
        $id = Db::table('ceshi')->insertGetId($data);
        return $id;
    }


    public function Group(){
        return $this->fetch();
    }
    public function zhixun(){
        return $this->fetch();
    }
    public function zhuanjia(){
        return $this->fetch();
    }
     public function ZXxianqin(){
        return $this->fetch();
    }
    public function lianxi(){
        return $this->fetch();
    }
    public function cpzhongxin(){
            return $this->fetch();
    }
    public function cpxianqin(){
        return $this->fetch();
    }
    public function lunbo(){
            return $this->fetch();
        }

}
