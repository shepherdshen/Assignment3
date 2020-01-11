<?php

/**
 * @author sjs22
 *  database function
 */
class dbConnector
{

    // Please Input Your Local Database Info
    private static $mysql_servername = 'localhost';

    private static $mysql_username = 'root';

    private static $mysql_password = '';

    private static $mysql_database = 'showyoursecretdb';

    /**
     * connect to db
     * @return mysqli
     */
    public function connectDB()
    {
        $conn = new mysqli(self::$mysql_servername, self::$mysql_username, self::$mysql_password, self::$mysql_database);

        // connection state
        if (mysqli_connect_errno($conn)) {
            die("connection to db failed" . mysqli_connect_error());
        }
        // else{ //used to test db connection
        // echo "connection to db <br>";
        // }
        // set utf8
        mysqli_query($conn, "set names utf8");
        return $conn;
    }

    /**
     * close db
     * @param $conn
     */
    public function closeDB($conn)
    {
        mysqli_close($conn);
    }

    public function query($conn, $string)
    {
        return mysqli_query($conn, $string);
    }

    /**
     * check if your username and password are both correct
     * @param $conn
     * @param $userName
     * @param $password
     * @return boolean
     */
    public function confirmLogin($conn, $userName, $password)
    {
        $sql = "select user_name,password from user where user_name = '$userName' and password = '$password'";
        $number = mysqli_num_rows(mysqli_query($conn, $sql));
        if ($number > 0) {
            return true;
        } else
            return false;
    }

    /**
     * check if user_name has existed
     * @param $conn
     * @param $userName
     * @return boolean
     */
    public function confirmUserName($conn, $userName)
    {
        $sql = "select user_name from user where user_name = '$userName'";
        $number = mysqli_num_rows(mysqli_query($conn, $sql));
        if ($number > 0) {
            return true;
        } else
            return false;
    }

    /**
     * query user_name by secret_id
     * @param $conn
     * @param $secret_id
     * @return string|"anonymous" or user_name
     */
    public function queryUserName($conn, $secret_id, $gender, $interests)
    {
        $sql = "select user_id from secret where secret_id = '$secret_id'";
        $result = mysqli_query($conn, $sql);
        $number = mysqli_num_rows($result);
        if ($number == 0) {
            return "";
        } else{
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
        }
        if($gender ==""){
            if($interests ==""){
                $sql2 = "select user_name from user where user_id = '$user_id'";
            } else
                $sql2 = "select user_name from user where user_id = '$user_id' and interests = '$interests'";
        } else{
            if($interests ==""){
                $sql2 = "select user_name from user where user_id = '$user_id' and gender = '$gender'";
            } else
                $sql2 = "select user_name from user where user_id = '$user_id' and interests = '$interests' and gender = '$gender'";
        }
        
        $result2 = mysqli_query($conn, $sql2);
        if($result2==false){
            return "";
        }else
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $sql3 = "select anonymous from secret where secret_id = '$secret_id'";
            $result3 = mysqli_query($conn, $sql3);
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $anonymous = $row3['anonymous'];
                if ($anonymous == "yes") {
                    return "anonymous";
                } else
                    return $row2['user_name'];
            }
        }
    }
    }

    
    /**
     * query secret_content by secret_id
     * @param $conn
     * @param $secret_id
     * @return string
     */
    public function querySecretById($conn, $secret_id)
    {
        $sql = "select secret_content from secret where secret_id = '$secret_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            return $row['secret_content'];
        }
    }

    public function queryYourSecretById($conn, $secret_id,$userName)
    {
        $sql0 = "select user_id from secret where secret_id = '$secret_id'";
        $result = mysqli_query($conn, $sql0);
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $sql1 = "select user_name from user where user_id = '$user_id'";
            $result = mysqli_query($conn, $sql1);
            while ($row1 = mysqli_fetch_assoc($result)) {
                $user_name = $row1['user_name'];
            }
            if($user_name==$userName){
                $sql = "select secret_content from secret where secret_id = '$secret_id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    return $row['secret_content'];
                }
            }else return "";
        }
        
        
    }
    /**
     * query number of secrets in db
     * @param $conn
     * @return int
     */
    public function querySecretNumber($conn)
    {
        $sql = "select MAX(secret_id) as max_id from secret";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            return $row['max_id'];
        }
    }

    /**
     * query my_picture_name
     * @param $conn
     * @param $user_id
     * @return string
     */
    public function queryMyPictureName($conn,$user_name){
        $sql = "select my_picture_name from user where user_name = '$user_name'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $pictureName = $row['my_picture_name'];
            if($pictureName ==""){
                return "default.jpg";
            }
            else return $pictureName;
        }   
    }
    
    /**
     * delete secret by secret_id
     * @param $conn
     * @param $secret_id
     * @return
     */
    public function deleteSecretById($conn,$secret_id){
        $sql = "delete from secret where secret_id = '$secret_id'";
        return mysqli_query($conn, $sql);
    }
    
    public function deleteSecret($conn,$user_name,$secret_content){
        $sql = "select user_id from user where user_name = '$user_name'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $sql2 = "delete from secret where user_id = '$user_id' and secret_content = '$secret_content'";
            return mysqli_query($conn, $sql2);
        }
    }
    
    public function deleteSecretByAnonymous($conn,$secret_content){
        
            $sql = "delete from secret where secret_content = '$secret_content'";
            return mysqli_query($conn, $sql);
        
    }
    /**
     * insert user
     * @param $conn
     * @param $userName
     * @param $password
     * @param $gender
     * @param $interests
     * @param $myPictureName
     * @param $remark
     * @return
     */
    public function insertUserInfo($conn, $userName, $password, $gender, $interests, $myPictureName, $remark)
    {
        $sql = "insert into user values(null, '$userName', '$password', '$gender', '$interests', '$myPictureName', '$remark')";
        return mysqli_query($conn, $sql);
    }

    /**
     * insert secret
     * @param $conn
     * @param $userName
     * @param $secretContent
     * @param $anonymous
     * @return
     */
    public function insertSecret($conn, $userName, $secretContent, $anonymous)
    {
        $sql = "insert into secret(secret_id,user_id,secret_content,anonymous) values(null, (select user_id from user where user_name = '$userName'),'$secretContent','$anonymous')";
        return mysqli_query($conn, $sql);
    }
}