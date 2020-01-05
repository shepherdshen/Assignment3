<?php
require_once ("dbConnector.php");
$connection = new dbConnector();
$conn = $connection ->connectDB();

//get posts from main.php
$gender = $_POST['gender'];
if (empty($_POST['interests'])) {
    $interests = "";
} else {
    $interests = implode(";", $_POST['interests']);
}
