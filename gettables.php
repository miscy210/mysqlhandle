<?php
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
    echo "<option>选择数据表</option>";
    while($row = mysql_fetch_array($result))
    {
    	echo "<option>" . $row['table_name'] . "</option>" ;
    }
    mysql_close($con);
?>
