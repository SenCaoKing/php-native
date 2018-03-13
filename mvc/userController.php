<?php
header("content-type:text/html;charset=utf-8");  //设置编码
require_once('userModel.php'); //引入用户模型 21-5

$user = new User(); //模型类对象化

$username = $_REQUEST['username']; //取得提交的 username
$password = $_REQUEST['password']; //取得提交的 password
if($_REQUEST['act'] == 'login') { //判断请求是否是 login
	if($user->login($username, $password)) { //调用模型层的 login 方法
		echo '欢迎 '.$_SESSION['username'].'<br />'; //欢迎消息
		echo '登录成功！'; //成功的结果
		echo '<a href="userController.php?act=logout">注销</a>';
	} else {
		echo '登陆失败！'; //失败后的结果
	}
} elseif ($_REQUEST['act'] == 'logout') { //如果是注销
	$user->logout(); //调用模型层的 logout 方法
	echo '注销成功！'; 
} elseif ($_REQUEST['act'] == 'add_user') { //如果是新增用户
	$result = $user->add_user($username, $password); //调用模型层的 add_user 方法
	if($result == -1) {
		echo '已存在该用户';
	} elseif($result == 1) {
		echo '注册成功！'; //提示注册成功
	} else {
		echo '注册失败！';
	}
} else { //如果请求参数错误
	echo '参数错误！'; //提示参数错误
}
	
?>