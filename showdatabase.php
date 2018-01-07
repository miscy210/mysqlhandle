<?php
    $hostname=$_COOKIE['hostname'];
    $username=$_COOKIE['username'];
    $password=$_COOKIE['password'];
    $con = mysql_connect($hostname,$username,$password);
    if (!$con)
    {
    	die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("information_schema", $con);
    mysql_query("set names 'utf8'");
    $result = mysql_query("SELECT SCHEMA_NAME FROM SCHEMATA");
    while($row = mysql_fetch_array($result))
    {
    	echo "<li><span>" . $row['SCHEMA_NAME'] . "</span></li>" ;
    }
    mysql_close($con);
?>