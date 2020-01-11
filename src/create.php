<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="create.css">
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>Create page</title>

</head>
<body onload = "output()">
<div class = "hello">
<img alt="logo" src="image/logo.png">
<?php
// The create page after main page
session_start();
global  $userName;
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
<div id = "manydiv" class="bigdiv">
<?php 

$userName = $_SESSION['userName'];
// connect to db
require_once ("dbConnector.php");

global $connection;

$connection = new dbConnector();

global $conn;

$conn = $connection->connectDB();

// function Output() to display all secrets


$number = $connection->querySecretNumber($conn);
$GLOBALS['i'] = $number;

function Output()
{
    while ($GLOBALS['i'] > 0) {
        global $userName;
        global $connection, $conn;
        $resultSecret = $connection->queryYourSecretById($conn, $GLOBALS['i'], $userName);
        if ($resultSecret == "") {
            $GLOBALS['i'] --;
            Output();
        } else {
            echo "<div style = 'float:left;width: 500px;height: 250px;margin-left: 100px;'>";
            echo "<form action='delete_process.php' method='POST' enctype='multipart/form-data'>";
            echo "Username: $userName <br>";
            echo "Secret: $resultSecret <br>";
            echo "<input type='hidden' name='userName' value='$userName'>";
            echo "<input type='hidden' name='secret' value='$resultSecret'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";
//             echo $GLOBALS['i']; 
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
    document.getElementById('manydiv').innerHTML = html1;
    }
    
</script>
</div>
</body>
</html>