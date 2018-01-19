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

    //显示红酒资讯
    public function showInfo(){
        $info = Db::table("product")->order('id desc')->paginate(6);
        $this->assign('info',$info);
        return $this->fetch('zhixun');
    }

    //显示产品中心
    public function showProduct(){
        $info = Db::table("products")->order('id desc')->field('id,title,etitle,banner')->paginate(8);
        $this->assign('info',$info);
        return $this->fetch('cpzhongxin');
    }

    //显示产品详情
    public function showDetail(){
        $id = $_GET['id'];
        $info = Db::table('products')->where("id=$id")->find();
        $this->assign('info',$info);
        return $this->fetch('cpxianqin');
    }

    //显示咨询详情
    public function showzxDetail(){
        $id = $_GET['id'];
        Db::table('product')->where('id', $id)->setInc('views');
        $info = Db::table('product')->where("id=$id")->find();
        $this->assign('info',$info);
        return $this->fetch('ZXxianqin');
    }

}
