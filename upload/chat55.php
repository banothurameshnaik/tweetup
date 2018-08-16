<?php

include_once("login_status.php");
if(!$user_ok)
{
	
	header("Location:login.php?_Nto=chat55");
}
?>
<?php include_once("pagetop.php")?>
<?php 
	$onlineusers ="";
	$qry = "SELECT * FROM users WHERE login_stat = '1'";
	$sql = mysqli_query($conn,$qry);
	$onlineusers .= "<table id='onlineUsers_table' class='order-table table' cellspacing='3' cellpadding='2' method='get'>";
	$count=0;
	$photo = '';
	$array='';
	while ( $row = mysqli_fetch_array($sql,MYSQLI_ASSOC))
	{
			$user = $row['username'];
			$array=['png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF'];
			foreach($array as $value)
			{
				if(file_exists("users/$user/$user.$value"))
				{
					$photo = "users/$user/$user.$value";
					break;
				}
				else
					$photo = "images/smile.gif";
			}
			if($user != $log_username)
			{
				$count++;
				$onlineusers .= "<tr id='onlineUsers_table_tr'><td>
					$count .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href='chat55.php?user=$user'>$user</a></td>";
				$onlineusers .= "<td id='user_picture'><image src='$photo' height='30px' width='40px' alt='profile picture_".$user."'></td>"; 		
				$onlineusers .= "</tr>";
			}
	}
	$onlineusers .="</table>";
?>

<?php
$send_status = "";

$sent_msgs = "";
$inbox_msgs = "";
$msgs = "";
function print_mail($for,$conn,$log_username)
{
	$table ='';
	$fromto =  "" ;
	if($for == "inbox")
	{
		$qry = "SELECT * FROM messages WHERE receiver='$log_username' ORDER BY time";
		$fromto ="FROM";
	}
	else
	{
		$qry = "SELECT * FROM messages WHERE sender='$log_username' ORDER BY time";
		$fromto ="TO";
	}
	$sql = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($sql);
	($sql == true) ? $rows :  $rows = 0;
	
	$table .= "<table class='table table-hover table-bodered'>";
	$table .= "<thead>";
    	$table .= "<th>$fromto</th><th>Message</th><th>Time</th><th>Actions</th>";
    	$table .= "</thead>";
    	$table .= "<tbody>";
    	if($rows > 0)
    	{
    		while( $row = mysqli_fetch_array($sql) )
    		{
    			$deleted_from = $row['deleted_from'];
    			if($deleted_from != $log_username)
    			{	
    			$time =  $row['time'];
			$msg = $row['message'];
			$id = $row['id'];
			$from = $row['sender'];
			$stat = $row['read_status']; 		
    		 	$table .= "<tr id='tr".$id."'>";
    		 	$table .= "<td>$from</td>";
    		 	$table .= "<td>$msg</td>";
    		 	$table .= "<td>$time</td>";
  			$table .= "<td><span class='glyphicon glyphicon-trash' 
  						onclick='delete_msg(".$id.");' style='cursor:hand;'></span></td>";    	 	    	 	    	 	
    		 	$table .= "</tr>";       
    			}
    		} 
	    	$table .= "</tbody>";
    		$table .= "</table>";  
	}
	else
	{
		$table .= "<p style='color:gray;font-weight:900'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No messages to read</p>";
	}
}
   /*Messages from an user*/
    $qry = "SELECT * FROM messages WHERE receiver='$log_username' ORDER BY time";
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    ($sql == true) ? $rows :  $rows = 0;
    $inbox_msgs = "<span style='color:#ef6688;font-size:16px;' id='active_header'>InBox : $log_username</span><br>";
 
    if($rows>0)
    {
	    	$inbox_msgs .= "<table class='table table-hover table-bodered'>";
    		$inbox_msgs .= "<thead>";
    		$inbox_msgs .= "<th>From</th><th>Message</th><th>Time</th><th>Actions</th>";
    		$inbox_msgs .= "</thead>";
    		$inbox_msgs .= "<tbody>";
    	while( $row = mysqli_fetch_array($sql) )
    	{
    		$deleted_from = $row['deleted_from'];
    		if($deleted_from != $log_username)
    		{	
    		$time =  $row['time'];
		$msg = $row['message'];
		$id = $row['id'];
		$from = $row['sender'];
		$stat = $row['read_status']; 		
    	 	$inbox_msgs .= "<tr id='tr".$id."'>";
    	 	$inbox_msgs .= "<td>$from</td>";
    	 	$inbox_msgs .= "<td>$msg</td>";
    	 	$inbox_msgs .= "<td>$time</td>";
  		$inbox_msgs .= "<td><span class='glyphicon glyphicon-trash' 
  					onclick='delete_msg(".$id.");' style='cursor:hand;'></span></td>";    	 	    	 	    	 	
    	 	$inbox_msgs .= "</tr>";       
    		}
    		
    	}  
	    	$inbox_msgs .= "</tbody>";
    		$inbox_msgs .= "</table>";  
    }
    else
    {
    	$inbox_msgs .= "<p style='color:gray;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No messages to read</p>";
    }

