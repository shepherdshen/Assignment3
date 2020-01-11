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
<img alt="logo" src="image/logo.png">
</div>
<div class = "con">  
<?php
$user_name = $_POST['userName'];
$secret_content = $_POST['secret'];
// echo "$user_name";
// echo "$secret_content";

require_once ("dbConnector.php");
global $connection;
$connection = new dbConnector();
global $conn;
$conn = $connection->connectDB();

$connection->deleteSecret($conn, $user_name, $secret_content);
echo "Your secret has been deleted.";
?>
<form action="main.php">
<input type="submit" value="Back now" class="back">
</form>
</div>

</body>
</html>