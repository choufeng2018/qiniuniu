<?php

namespace app\admin\controller;
header("Content-Type: text/html;charset=utf-8");
use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch();
    }

   public function publish(){
       $info = Db::table('classify')->select();
       $this->assign('select',$info);
       return $this->fetch();
   }
    public function articlePublish(){
        $str = '订单';
        $a = strtolower(urlencode($str));
        dump($a);
    }
    public function plist(){
        $info = Db::table('product')->alias('p')->join('classify c', 'p.cid=c.id')->select();
        $this->assign('list',$info);
        return $this->fetch('list');
    }
    public function fileUpload(){
        $file = request()->file('img');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload',$savename = false);
            if($info){
                $date['src'] = $info->getFilename();
                echo json_encode($date);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
    public function receiveProduct(){
        $map['banner'] = $_POST['banner'];
        $map['title'] = $_POST['title'];
        $map['content'] = $_POST['content'];
        $map['time'] = time();
        $info = Db::table('product')->save($map);
        if($info){
            $date['success'] = 'success';
            $date['msg'] = '保存成功！';
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '保存失败！';
        }
        echo json_encode($date);
    }


}
