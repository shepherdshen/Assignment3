<?php
//The main page after login
session_start();
$userName = $_SESSION['userName'];

echo "hello,";
echo $userName;