<?php
session_start();
$userName = $_SESSION['userName'];
echo "Congratulations!<br>";
echo "Your username is:" . $userName;
