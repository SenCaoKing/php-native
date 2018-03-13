<?php
require_once('db.php'); //导入数据库操作类 21-2
session_start(); //启用session
/**
 * 用户模型类
 */
class User {
	var $db; //用户数据库

	function __construct() { //构造函数，链接数据库
		$this->db = new DB("mysql:dbname=native_php;host=localhost", 'root', 'root');
	}
	/**
	 * 添加用户
	 * @param [type] $username [description]
	 * @param [type] $password [description]
	 */
	function add_user($username, $password) {
		$_bool = $this->db->get_col("SELECT COUNT(1) FROM user WHERE username = ?", array($username));
		if($_bool) {
			return -1;
		}
		$_result = $this->db->insert('user', array('username'=>$username, 'password'=>$password));
		if($_result) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * 用户登录
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	function login($username, $password) {
		$_user = $this->db->get_one("SELECT * FROM user WHERE username = ? AND password = ?", array($username, $password));
		if($_user) {
			$_SESSION['user_id'] = $_user['user_id'];
			$_SESSION['username'] = $_user['username'];
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 用户注销
	 * @return [type] [description]
	 */
	function logout() {
		$_SESSION['user_id'] = '';
		return 1;
	}

	
}


?>