<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/3/9 0009
 * Time: 10:33
 */

namespace app\admin\controller;

//留言管理
use app\admin\model\Message as MessageModel;
use app\exception\Handler;
use think\Controller;
use think\Request;

class Message extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->assign('c',[
            'name'=>'留言管理',
            'url'=>'/admin/message'
        ]);
    }
//    留言列表
    public function index()
    {
        $data = (new MessageModel())->order('time desc')->paginate('12');
        $this->assign('data',$data);
        $this->assign('a','留言列表');
        return $this->fetch();
    }

////    留言查看详情
//    public function detail($id)
//    {
//        $data = Db::table('message')->find($id);
//        $this->assign('data',$data);
//        return $this->fetch();
//    }

    //删除留言
    public function delete($id)
    {
        $res = MessageModel::destroy($id);
        if($res){
            return Handler::success('删除成功');
        }
        return Handler::fail('删除失败');
    }
}