<?php

$username = "root";
$password = "";
$server = "localhost";
$db = 'test';

$con = mysqli_connect($server,$username,$password,$db);

if($con){
	
}else
{
echo "Connection failed";
}
?>