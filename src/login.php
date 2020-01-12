<?php
session_start();

require_once ("dbConnector.php");
$connection = new dbConnector();
$conn = $connection ->connectDB();

//get posts from index.php
$userName = $_POST['userName'];
$password = $_POST['password'];

if (isset($_POST['login'])) { // login function
    $userName = stripslashes(trim($userName));
    $password = stripslashes(trim($password));
    if (empty($userName)) {
        echo '<script>alert("Username can\'t be empty!");history.go(-1);</script>';
        exit();
    }
    if (empty($password)) {
        echo '<script>alert("Password can\'t be empty!");history.go(-1);</script>';
        exit();
    }

    if ($connection->confirmLogin($conn,$userName,$password)) {
        $_SESSION['userName']=$userName;
        echo '<script>window.location="main.php";</script>';
    } else {
        echo '<script>alert("Wrong username or password£¡");history.go(-1);</script>';
    }
}

$connection->closeDB($conn);