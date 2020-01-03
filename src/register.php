<?php
session_start();

require_once ("fileSystem.php");
require_once ("dbConnector.php");
$connection = new dbConnector();
$conn = $connection ->connectDB();

//get posts from register.html
$userName = $_POST['userName'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$gender = $_POST['gender'];
$remark = $_POST['remark'];
$myPictureName = $_FILES['myPicture']["name"];

//validation
if (empty($_POST)) {
    echo '<script>alert("Your data is over post_max_sizem please try again");history.go(-1);</script>';
    exit(0);
}
if ($userName == '') {
    echo '<script>alert("Please input your username!");history.go(-1);</script>';
    exit(0);
}
// check if username is occupied
$resultSet = $connection->confirmUserName($conn, $userName);
if (mysqli_num_rows($resultSet) > 0) {
    echo '<script>alert("The username is occupied");history.go(-1);</script>';
    exit(0);
}
if ($password == '') {
    echo '<script>alert("Please input your password!");history.go(-1);</script>';
    exit(0);
}
// check if password is confirmed 
if ($password != $confirmPassword) {
    echo '<script>alert("Password and Confirm password are different!");history.go(-1);</script>';
    exit(0);
}
//collect interests as a string
if (empty($_POST['interests'])) {
    $interests = "";
} else {
    $interests = implode(";", $_POST['interests']);
}

//uploads user information to database
$fileS = new fileSystem();
$message = $fileS ->upload($_FILES['myPicture'], "uploads");
if ($message == "upload complete" || $message == "no upload") {
    $connection->insertUserInfo($conn,$userName,$password,$gender,$interests,$myPictureName,$remark);
//     echo "register your picture complete<br>";
} else {
    exit($message);
}

$_SESSION['userName']=$userName;
echo '<script>window.location="registered.php";</script>';

$connection->closeDB($conn);
