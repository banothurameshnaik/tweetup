<?php
$now = date('m-d-Y g:i:sA');
include_once("database/db_connect.php");
session_start();

$user_ok = false;
/*$log_id = "";*/
$log_username = "";
$log_password = "";
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
    /*$log_id = $_SESSION['id'];*/
    $log_username = $_SESSION['username'];
    $log_password = $_SESSION['password'];

    $user_ok = usercheck($conn,$log_username,$log_password);
}
/*else if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
    
    $log_username = $_COOKIE['username'];
    $log_password = $_COOKIE['password'];

    
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['password'] = $_COOKIE['password'];
    $user_ok = usercheck($conn,$log_username,$log_password);
}
*/
function usercheck($conn,$u,$p)
{
    $qry = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $sql = mysqli_query($conn,$qry);
    $sql == true ?  $rows = mysqli_num_rows($sql) : $rows =0;
    if($sql)
	{
	$arr = mysqli_fetch_array($sql);
        $log_stat = $arr['login_stat'];
   	 if($rows >0 && $log_stat =='1')
	 {
	 	return true;
	 }
	}
}
?>
