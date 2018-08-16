<?php
include_once("login_status.php");
if(!$user_ok)
{
	header("Location:login.php?_Nto=chat");
}

$qry = "SELECT * FROM messages WHERE read_status='0' AND receiver='$log_username'";
$sql = mysqli_query( $conn,$qry );
$all_notif = "";
$unread_no = 0;
while($row  = mysqli_fetch_array($sql))
{
	$sender = $row['sender'];
	$qry2 = "SELECT id FROM messages WHERE read_status='0' AND receiver='$log_username' AND sender='$sender'";
	$sql2 = mysqli_query( $conn,$qry2 );
	$msg_cnt = mysqli_num_rows($sql2);
	
	$all_notif .= "<a href='chat.php?user=$sender'><div>You have $msg_cnt messages from $sender</div></a><br>";
	$unread_no++;
}
if($unread_no == 0)
	$all_notif = "<div style='color:green;text-align:center;margin-top:100px;'>You don't have any notifications</div>";

?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<?php echo $all_notif; ?>
</body>

</html>

<?php include_once("footer.php"); ?>
