<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>用户登录 21-4</title>
</head>
<body>
	<b>使用 MVC 框架实现的用户登录系统</b><hr / >
	用户登录
	<form id="form1" name="form1" method="post" action="userController.php?act=login">
		<table>
			<tr>
				<td>用户名：</td>
				<td><input type="text" name="username" id="username" /></td>
			</tr>
			<tr>
				<td>密 码：</td>
				<td><input type="password" name="password" id="password" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input name="" type="submit" value="提交" /></td>
			</tr>
		</table>
	</form>
</body>
</html>