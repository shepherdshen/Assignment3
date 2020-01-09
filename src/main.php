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

.top {
	height: 70px;
	border-bottom-style: dotted;
	border-color: blue;
}

.img {
	float: left;
	height: 70px;
}

img {
	width: auto;
	height: auto;
	max-width: 100%;
	max-height: 100%;
}

.hello {
	text-align: right;
	font-size: 35px;
	height: 70px;
	border-bottom-style: dotted;
	border-color: blue;
}

.filter {
	font-size: 30px;
	text-align: center;
	border-bottom-style: dotted;
	border-color: blue;
	height: 180px;
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
	height: 180px;
	border-bottom-style: dotted;
	border-color: blue;
	float: right;
	width: 50%;
	position: relative;
	margin: 0 auto;
}

.crebtn {
	width: 100px;
	height: 60px;
	margin-top: 60px;
}

.bigdiv{
	margin-top: 260px;
	margin-left: 100px;
	width: 1300px;
	font-size:30px;
	text-align:center;
	
}

.box_1 {
	float: left;
	width: 500px;
	height: 250px;
	margin-left: 100px;
	background-color: blue;
}

.box_2 {
	float: right;
	width: 500px;
	height: 250px;
	margin-right: 100px;
	background-color: red;
}


</style>

</head>

<body onload ="output()">

	<div class="top">

		<div class="img">
			<img alt="logo" src="image/logo.png">
		</div>

		<div class="hello">



<?php

// connect to db
require_once ("dbConnector.php");

global $connection;

$connection = new dbConnector();

global $conn;

$conn = $connection->connectDB();

session_start();

$userName = $_SESSION['userName']; // need refactor

$pictureName = $connection->queryMyPictureName($conn, $userName);

echo "<img src='uploads/$pictureName' />";

echo "hello,";

echo $userName;
?>

</div>

	</div>

	<div class="filter">

		<form action=main.php method="POST">

			<table align="center">

				<caption>Filter</caption>

				<tr>

					<th>Gender</th>

					<td align="left"><input type="radio" name="gender" value="male">

						Male</td>

					<td align="left"><input type="radio" name="gender" value="female">

						Female</td>

				</tr>

				<tr>

					<th>Hobby</th>

					<td align="left"><input type="checkbox" name="interests[]"
						value="music"> Music</td>

					<td align="left"><input type="checkbox" name="interests[]"
						value="game"> Game</td>

					<td align="left"><input type="checkbox" name="interests[]"
						value="film"> Film</td>

				</tr>

				<tr>

					<td></td>

					<td><input type="submit" name="filter" value="Filter"
						class="filbtn"></td>

				</tr>

			</table>

		</form>

	</div>

	<div class="create" align="center" vertical-align="middle">

		<form action=create.php method="POST">

			<input type="submit" value="Create" class="crebtn">

		</form>

	</div>

	

<div id = "morediv" class = "bigdiv">
<?php 

// function Output() to display all secrets

$number = $connection->querySecretNumber($conn);

$GLOBALS['i'] = $number;

function Output()

{
    while($GLOBALS['i']>0)
    {

    $gender = "";

    $interests = "";

    // get posts from main.php

    if (isset($_POST['filter'])) {

        if (empty($_POST['gender'])) {

            $gender = "";
        } 
        else {

            $gender = $_POST['gender'];
        }

        if (empty($_POST['interests'])) {

            $interests = "";
        } else {

            $interests = implode(";", $_POST['interests']);
        }
    }

    if ($GLOBALS['i'] <= 0) {

        exit();
    }

    global $connection, $conn;

    $resultUserName = $connection->queryUserName($conn, $GLOBALS['i'], $gender, $interests);

    $resultSecret = $connection->querySecretById($conn, $GLOBALS['i']);

    if ($resultUserName == "") {

        $GLOBALS['i'] --;

        Output();
    } else {
        echo "<div style = 'float:left;width: 500px;height: 250px;margin-left: 100px;'>";
        echo "Username: $resultUserName <br>";

        echo "Secret: $resultSecret <br>";

        echo $GLOBALS['i']; // can be hidden
        echo "</div>";
      
        $GLOBALS['i'] --;
    }
    }
}

?>


<script type="text/javascript">

    function output(){
    var html1 = '';
    html1 +="<div style='margin-top: 260px;margin-left: 100px;width: 1300px;font-size:30px;text-align:center;'><?php Output(); ?></div>";
    document.getElementById('morediv').innerHTML = html1;
}
</script>
</div>

</body>
</html>