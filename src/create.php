<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>Main page</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

.hello {
	text-align: right;
	font-size: 35px;
	height: 70px;
	border-bottom-style: dotted;
	border-color: blue;
	
	
}
.text {
   text-align: center;
   font-size: 35px;
}
.btn {
   width:80px;
   height:60px;
}
</style>
</head>
<body>
<div class = "hello">
<img alt="logo" src="image/logo.png">
<?php
// The create page after main page
session_start();
$userName = $_SESSION['userName'];

echo "hello,";
echo $userName;
?>
</div>
<div class = "text">
<form action="create_process.php" method="POST" enctype="multipart/form-data">
<textarea name="message" rows="10" cols="150"></textarea><br>
<input type="checkbox" name="anonymous" value="Anonymous">Anonymous<br>
<input type="submit" value="Submit" class="btn">
<input type="reset" value="Reset" class="btn">
</form>
</div>
</body>
</html>