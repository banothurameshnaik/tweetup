<?php
include_once("login_status.php");
if(!$user_ok)
	header("Location:index.php");
?>
<?php
$chat_history = "";
$qry = "SELECT DISTINCT sender,receiver FROM messages WHERE sender = '$log_username' OR receiver = '$log_username'";
$sql = mysqli_query( $conn , $qry );
if(mysqli_num_rows($sql) <= 0)
	$chat_history = "<span style='color:green;'>no records found</span>";

if(mysqli_num_rows($sql) <= 2)
{
	while($row = mysqli_fetch_array($sql))
	{
		if($row['sender'] == $log_username)
			$counterpart = $row['receiver'];
		else
			$counterpart = $row['sender'];

		$chat_history .= "<a href='chat.php?user=$counterpart'>$counterpart</a><br>";
		break;
	}
}
?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
<h4 style='color:#ff00ef;'>Chat History</h4><br><br>
<?php echo $chat_history; ?>
</body>

</html>

<?php include_once("footer.php"); ?>
