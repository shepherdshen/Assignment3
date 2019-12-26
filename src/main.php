<?php
session_start();
$userName = $_SESSION['userName'];

echo "hello,";
echo $userName;