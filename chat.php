<?php

include_once("login_status.php");
if(!$user_ok)
{
	header("Location:login.php?_Nto=chat");
}
?>
<?php include_once("pagetop.php")?>
<?php 
$onlineusers ="";
$selected ='';
$count=0;
$photo = '';
$array='';
$onlineusers .= "<table id='onlineUsers_table' class='order-table table' cellspacing='3' cellpadding='2' method='get'>";

		$qry = "SELECT * FROM users WHERE login_stat = '1'";
		$sql = mysqli_query($conn,$qry);
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
						<a href='chat.php?user=$user'>$user</a></td>";
				$onlineusers .= "<td id='user_picture'><image src='$photo' height='30px' width='40px' 
							alt='profile picture_".$user."'></image></td>"; 		
					$onlineusers .= "</tr>";
					
			}
		}

if(isset($_POST['chat_users']) && $_POST['chat_users'] == '2')
{
	$selected='';
	$onlineusers='';
	$count='0';
	$array=['png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF'];
	$selected = $_POST['chat_users'];
	$onlineusers .= "Here u can send messages to your friends even though they are offline<br>";
	//echo "<script> alert(".$selected.");</script>";
	$qry = "SELECT DISTINCT sender,receiver FROM messages
						 	WHERE sender = '$log_username' OR receiver = '$log_username'";
	$sql = mysqli_query( $conn , $qry );
	//echo $qry;
	if(mysqli_num_rows($sql) <= 0)
			$onlineusers .= "<span style='color:green;'>no chat records found</span>";
	$onlineusers .= "<table id='onlineUsers_table' class='order-table table' cellspacing='3' cellpadding='2' method='get'>";
	$users_array=array();
	while($row = mysqli_fetch_array($sql))
	{
		
		$user_on_off='';
		if($row['sender'] == $log_username)
			$user = $row['receiver'];
		else
			$user = $row['sender'];	
		$u_a_c='0';
		foreach($users_array as $values)
		{
			if($values == $user)
				$u_a_c++;
		}
		if($u_a_c<1)
		{
			array_push($users_array,$user);
		}
	}	
	if(mysqli_num_rows($sql))	
	{
				foreach($users_array as $user)
				{
					$count++;
					$user_on_off='';
					/*if($row['sender'] == $log_username)
						$user = $row['receiver'];
					else
						$user = $row['sender'];	
					*/
					$qry4="SELECT * FROM users WHERE username='$user'";
					$sql4 = mysqli_query($conn,$qry4);
					$row4 = ($sql4) ? mysqli_fetch_array($sql4) : 0;
					if($row4['login_stat'])
					{
						$user_on_off='<i class="glyphicon glyphicon-ok"></i>';
					}
					else
					{
						$user_on_off='';
					}
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
					$onlineusers .= "<tr id='onlineUsers_table_tr'><td>
									$count . $user_on_off &nbsp;&nbsp;
									<a href='chat.php?user=$user'>$user</a></td>";
					$onlineusers .= "<td id='user_picture'><image src='$photo' height='30px' width='40px' 
							alt='profile picture_".$user."'></image></td>"; 		
						$onlineusers .= "</tr>";
				}
	}
}
$onlineusers .="</table>";

?>
<?php 

	
	
	
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
	$END_EMPTY='';
	if($for == "INBOX")
	{
		$qry = "SELECT * FROM messages WHERE receiver='$log_username' ORDER BY time";
		$fromto = "From";
		$END_EMPTY = "No messages to read";
		
	}
	else
	{
		$qry = "SELECT * FROM messages WHERE sender='$log_username' ORDER BY time";
		$fromto ="To";
		$END_EMPTY = "Initialize the conversion";
		
	}
	$sql = mysqli_query($conn,$qry);	
	$rows = mysqli_num_rows($sql);
	($sql == true) ? $rows :  $rows = 0;
    	if($rows > 0)
    	{
    		$table .= "<table class='table table-hover table-bodered'>";
					$table .= "<thead>";
    		$table .= "<th>$fromto</th><th>Message</th><th>Time</th><th>Actions</input></th>";
    		$table .= "</thead>";
    		$table .= "<tbody>";
    		while( $row = mysqli_fetch_array($sql) )
    		{
    			$deleted_from = $row['deleted_from'];
    			if($deleted_from != $log_username)
    			{	
    			$time =  $row['time'];
			$msg = $row['message'];
			$id = $row['id'];
			if($for=="INBOX")
				$from = $row['sender'];
			else
				$from = $row['receiver'];
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
		$table .= "<p style='color:gray;font-weight:900'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $END_EMPTY</p>";
	}
		  
	return $table;
}
// function print_mail ends here .......
	// Messages from an user 
    	$inbox_msgs = print_mail("INBOX",$conn,$log_username);
	// InBox messages End Here
	/*Messages sent to an user*/
    	$sent_msgs = print_mail("SENTBOX",$conn,$log_username);
    	/*Messages sentmsgs  End here*/
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
                                window.location = "chat.php?user="+recvr;
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
function load_chat()
{

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
        
}

$(document).ready(load_chat());
window.setInterval(function() {load_chat();},1000);

</script>
<script>
jQuery(document).ready(function(){       
    var $t = $('#msgs');
    $t.animate({"scrollTop": $('#msgs')[0].scrollHeight}, "slow");
});
</script>
<style>
	.onlineUsers
	{
		height:85%;
		overflow:auto;
	}
</style>
</head>

<body class='bg'>

<div class="container col-md-12">

	<div class="col-md-3 jumbotron onlineUsers">
	<form class="form form-horizantal" method="post" action=''>
		<span > Online Users <input type='radio' value='1' name='chat_users' onclick='this.form.submit();' /><span>
		<span > Friends <input type='radio' value='2' name='chat_users'	onclick='this.form.submit();' /><span>
	</form>
		<input class="light-table-filter" data-table="order-table" placeholder="Filter Users "  type="search"><br><br>
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
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
														
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
