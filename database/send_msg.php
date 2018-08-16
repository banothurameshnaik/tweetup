<?php include_once("../login_status.php"); ?>

<?php
if( isset($_POST['msg']) && $_POST['recvr'] )
{
	$ip = preg_replace('#[^0-9.]#' , '' , getenv('REMOTE_ADDR'));
	$receiver = $_POST['recvr'];
	$message = $_POST['msg'];
        $qry = "INSERT INTO messages(sender,receiver,message,ip,read_status,time) VALUES ('$log_username','$receiver','$message','$ip','0',now())";
        $sql = mysqli_query($conn,$qry);
        if($sql)
        {
            echo "message_sent";
        }
        else
        {
            echo "message_not_sent";
        }
}
?>
