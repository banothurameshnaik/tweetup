<?php include_once("login_status.php"); ?>
<?php
$pass = md5("kumar558");
$qry = "UPDATE users SET password='' WHERE username='kumar'";

if(mysqli_query($conn,$qry))
	echo "yes";
?>
