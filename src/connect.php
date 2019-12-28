<?php
class Connect{

    //Please input YOUR database info
    static $mysql_servername = 'localhost';
    static $mysql_username = 'root';
    static $mysql_password = '';
    static $mysql_database = 'assignment3';
    
    //connect to db
    function connectDB(){
        $conn=new mysqli(self::$mysql_servername,self::$mysql_username,self::$mysql_password,self::$mysql_database);
        
        //connection state
        if (mysqli_connect_errno($conn)){
            die("connection to db failed" . mysqli_connect_error());
        }else{
            echo "connection to db <br>";
        }
        //set utf8
        mysqli_query($conn, "set names utf8");
        return $conn;
    }
    function query($conn,$string) {
        return mysqli_query($conn, $string);
    }
    function closeDB($conn){
        mysqli_close($conn);
    }
   
}