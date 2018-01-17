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

       return $this->fetch();
   }

    public function plist(){
        $list = Db::table('product')->alias("p")->join("classify c","p.cid=c.id",'left')->field('p.*,c.description')->paginate(10);
        $this->assign('list',$list);
        return $this->fetch('list');
       /* // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Db::name('user')->where('status',1)->paginate(10);
// 把分页数据赋值给模板变量list
        $this->assign('list', $list);
// 渲染模板输出
        return $this->fetch();*/
    }
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
    public function receiveProduct(){
        $map['banner'] = $_POST['banner'];
        $map['title'] = $_POST['title'];
        $map['author'] = $_POST['author'];
        $map['source'] = $_POST['source'];
        $map['content'] = $_POST['content'];
        $map['cid'] = $_POST['cid'];
        $map['time'] = time();
        $info = Db::table('product')->insert($map);
        if($info){
            $date['success'] = 'success';
            $date['msg'] = '保存成功！';
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '保存失败！';
        }
        echo json_encode($date);
    }

    public function modify(){
        $id = $_GET['id'];
        $modify= Db::table('product')->alias("p")->join("classify c","p.cid=c.id",'left')->where("p.id=$id")->field('p.*,c.description')->find();
        //dump($modify);
        echo json_encode($modify);
    }
    public function update(){
        $id = $_POST['id'];
        $map['cid'] = $_POST['cid'];
        $map['title'] = $_POST['title'];
        $map['content'] = $_POST['content'];
        $map['banner'] = $_POST['banner'];
        $map['author'] = $_POST['author'];
        $map['source'] = $_POST['source'];
        $info = Db::table('product')->where("id=$id")->update($map);
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
        $info = Db::table('product')->where("id=$id")->delete();
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
