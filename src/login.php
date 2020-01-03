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

    $number = mysqli_num_rows($connection->confirmLogin($conn,$userName,$password));
    if ($number > 0) {
        $_SESSION['userName']=$userName;
        echo '<script>window.location="main.php";</script>';
    } else {
        echo '<script>alert("Wrong username or password£¡");history.go(-1);</script>';
    }
} elseif (isset($_POST['logout'])) { // logout function(not implement)
    unset($_SESSION);
    session_destroy();
    echo '1';
}

$connection->closeDB($conn);