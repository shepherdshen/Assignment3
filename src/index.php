<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="login">
	<img alt="logo" src="image/logo.png">
		<form action="login.php" method="post">
		<div id="login_form">
			
			<h2>Username:</h2>
			<p>
				<input type="text" class="input"
					name="userName" id="userName" />
			</p>
			<h2>Password:</h2>
			<p>
				<input type="password" class="input"
					name="password" id="password" />
			</p>
			
			<div class="sub">
				<input type="submit" name="login" class="btn" value="Login" />
				<input type="button" onclick="window.location.href='register.html'" value="Register">
		</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>
</html>
<?php
 