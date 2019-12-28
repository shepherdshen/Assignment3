<?php
require_once ("fileSystem.php");
require_once ("Connect.php");
$connection = new Connect();
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
$userNameSQL = "select * from user where userName = '$userName'";
$resultSet = $connection->query($conn, $userNameSQL);
if (mysqli_num_rows($resultSet) > 0) {
    echo '<script>alert("The username is occupied");history.go(-1);</script>';
    exit(0);
} else {
    echo "good name<br>";
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
$registerSQL = "insert into user values(null, '$userName', '$password', '$gender', '$interests', '$myPictureName', '$remark')";
$message = upload($_FILES['myPicture'], "uploads");
if ($message == "upload complete" || $message == "no upload") {
    $connection->query($conn, $registerSQL);
    $userID = mysqli_insert_id($conn);
    echo "register succeed<br>";
} else {
    exit($message);
}

$userSQL = "select * from user where id = '$userID'";
$userResult = $connection->query($conn, $userSQL);
if ($user = mysqli_fetch_array($userResult,MYSQLI_ASSOC)) {
    echo "Your username is:" . $user['userName'];
} else {
    exit("register failed£¡");
}

//close db
// mysqli_free_result($resultSet);
// mysqli_free_result($userResult);
$connection->closeDB($conn);
