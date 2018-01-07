<?php
//登录
if(!isset($_POST['submit'])){
    exit('非法访问!');
}
$hostname=htmlspecialchars($_POST['hostname']);
$port=htmlspecialchars($_POST['port']);
$username=htmlspecialchars($_POST['username']);
$password =htmlspecialchars($_POST['passwd']);
$conn = mysql_connect($hostname . ":" . $port,$username,$password);
if(!$conn){
	exit('数据库设置出错！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}else {
	setcookie('hostname',$hostname);
	setcookie('port',$port);
	setcookie('username',$username);
	setcookie('password',$password);
	header("Location:handle.php");
	exit();
}
?>