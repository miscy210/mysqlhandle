<?php
    $hostname=$_COOKIE['hostname'];
    $username=$_COOKIE['username'];
    $password=$_COOKIE['password'];
    $database=$_GET['database'];
    $table=$_GET['table'];
    $con = mysql_connect($hostname,$username,$password);
    if (!$con)
    {
    	die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("information_schema", $con);
    mysql_query("set names 'utf8'");
    $result = mysql_query("SELECT COLUMN_NAME FROM Columns WHERE table_name='" . $table . "' AND table_schema='" . $database . "'");
    while($row = mysql_fetch_array($result))
    {
    	echo   '<li><a href="#"><i class="glyphicon"></i><span class="green">'. $row[COLUMN_NAME] .'</span></a></li>';
    }
    mysql_close($con);
?>