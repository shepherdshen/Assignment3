<?php
class dbConnector{
    
    //Please input YOUR database info
    private static $mysql_servername = 'localhost';
    private static $mysql_username = 'root';
    private static $mysql_password = '';
    private static $mysql_database = 'showyoursecretdb';
    
    //connect to db
    public function connectDB(){
        $conn=new mysqli(self::$mysql_servername,self::$mysql_username,self::$mysql_password,self::$mysql_database);
        
        //connection state
        if (mysqli_connect_errno($conn)){
            die("connection to db failed" . mysqli_connect_error());
        }
//         else{                               //used to test db connection
//             echo "connection to db <br>";
//         }
        //set utf8
        mysqli_query($conn, "set names utf8");
        return $conn;
    }
    public function closeDB($conn){
        mysqli_close($conn);
    }
    public function query($conn,$string) {
        return mysqli_query($conn, $string);
    }
    public function confirmLogin($conn,$userName,$password) {
        $sql = "select user_name,password from user where user_name = '$userName' and password = '$password'";
        
        return mysqli_query($conn, $sql);
    }
    public function confirmUserName($conn,$userName){
        $sql = "select user_name from user where user_name = '$userName'";
        return mysqli_query($conn, $sql);
    }
    public function queryUserName($conn,$id){
        $sql = "select user_id from secret where secret_id = '$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $user_id = $row['user_id'];
        }
        $sql2 = "select user_name from user where user_id = '$user_id'";
        return mysqli_query($conn, $sql2);
    }
//     public function querySecretContent($conn,$secretContent){
//         $sql = "select secret_content from secret where secret_content = '$secretContent'";
//         return mysqli_query($conn, $sql);
//     }
    public function querySecret($conn,$id){
        $sql = "select secret_content from secret where secret_id = '$id'";
        return mysqli_query($conn, $sql);
    }
    
    public function insertUserInfo($conn,$userName,$password,$gender,$interests,$myPictureName,$remark){
        $sql = "insert into user values(null, '$userName', '$password', '$gender', '$interests', '$myPictureName', '$remark')";
        return mysqli_query($conn, $sql);
    }
    public function insertSecret($conn,$userName,$secretContent,$anonymous){
        $sql = "insert into secret(secret_id,user_id,secret_content,create_time,anonymous) values(null, (select user_id from user where user_name = '$userName'),'$secretContent',null,'$anonymous')";
        return mysqli_query($conn, $sql);
    }
}