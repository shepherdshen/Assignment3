<?php
session_start();

require_once ("Connect.php");
$connection = new Connect();
$conn = $connection ->connectDB();

if (isset($_POST['login'])) { // login function
    $userName = stripslashes(trim($_POST['userName']));
    $password = stripslashes(trim($_POST['password']));
    if (empty($userName)) {
        echo '<script>alert("Username can\'t be empty!");history.go(-1);</script>';
        exit();
    }
    if (empty($password)) {
        echo '<script>alert("Password can\'t be empty!");history.go(-1);</script>';
        exit();
    }

    $sql = "select userName,password from user where userName = '$_POST[userName]' and password = '$_POST[password]'";
    $result = $connection->query($conn,$sql);
    $number = mysqli_num_rows($result);
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

// mysqli_free_result($result);
// mysqli_close($conn);