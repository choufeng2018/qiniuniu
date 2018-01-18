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

class Product extends Controller{
    public function publishwine(){
        return $this->fetch();
    }
    public function winelist(){
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

}