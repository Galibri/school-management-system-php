<?php

$db_name = "myschool_3";
$db_user = "root";
$db_pass = "";
$db_host = "localhost";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn) {
	die("Something went wrong! Please check your database connection!");
} 
