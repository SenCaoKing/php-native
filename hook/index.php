<?php
class Test{
    public function index(){
        // 用户注册成功
        if('如果设置了发送短信'){
            // 发送短信
            senSms($phone);
        }

        if('如果设置了发送邮件'){
            // 发送邮件
            sendEmail($email);
        }

        // 其他操作...

        // 前往网站首页
    }
}

/**
 * 发送短信通知
 * @param integer $phone 手机号
 */
function sendSMS($phone){
    // 此处是发送短信的代码
}

/**
 * 发送邮件通知
 * @param string $email 邮箱地址
 */
function sendEmail($email){
    // 此处是发送邮件的代码
}

?>