<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="create.css">
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>Main page</title>

</head>
<body>
<div class = "hello">
<a href="/my_php/Assignment3/src/main.php"><img src="image/logo.png" /></a>
<?php
// The create page after main page
session_start();
$userName = $_SESSION['userName'];


?>
</div>
<div class = "text">
<div class="pretext">
<h1>Please tell your secret</h1>
</div>
<form action="create_process.php" method="POST" enctype="multipart/form-data">
<textarea name="message" rows="10" cols="150"></textarea><br>
<div id="input">
<input type="checkbox" name="anonymous" value="Anonymous">Anonymous<br>
</div>
<input type="submit" value="Submit" class="btn">
<input type="reset" value="Reset" class="btn">
</form>
</div>
</body>
</html>