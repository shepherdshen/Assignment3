<?php
session_start();
$userName = $_SESSION['userName'];

require_once ("dbConnector.php");
$connection = new dbConnector();
$conn = $connection ->connectDB();

//get posts from create.php
$message = (string)$_POST['message'];
if(empty($_POST['anonymous'])){
    $anonymous = "no";
}else $anonymous = "yes";

//validation
if (empty($_POST)) {
    echo '<script>alert("Your data is over post_max_sizem please try again");history.go(-1);</script>';
    exit();
}
if ($message == '') {
    echo '<script>alert("You have no secret!");history.go(-1);</script>';
    exit();
}
if (strlen($message)>255) {
    echo '<script>alert("You can most input 255 characters!");history.go(-1);</script>';
    exit();
}
//uploads user information to database
$connection->insertSecret($conn, $userName, $message, $anonymous);

echo '<script>window.location="main.php";</script>';

$connection->closeDB($conn);