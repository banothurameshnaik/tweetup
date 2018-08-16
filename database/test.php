<?php
include_once("db_connect.php");

$pass = md5('nanvr54');
$qry = "UPDATE users SET password='$pass' WHERE id='1'";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "yes";
echo $pass;
?>