// InBox messages End Here
/*Messages sent to an user*/
    $qry = "SELECT * FROM messages WHERE sender='$log_username' ORDER BY time";
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    ($sql == true) ?  $rows :  $rows = 0;
    if(!$sql) $rows = 0;
    $sent_msgs = "<span style='color:#ef6688;font-size:16px;' id='active_header'>Sent Box </span><br>";
    if($rows>0)
    {
    		$sent_msgs .= "<table class='table table-hover table-bodered'>";
    		$sent_msgs .= "<thead>";
    		$sent_msgs .= "<th>To</th><th>Message</th><th>Time</th><th>Options</th>";
    		$sent_msgs .= "</thead>";
    		$sent_msgs .= "<tbody>";
    	while($row = mysqli_fetch_array($sql))
    	{
    		$deleted_from =$row['deleted_from'];
    		if($deleted_from != $log_username)
    		{
		$time =  $row['time'];
		$msg = $row['message'];
		$id = $row['id'];
		$to = $row['receiver'];
		$stat = $row['read_status'];
    		$sent_msgs .= "<tr id='tr".$id."'>";
    	 	$sent_msgs .= "<td>$to</td>";
    	 	$sent_msgs .= "<td>$msg</td>";
    	 	$sent_msgs .= "<td>$time</td>";
  		$sent_msgs .= "<td><span class='glyphicon glyphicon-trash' 

  					onclick='delete_msg(".$id.");' style='cursor:hand;'></span></td>";    	 	    	 	    	 	
    	 	$sent_msgs .= "</tr>"; 
    	 	}      
    	}
      	 	$sent_msgs .= "</tbody>";
    		$sent_msgs .= "</table>"; 
    }
    else
    {
    	$sent_msgs .= "<p style='color:gray;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Initialize the conversation</p>";
    }
    
/*Messages sent to an user are collected above*/
$chat_box = ""; 
if(isset($_GET['user']))
{
    /*$receiver = $_GET['user'];*/
    $receiver = preg_replace('#[^a-zA-Z0-9 ]#','',$_GET['user']);
    //$chat_box .= "<form  onsubmit='sendmsg();' >";
    $chat_box .= "<span id='send_stat'></span>";
    $chat_box .= "<textarea class='col-md-9' name='message' cols='40' rows='3' alt='message'
    				 id='message' placeholder='Type Here'></textarea>";
    $chat_box .= "<br><input type='submit' class='btn btn-primary col-md-2' value='Send'
    			 id='send_btn' onclick='sendmsg();'></input>";
    //$chat_box .= "</form>";
    
    echo "<script>
    		var recvr = '".$receiver."';
    	  </script>";

    
/*Total Chat Box starts*/
    $qry = "SELECT * FROM messages WHERE 
    			sender='$receiver' AND receiver='$log_username'
    			 OR 
    			sender='$log_username' AND receiver='$receiver' ORDER BY time LIMIT 20";

    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    ($sql == true) ?   $rows :  $rows = 0;

    $msgs = "<span style='color:blue;font-size:16px;' id='active_header'>Chat Box : Talk with $receiver </span><br>";
    $deleted_from =$rows['deleted_from'];
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
		
    		$msgs .= "<div class='col-md-7 msg_image' id='msgs".$msg_id."' align='center' 
    				style='float:".$flt.";color:#".$stat_color.";cursor:hand;' onclick='msg_toggle_time(msgs".$msg_id.");'>";
    		$msgs .= "<span id='msg_msgs".$msg_id."' style='font-Weight:00'>$msg</span>";
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
/*Total Chat Box ends*/
}

?>

<html>
<head>
<title>Chat</title>
<link type="text/css" href="css/chat55.css" rel="stylesheet"/>
<script src="js/ajax.js"></script>

