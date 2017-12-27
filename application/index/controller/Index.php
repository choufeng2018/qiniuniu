<?php
namespace app\index\controller;
use app\index\model\Ceshi;
class Index
{
    public function index()
    {
        $ceshi = new Ceshi;
        $ceshi->username     = '2天下';
        $ceshi->pwd    = 'thinkphp@qq.com';
        $info = $ceshi->save();
        if($info){
            return "<script>alert('success')</script>";
        }else{
            return "<script>alert('fail')</script>";
        }
    }
    public function ceshi(){
        return 'MMP';
    }
}
