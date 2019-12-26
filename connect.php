<?php

//YOUR DB INFO
$mysql_servername = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'assignment3';

//connect to db
$conn=mysqli_connect($mysql_servername,$mysql_username,$mysql_password,$mysql_database);

//connection state
if (mysqli_connect_errno($conn)){
    die("connection to db failed" . mysqli_connect_error());
}else{
    echo "connection to db success";
}

//set utf8
mysqli_query($conn, "set names utf8");