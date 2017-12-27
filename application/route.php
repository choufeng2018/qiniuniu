<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
/*Route::get('/',function(){
    return 'Hello,world!';
});*/
//Route::rule('blog','home/index/index','get');
Route::rule(['read','read/:id'],'home/Blog/read');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '__rest__'=>[
        // 指向home模块的index控制器
        'index'=>'home/index',
        'login'=>'home/login',
        'register'=>'home/Register',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'ceshi'=>'index/Ceshi/index',
    //'index'=>'home/Index/index',
    'home/Login/index1'=>'home/Login/index1',
    'home/Login/login'=>'home/Login/login',
    'home/Register/index'=>'home/Register/index',
    'home/Login/hehe'=>'home/Login/hehe',
    'home/Login/hehe1'=>'home/Login/hehe1',


];


