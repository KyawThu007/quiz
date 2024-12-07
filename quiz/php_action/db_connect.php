<?php
$localhost="localhost";
$username="root";
$password="";
$dbname="quizdb";
//create connection
$connect=new mysqli($localhost,$username,$password,$dbname, 3307);
//check connecton
if($connect->connect_error){
    die("Connection failed : ".$connect->connect_error);
}
?>