<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/3/7 0007
 * Time: 14:59
 */

namespace app\exception;

//异常处理类
class Handler
{


//返回异常
    public static function fail($msg='服务器异常'){
        $info = [
            'state'=>'fail',
            'msg'=>$msg
        ];

        return json($info);
    }

//    成功返回信息，可以传额外的数据$data
    public static function success($msg='操作成功',$data=""){
        $info = [
            'state'=>'success',
            'msg'=>$msg
        ];
        if($data){
            $info['data'] = $data;
        }
        return json($info);
    }

}