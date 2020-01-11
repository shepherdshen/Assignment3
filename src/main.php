<!DOCTYPE html>

<html>

<head>
<link rel="stylesheet" type="text/css" href="main.css">
<meta charset="UTF-8">

<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />

<title>Main page</title>






</head>

<body onload ="output()">

	<div class="top">

		<div class="img">
		<a href="/my_php/Assignment3/src/main.php"><img src="image/logo.png" /></a>
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

echo "Hello ";

echo $userName;
?>

</div>

	</div>

	<div class="filter">

		<form action=main.php method="POST">

			<table>

				

				<tr>

					<th>Gender</th>

					<td><input type="radio" name="gender" value="male">


						Male</td>


					<td><input type="radio" name="gender" value="female">

						Female</td>

				</tr>

				<tr>

					<th>Hobby</th>


					<td><input type="checkbox" name="interests[]"
						value="music"> Music</td>

					<td><input type="checkbox" name="interests[]"
						value="game"> Game</td>

					<td><input type="checkbox" name="interests[]"
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