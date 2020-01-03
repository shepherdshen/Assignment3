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

.filter {
	font-size:30px;
	text-align: center;
	border-bottom-style: dotted;
	border-color: blue;
	height: 300px;
	float: left;
	width: 50%;
	border-right-style: solid;
	position: absolute;
	margin: 0;
	padding: 0;
}
.filbtn {
    width: 60px;
    height: 40px;

}

.create {
	margin: 0;
	padding: 0;
	height: 300px;
	border-bottom-style: dotted;
	border-color: blue;
	float: right;
	width: 50%; 
	position:relative;
	margin: 0 auto;
}

.crebtn{
	width: 100px;
	height: 60px;
	
	
	margin-top: 120px;
}
</style>
</head>
<body>
   
	<div class ="hello">
	<img alt="logo" src="image/logo.png">
<?php
// The main page after login
session_start();
$userName = $_SESSION['userName'];

echo "hello,";
echo $userName;
?>
</div>

	<div class="filter">
		<form>
			<table align="center">
				<caption>Filter</caption>
				<tr>
					<th>Gender</th>
					<td align="left"><input type="radio" name="gender" value="male">
					Male</td>
				</tr>
				<tr>
					<td></td>
					<td align="left"><input type="radio" name="gender" value="female">
					Female</td>
				</tr>
				<tr>
					<th>Hobby</th>
					<td align="left"><input type="checkbox" name="interests[]" value="music">
					Music</td>
				</tr>
				<tr>
					<td></td>
					<td align="left"><input type="checkbox" name="interests[]" value="game">
					Game</td>
				</tr>
				<tr>
					<td></td>
					<td align="left"><input type="checkbox" name="interests[]" value="film">
					Film</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Filter" class="filbtn"></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="create" align="center" vertical-align ="middle">
		<form action=create.php method="POST">
			<input type="submit" value="Create" class="crebtn">
		</form>
	</div>

</body>
</html>