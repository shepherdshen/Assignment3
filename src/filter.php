<?php
require_once ("dbConnector.php");
global $connection;
global $conn;
$connection = new dbConnector();
$conn = $connection ->connectDB();

//get posts from main.php
$gender = $_POST['gender'];
if (empty($_POST['interests'])) {
    $interests = "";
} else {
    $interests = implode(";", $_POST['interests']);
}

$number = $connection->queryFilter($conn,$gender,$interests);
$GLOBALS['i'] = $number;
