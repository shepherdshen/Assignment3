<?php
include_once ("fileSystem.php");
include_once ("connect.php");

//post
$userName = $_POST['userName'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$gender = $_POST['gender'];
$remark = $_POST['remark'];
$myPictureName = $_FILES['myPicture']["name"];

//validation
if (empty($_POST)) {
    exit("���ύ�ı����ݳ���post_max_size! <br>");
}
if ($userName == '') {
    echo '<script>alert("Input your username��");history.go(-1);</script>';
    exit(0);
}
if ($password == '') {
    echo '<script>alert("input password");history.go(-1);</script>';
    exit(0);
}
// �ж�����������ȷ�������Ƿ���ͬ
if ($password != $confirmPassword) {
    echo '<script>alert("password not the same");history.go(-1);</script>';
    exit(0);
}
// �ж��û����Ƿ��ظ�
$userNameSQL = "select * from user where userName = '$userName'";
$resultSet = mysqli_query($conn, $userNameSQL);
if (mysqli_num_rows($resultSet) > 0) {
    echo '<script>alert("Username has been occupied");history.go(-1);</script>';
    exit(0);
} else {
    echo "good name";
}

if (empty($_POST['interests'])) {
    $interests = "";
} else {
    $interests = implode(";", $_POST['interests']);
}

$registerSQL = "insert into user values(null, '$userName', '$password', '$gender', '$interests', '$myPictureName', '$remark')";
$message = upload($_FILES['myPicture'], "uploads");

if ($message == "�ϴ��ɹ�" || $message == "û���ϴ�") {
    mysqli_query($conn, $registerSQL);
    $userID = mysqli_insert_id($conn);
    echo "register succeed<br>";
} else {
    exit($message);
}

$userSQL = "select * from user where user_id = '$userID'";
$userResult = mysqli_query($conn, $userSQL);
if ($user = mysqli_fetch_array($userResult)) {
    echo "Your username is��" . $user['userName'];
} else {
    exit("register failed��");
}

mysqli_free_result($resultSet);
mysqli_free_result($userResult);
mysqli_close($conn);

