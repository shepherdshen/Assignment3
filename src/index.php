<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div id="login">
		<h3>User login</h3>
		<form action="login.php" method="post">
		<div id="login_form">
			<p>
				<label>User name:</label> <input type="text" class="input"
					name="userName" id="userName" />
			</p>
			<p>
				<label>Password:</label> <input type="password" class="input"
					name="password" id="password" />
			</p>
			<div class="sub">
				<input type="submit" name="login" class="btn" value="Login" />
				<input type="button" onclick="window.location.href='register.html'" value="Register">
			</div>
		</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>
</html>
<?php
