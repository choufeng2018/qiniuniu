<?php
/**
* Created by PhpStorm.
* User: luxiao
* Date: 2017/5/8
* Time: 11:23
*/
/**
 * Created by PhpStorm.
 * User: luxiao
 * Date: 2017/5/8
 * Time: 11:23
 */
namespace app\home\controller;

use app\exception\Handler;
use think\Controller;
use think\Db;
use think\Request;

class Mail extends Controller
{
//    发送需求邮件
    public function message(){
        if(cookie('send_mail')){
            return Handler::fail('已收到您的请求，请勿频繁操作');
        }
        $post = Request::instance()->post();

        if(key_exists('names',$post)&&key_exists('phone',$post)&&key_exists('emails',$post)&&key_exists('xuqiu',$post)) {
            $data['name'] = $post['names'];
            $data['tel'] = $post['phone'];
            $data['email'] = $post['emails'];
            $data['content'] = $post['xuqiu'];
            $res = Db::table('message')->insert($data);
            if($res){
                $mailbody['name'] = "<a style='font-size:16px;color:#000;font-family:微软雅黑;text-decoration:none;'>姓名:" . $post['names'] . "</a><br/>";
                $mailbody['phone'] = "<a style='font-size:16px;color:#000;font-family:微软雅黑;text-decoration:none;'>电话:" . $post['phone'] . "</a><br/>";
                $mailbody['email'] = "<a style='font-size:16px;color:#000;font-family:微软雅黑;text-decoration:none;'>邮箱:" . $post['emails'] . "</a><br/>";
                $mailbody['request'] = "<a style='font-size:16px;color:#000;font-family:微软雅黑;text-decoration:none;'>需求:" . $post['xuqiu'] . "</a><br/>";
                $str = implode('', $mailbody);
                $res = send_mail($post['emails'], $post['names'], $str);
                if ($res) {
                    cookie('send_mail', 'hahaha', 3600);
                    return Handler::success('留言成功');
                }
            }
        }
        return Handler::fail('留言失败，请再试一次');
    }



    //发送邮箱验证码
    public function email()
    {
        $toemail = 'shhuangyan1@163.com';//定义收件人的邮箱

        $mail = new \phpmailer\phpmailer();

        $mail->isSMTP();// 使用SMTP服务
        $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host = "ssl://smtp.qq.com";// 发送方的SMTP服务器地址
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Username = "395442161@qq.com";// 发送方的QQ邮箱用户名，就是自己的邮箱名
        $mail->Password = "lxceswlyrpbwcajg";// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
        $mail->SMTPSecure = "ssl";// 使用ssl协议方式,
        $mail->Port = 465;// QQ邮箱的ssl协议方式端口号是465/587

        $mail->setFrom("395442161@qq.com","玫瑰沸腾");// 设置发件人信息，如邮件格式说明中的发件人,
        $mail->addAddress($toemail,'玫瑰沸腾');// 设置收件人信息，如邮件格式说明中的收件人
        //$mail->addReplyTo("xxxxx@qq.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件


        $mail->Subject = "玫瑰沸腾测试邮件";// 邮件标题
        //$mail->Body = "邮件内容是 <b>我就是玩玩</b>，哈哈哈！";// 邮件正文
        //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用
        $mail->Body['name']="姓名:".$_POST['names'];
        $mail->Body['phone']="电话:".$_POST['phone'];
        $mail->Body['emails']="邮箱:".$_POST['emails'];
        $mail->Body['request']="需求:".$_POST['xuqiu'];
        $str=implode('',$mail->Body);
        $mail->Body=$str;
        if(!$mail->send()){// 发送邮件
            echo "Message could not be sent.";
            echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
        }else{
            echo "<script style='content:text/html'; charset='utf-8';>alert('邮件发送成功!')</script>";
            echo '<script>location.href="index"</script>';

            exit();
        }
    }

    public function index(){
        $this->redirect('home/index/lianxi');
    }
}