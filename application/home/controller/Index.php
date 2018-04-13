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
    //首页信息
    public function index(){
        $product = Db::table("product")->order('id desc')->paginate(6);
        $this->assign('product',$product);
        $products = Db::table("products")->order('id desc')->paginate(8);
        $this->assign('products',$products);
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
    public function showInfo($cat=1){
        $info = Db::table("product")->where('cid',$cat)->order('time desc')->paginate(6);
        $this->assign('info',$info);
        $this->assign('cat',$cat);
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
        $next = Db::table('product')->order('id asc')->where("id>$id")->field('id,title')->find();
        $pre = Db::table('product')->order('id desc')->where("id<$id")->field('id,title')->find();
        Db::table('product')->where('id', $id)->setInc('views');
        $info = Db::table('product')->where("id=$id")->find();
        $this->assign('info',$info);
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        return $this->fetch('ZXxianqin');
    }

}
