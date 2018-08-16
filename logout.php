<?php
include_once("database/db_connect.php");
session_start();
/*$id = $_SESSION['id'];*/
$uname = $_SESSION['username'];
$qry = "UPDATE users SET login_stat='0' WHERE username='$uname'";
$sql = mysqli_query($conn,$qry);

$_SESSION = array();
/*if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
    $_COOKIE['id'] = setcookie("id",'',strtotime('-5 days'),'/');
    $_COOKIE['username'] = setcookie("username",'',strtotime('-5 days'),'/');
    $_COOKIE['password'] = setcookie("password",'',strtotime('-5 days'),'/');
}*/
session_destroy();

if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
    header("Location:message.php?message=Unable to LOGOUT");
}
else if($sql)
    header("Location:login.php");
?>
