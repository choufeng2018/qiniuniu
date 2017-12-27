<?php

namespace app\home\controller;

use think\Cache;
use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function hehe1(){
        $options = [
            'type' => 'Redis',
            'expire'=> '200',

        ];
        $info = Cache::connect($options);
        dump($info);
    }
    public function index()
    {

        return $this->fetch('login');

    }
    public function index1(){
        $Verify = new \verify\Verify();
        $Verify->length   = 4;
        $Verify->entry();
    }

    public function hehe(){
        $memcache = new Memcache;

        //$memcache->connect("127.0.0.1",11211);

        //echo "Memcached's version: " . $memcache->getVersion() . "<br />";

        $data = array(

            'url' => "http://www.cnblogs.com/wujuntian/",

            'name' => "编程人，在天涯"

        );

        $memcache -> set("info",$data,10);

        $hehe = $memcache->get("info");

        echo '<pre>';

        print_r($hehe);
    }
    public function login(){
        $data['username'] = input('post.name');
        $data['pwd'] = input('post.pwd');
        $info = Db::table('ceshi')->where($data)->select();
        if($info){
            return $this->success('成功','home/index/index');
        }else{
            return $this->error('失败');
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