<script>
function msg_toggle_time(id)
{
	var msg = document.getElementById("msg_" + id.id).innerHTML;
	var msg_id = document.getElementById("id_" + id.id).innerHTML;
	var time_id = "#time_" + id.id;
	$(time_id).toggle();
	var time = document.getElementById("time_" + id.id).innerHTML;
	if (document.getElementById(id.id).style.color == "rgb(130, 194, 124)")
	{	
		return false;
	}
	//Message read script goes here
	var ajax = ajaxObj("POST", "database/messaging.php");

        ajax.onreadystatechange = function()
        {
            if(ajaxReturn(ajax) == true)
            {
                document.getElementById(id.id).style.color = "#" + ajax.responseText.trim();
		document.getElementById(id.id).style.fontWeight = "900";

            }
        };
        ajax.send("wtd=read&recvr="+recvr+"&msg_id="+msg_id);
}
</script>
<script>
	function delete_msg(id)
	{
		var conf= confirm("Are you sure to delete message");
		if(!conf)
			return false;
		
		var ajax = ajaxObj("POST" , "database/messaging.php");
		
		ajax.onreadystatechange = function()
		 {
		 	if(ajaxReturn(ajax) == true)
		 	{
		 		if(ajax.responseText.trim() == "delete_success")
		 		{
		 			
		 			document.getElementById("tr"+id).style.display = "none";
		 		}
		 	}
		 };
		 ajax.send("wtd=delete&id="+id);
	}
</script>
<script>
            function sendmsg()
            {
                var msg = document.getElementById("message").value;
                document.getElementById("send_stat").innerHTML = "<p style='color:#00ffee;'>please wait...</p>";
                var ajax = ajaxObj("POST", "database/messaging.php");

                ajax.onreadystatechange = function()
                {
                    if(ajaxReturn(ajax) == true)
                    {
                        if( ajax.responseText.trim() == "message_sent" )
                        {
                                document.getElementById("send_stat").innerHTML = "<p style='color:green;font-size:12px;'>Message Sent</p>";
                                window.location = "chat55.php?user="+recvr;
                        }
                        else
                        {
                                document.getElementById("send_stat").innerHTML = "<p style='color:red;font-size:12px;'>Unable to send Message</p>";
                        }
                    }
                };
                ajax.send("wtd=send&msg="+msg+"&recvr="+recvr);
            }
</script>

<script>
window.setInterval(function(){

	jQuery(document).ready(function(){       
	    var $t = $('#msgs');
	    $t.animate({"scrollTop": $('#msgs')[0].scrollHeight}, "fast");
	});	
	
        var ajax = ajaxObj("POST", "database/messaging.php");

        ajax.onreadystatechange = function()
        {
            if(ajaxReturn(ajax) == true)
            {
                
                document.getElementById("msgs").innerHTML = ajax.responseText.trim();
            }
        };
        ajax.send("wtd=refresh&recvr="+recvr);
        
},5000);
</script>
<script>
jQuery(document).ready(function(){       
    var $t = $('#msgs');
    $t.animate({"scrollTop": $('#msgs')[0].scrollHeight}, "slow");
});
</script>
</head>

<body>

<div class="container col-md-12">

	<div class="col-md-3 jumbotron onlineUsers">
		<input class="light-table-filter" data-table="order-table" placeholder="Search Here" type="search"><br><br>
		<?php echo $onlineusers ?>

	</div>

	<div class="col-md-9">
		<div class="col-md-6 msgs">

			<div id="msgs" class="chat_box_msgs">
				<?php 
					echo $msgs; 
				?>
			</div>
			<div class='chat_box_form'>
				<?php
					echo "<br>$chat_box";
				?>
			</div>
			
			
		</div>
		<div class="panel-group col-md-6 mail" id="accordion">
			<div class="panel panel-info mail_boxes">
				<div aria-expanded="false" class="panel-heading collapsed" data-toggle="collapse" 
				data-parent="#accordion" data-target="#InBox">
					<h4 class="panel-title accordion-toggle" style='cursor:hand;'> InBox 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="glyphicon glyphicon-save-file"></i></h4> 
				</div>
				<div style="height: 0px;" aria-expanded="false" id="InBox" class="panel-collapse collapse">
					<div class="panel-body">
						<?php
							echo "<br>$inbox_msgs";
						?>
					</div>
				</div>
			</div>
						<div class="panel panel-info">
				<div aria-expanded="false" class="panel-heading collapsed" data-toggle="collapse" 
				data-parent="#accordion" data-target="#SentBox">
					<h4 class="panel-title accordion-toggle" style='cursor:hand;'> SentBox 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														
					<span class="glyphicon glyphicon-open-file"></span>	</h4> 

						
				</div>
				<div style="height: 0px;" aria-expanded="false" id="SentBox" class="panel-collapse collapse">
					<div class="panel-body">
						<span><?php echo $send_status; ?></span>
						<?php	
							echo "<br>$sent_msgs";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
<script>
(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);
</script>
</html>

<?php include_once("footer.php") ?>
