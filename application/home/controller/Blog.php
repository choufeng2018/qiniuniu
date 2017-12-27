<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/18
 * Time: 17:36
 */
namespace app\home\controller;

class Blog {
    public function read($id){
       return 'xiaohehe'.$id;
    }
    public function joke(){
        return 'tell truth';
    }
    public function delete(){
        $info = Db::table('ceshi')->where('id=7')->delete();
        if ($info){
            echo '删除成功！';
        }else{
            echo '删除失败';
        }
    }
}