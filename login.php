<?php
//��¼
if(!isset($_POST['submit'])){
    exit('�Ƿ�����!');
}
$hostname=htmlspecialchars($_POST['hostname']);
$port=htmlspecialchars($_POST['port']);
$username=htmlspecialchars($_POST['username']);
$password =htmlspecialchars($_POST['passwd']);
$conn = mysql_connect($hostname . ":" . $port,$username,$password);
if(!$conn){
	exit('���ݿ����ó�������˴� <a href="javascript:history.back(-1);">����</a> ����');
}else {
	setcookie('hostname',$hostname);
	setcookie('port',$port);
	setcookie('username',$username);
	setcookie('password',$password);
	header("Location:handle.php");
	exit();
}
?>