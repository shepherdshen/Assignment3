<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>Main page</title>

</head>
<body onload="output()">
	<div class="top">
		<div class="img">
			<a href="main.php"><img alt="logo" src="image/logo.png"></a>
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
            $userName = $_SESSION['userName'];
            $pictureName = $connection->queryMyPictureName($conn, $userName);
            $_SESSION['pictureName'] = $pictureName;
            echo "<img src='uploads/$pictureName' />";
            echo " Hello, ";
            echo $userName;
            ?>
            <a href="index.php">Log out</a>
		</div>

	</div>

	<div class="filter">
		<form action=main.php method="POST">
			<table align="center">
				<caption>Filter secrets</caption>
				<tr>
					<th>Gender:</th>
					<td align="left"><input type="radio" name="gender" value="male">
						Male</td>
					<td align="left"><input type="radio" name="gender" value="female">
						Female</td>
				</tr>
				<tr>
					<th>Hobby:</th>
					<td align="left"><input type="checkbox" name="interests[]"
						value="music"> Music</td>
					<td align="left"><input type="checkbox" name="interests[]"
						value="game"> Game</td>
					<td align="left"><input type="checkbox" name="interests[]"
						value="film"> Film</td>
				</tr>
			</table>
			<input type="submit" name="filter" value="Filter" class="filbtn">
		</form>
	</div>
	<div class="create" align="center" vertical-align="middle">
		<form action=create.php method="POST">
			<input type="submit" value="Create" class="crebtn">
		</form>
	</div>

	<div id="morediv" class="bigdiv">
<?php
// function to output one piece of username and secret,
// which is used in output() in js as a loop to display all information
$number = $connection->querySecretNumber($conn);
$GLOBALS['i'] = $number;

function Output()
{
    while ($GLOBALS['i'] > 0) {
        $gender = "";
        $interests = "";
        // get posts from main.php
        if (isset($_POST['filter'])) {
            if (empty($_POST['gender'])) {
                $gender = "";
            } else {
                $gender = $_POST['gender'];
            }
            if (empty($_POST['interests'])) {
                $interests = "";
            } else {
                $interests = implode(";", $_POST['interests']);
            }
        }
        global $connection, $conn;
        $resultUserName = $connection->queryUserName($conn, $GLOBALS['i'], $gender, $interests);
        $resultPicture = $connection->queryMyPictureName($conn, $resultUserName);
        $resultSecret = $connection->querySecretById($conn, $GLOBALS['i']);
        if ($resultUserName == "") {
            $GLOBALS['i'] --;
            Output();
        } else {
            echo "<div style = 'float:left;width: 600px;height: 250px;margin-left: 150px;'>";
            echo "<div style = 'float:left;width: 100px;height: 100px;'>";
            echo "<img src='uploads/$resultPicture' />";
            echo "</div>";
            echo "Username: $resultUserName <br>";
            echo "Secret: ";
            $str_len = strlen($resultSecret);
            for ($i = 0; $i <= $str_len; $i += 30) {
                $sub_str = substr($resultSecret, $i, 30);
                echo "$sub_str <br>";
            }
            echo "</div>";
            $GLOBALS['i'] --;
        }
    }
}
?>
<script type="text/javascript">
function output(){
    var html1 = '';
    html1 +="<div style='margin-top: 260px;margin-left: 100px;width: 1600px;font-size:30px;text-align:center;'><?php Output(); ?></div>";
    document.getElementById('morediv').innerHTML = html1;
}
</script>
	</div>

</body>
</html>