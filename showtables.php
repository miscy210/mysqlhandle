<?php
	header("Content-Type: text/html; charset=utf-8");
	if(!isset($_GET['database'])){
		die('请先选择一个数据库！');
	}
    $hostname=$_COOKIE['hostname'];
    $username=$_COOKIE['username'];
    $password=$_COOKIE['password'];
    $database=$_GET['database'];
    $con = mysql_connect($hostname,$username,$password);
    if (!$con)
    {
    	die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("information_schema", $con);
    mysql_query("set names 'utf8'");
    $result = mysql_query("SELECT table_name FROM tables WHERE table_schema='" . $database . "'");
    while($row = mysql_fetch_array($result))
    {
    	echo "<li><span>" . $row['table_name'] . "</span></li>" ;
    }
    mysql_close($con);
?>