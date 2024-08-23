<?php

$server="localhost";
$user_name="root";
$password="";
$dbname='tutorial';
$conn= new mysqli($server,$user_name,$password,$dbname);

if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
//echo"connected successfully"
?>