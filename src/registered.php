<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"

	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />

<title>Registered page</title>

<style type="text/css">

body{

  text-align:center;

}

.con{

width:800px;

height:200px;

font-size:50px;

text-align:center;

border-bottom-style: solid;

margin:0 auto;

margin-top: 100px;

}

.back{

width:120px;

height:60px;

margin-top:50px;

}

</style>

</head>

<body>

<div class = "con">  

<?php

session_start();

$userName = $_SESSION['userName'];

echo "Congratulations!<br>";

echo "Your username is:" . $userName;

?>

</div> 

<form action="index.php">

<input type="submit" value="Login now" class="back">

</form>

</body>

</html>