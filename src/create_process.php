<?php
session_start();
$userName = $_SESSION['userName'];

//connect to db
require_once ("dbConnector.php");
$connection = new dbConnector();
$conn = $connection->connectDB();

// get posts from create.php
$message = (string) $_POST['message'];
if (empty($_POST['anonymous'])) {
    $anonymous = "no";
} else
    $anonymous = "yes";

// validation the input of secret
if (empty($_POST)) {
    echo '<script>alert("Your data is over post_max_sizem please try again");window.location="create.php";</script>';
    exit();
}
if ($message == '') {
    echo '<script>alert("You have no secret!");window.location="create.php";</script>';
    exit();
}
if (strlen($message) > 100) {
    echo '<script>alert("You can most input 100 characters!");window.location="create.php";</script>';
    exit();
}
// uploads user information to database
$connection->insertSecret($conn, $userName, $message, $anonymous);

echo '<script>window.location="main.php";</script>';

$connection->closeDB($conn);