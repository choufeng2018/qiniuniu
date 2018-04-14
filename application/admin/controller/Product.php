<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18
 * Time: 15:05
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;

class Product extends Controller{
    public function publishwine(){
        return $this->fetch();
    }
    public function winelist(){
        $list = Db::table('products')->order('id desc')->paginate(10);
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加产品
    public function addProduct(){
        $data = Request::instance()->post();
        $info = Db::table('products')->insert($data);
        if($info){
            $date['success'] = 'success';
            $date['msg'] = '保存成功！';
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '保存失败！';
        }
        echo json_encode($date);
    }

    //上传封面
    public function fileUpload(){
        $file = request()->file('img');
        // 移动到框架应用根目录/public/upload/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload',$savname=false);
            if($info){
                $date['src'] = $info->getFilename();
                echo json_encode($date);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }

    //修改产品详情
    public function modify(){
        $id = $_GET['id'];
        $modify= Db::table('products')->where("id=$id")->find();
        //dump($modify);
        echo json_encode($modify);
    }
    public function update(){
        $id = $_POST['id'];
        $map = Request::instance()->except('id');
        $info = Db::table('products')->where("id=$id")->update($map);
        if($info){
            $date['success'] = 'success';
            $date['msg'] = '更新成功';
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '更新失败';
        }
        echo json_encode($date);
    }
    public function delete(){
        $id = $_GET['id'];
        $info = Db::table('products')->where("id=$id")->delete();
        if($info){
            $date['success'] = 'success';
            $date['msg'] = '删除成功';
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '删除失败';
        }
        echo json_encode($date);
    }



}