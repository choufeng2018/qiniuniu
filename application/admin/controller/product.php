<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18
 * Time: 15:05
 */
namespace app\admin\controller;
use think\Controller;

class Product extends Controller{
    public function publishwine(){
        return $this->fetch();
    }
    public function winelist(){
        return $this->fetch();
    }

}