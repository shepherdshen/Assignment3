<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="registered.css">
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>Registered page</title>
</head>
<body>
<div class="body">
<a href="index.php"><img alt="logo" src="image/logo.png"></a>
</div>
<div class = "con">  
<?php
session_start();
$userName = $_SESSION['userName'];
echo "Congratulations!<br>";
echo "Your username is:" . $userName;
?>
<form action="index.php">
<input type="submit" value="Login now" class="back">
</form>
</div> 

</body>
</html>