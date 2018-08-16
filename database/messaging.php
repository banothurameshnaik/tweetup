<?php include_once("../login_status.php"); ?>

<?php
if( isset($_POST['wtd']) && $_POST['wtd'] == "send" )
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

<?php
//Total ChatBox starts
if(isset($_POST['wtd']) && $_POST['wtd'] == "refresh")
{
    $chat_box = "";
    $receiver =$_POST['recvr'];
    $qry = "SELECT * FROM messages WHERE 
    			sender='$receiver' AND receiver='$log_username'
    			 OR 
    			sender='$log_username' AND receiver='$receiver' ORDER BY time ";
    
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    ($sql == true) ?   $rows :  $rows = 0;

    $msgs = "<span style='color:blue;font-size:16px;' id='active_header'> Chat Box : Talk with $receiver </span><br>";

    $i = 0;
    if($rows>0)
    {
    	while( $row = mysqli_fetch_array($sql) )
    	{
			$deleted_from =$row['deleted_from'];
    		if($deleted_from != $log_username)
    		{
		$msg_id = $row['id'];
		$time =  $row['time'];
		$msg = nl2br($row['message']);
		$stat = $row['read_status'];
		$sender = $row['sender'];
		
		$flt = ($sender == $log_username) ? ("right") : ("left");
		$stat_color = ($stat) ? ("82C27C") : ("ef0088") ;
		$font_wt = ($stat) ? ("normal") : ("bold") ;
    		$msgs .= "<div class='col-md-7 msg_image' id='msgs".$msg_id."' align='center'
    				 style='float:".$flt.";color:#".$stat_color.";cursor:hand;' 
    				 	onclick='msg_toggle_time(msgs".$msg_id.");'>";
    		$msgs .= "<span id='msg_msgs".$msg_id."' style='font-weight:".$font_wt.";'>$msg</span>";
    		$msgs .= "<div id='time_msgs".$msg_id."' style='color:black;font-size:12px;display:none;'>$time</div>";
    		$msgs .= "<span hidden='hidden' id='id_msgs".$msg_id."'>$msg_id</span>";
    		$msgs .= "</div><br>";
    		$i++;
    		 }          
    	}
    }
    else
    {
    	$msgs .= "<p style='color:gray;'>     No messages to read</p>";
    }
    
    //Print send message form
    $chat_box .=  "<span style='color:#1100ff;' id='talk_with'>Talk with $receiver</span><br>";
    $chat_box .= "<span id='s1'>Message :</span>";
    $chat_box .= "<textarea name='message' alt='message' id='message'></textarea><br>";
    $chat_box .= "<span id='send_stat'></span>";
    $chat_box .= "<input type='submit' value='Send' id='send_btn' onclick='sendmsg();'>";
    
    //Return messages to ajax
    echo "$msgs";
}
/*Total Chat Box ends*/
?>

<?php

if( isset($_POST['wtd']) && $_POST['wtd'] == "read" )
{
	$msg_id = $_POST['msg_id'];
	
	$qry = "SELECT read_status,receiver FROM messages WHERE id = '$msg_id' ";
	$sql = mysqli_query( $conn,$qry );
	$row  = mysqli_fetch_array($sql);
	$read_stat =  $row['read_status'];
	$receiver = $row['receiver'];
	if(!$read_stat && $receiver == $log_username)
	{
		$qry = "UPDATE messages SET read_status = '1' WHERE id = '$msg_id'";
		$sql = mysqli_query( $conn , $qry);
		$color = ($read_stat) ? ("82C27C") : ("ef0088") ;
		echo $color;
	}
}

?>
<?php

if(isset($_POST['wtd']) && $_POST['wtd'] == "delete")
{
	$id = $_POST['id'];
	$qry = "SELECT * FROM messages WHERE id = '$id'";
	$sql = mysqli_query( $conn , $qry );
	$row = mysqli_fetch_array($sql);
	$deleted_count='';
	$del=0;
	if($sql)
	{
		$deleted_count=$row['deleted_count'];
		if($deleted_count < 1)
		{
			$qry = "UPDATE messages SET deleted_count='1',deleted_from='$log_username' WHERE id = '$id'";
			$sql = mysqli_query( $conn , $qry );
			//echo $qry;
			$del=1;
		}
		else
		{
			$qry = "DELETE FROM messages WHERE id = '$id'";
			$sql = mysqli_query( $conn , $qry );
			$del=1;
		}
		
	}
	if($del)
		echo "delete_success";

	/*
	$qry = "DELETE FROM messages WHERE id = '$id'";
	$sql = mysqli_query( $conn , $qry );
	
	if($sql)
		echo "delete_success";
		*/
}
?>
