<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<title>Login</title>
</head>
<body>
	<div class="login">
		<a href="index.php"><img alt="logo" src="image/logo.png"></a>
		<form action="login.php" method="post">
		<div id="login_form">
			<h1><br>Username:</h1>
			<p>
				<input type="text" class="input"
					name="userName" id="userName" />
			</p>
			<h1><br>Password:</h1>
			<p>
				<input type="password" class="input"
					name="password" id="password" />
			</p>
			<div class="sub">
				<input type="submit" name="login" class="btn" value="Login" />&emsp;
				<input type="button" onclick="window.location.href='register.html'" class="btn" value="Register">
			</div><br>
		</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>
</html>
<?php
 