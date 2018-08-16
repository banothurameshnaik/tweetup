<?php
include_once("login_status.php");
$name = "";
$status = "";
$feedback = "";
$table= "";
$count = 0;
if($user_ok == false)
{
		header("Location:login.php?_Nto=feedback");
}
else
{
	$qry= "SELECT * FROM feedback ORDER BY time DESC";
	$sql = mysqli_query($conn,$qry);
	if($sql)
	{
	while($row = mysqli_fetch_array($sql))
	{
		$name = $row['username'];
		$status = $row['status'];
		$feedback = nl2br($row['feedback']);
		($count++%2==0) ? $float='left' : $float='right';
		$table .= "<pre class='prev_feedback col-md-6' style='float:$float;margin:10px;'><b>$name</b> <br>";
		$table .= "Rating   : $status<br>";
		$table .= "   Comment  : $feedback</pre>";
		$table .= "<br>";
	}
	}
}
?>
<?php
$feed_status = "";
$feed_error ="";
$display_ok = "";
$display_notok ="none";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['status']))
	{
    	    $feed = $_POST['feedback'];
	    $status = $_POST['status']; 
	    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

   	    $qry = "INSERT INTO feedback(username,status,ip,feedback,time) VALUES('$log_username','$status','$ip','$feed','$now')";
	    $sql = mysqli_query($conn,$qry);
	    if($sql)
	    {
	        $feed_status = "<p style='color:blue'>
	        				Your feedback has been sent successfully ... 
	        				<p>Which will be very helpful for us.<br><br></p>
						<h4>Thanks for submitting your feedback</h4></p>";
			$feed_status .="<p><a href='feedback.php' style='text-decoration:none;color:blue;'>Reload Page</p>";
		$display_ok="none";
		$display_notok="";
	    }
	    else
	    {
	        $feed_status = "<p style='color:red'>Sorry, Unable to Submit your feedback</p>";
		$display_ok="";
	    }
	}
	else
	{
	$feed_error = "<p style='color:red'>Please Select any one of status above ... </p>";
	$display_ok="";
	}
}

?>
<?php include_once("pagetop.php"); ?>

<!DOCTYPE html>
<html>
    <title>Feedback</title>
    <head>
   <!--     <link rel="stylesheet" type="text/css" href="css/main_all.css"/> -->
    </head>
	<script>
		function validate()
		{
			if(document.feedForm.status.value == "")
			{
				alert("Please select any one of status !!!");
				return false;
			}
		return (true);
		}
		
	</script>
	<style>
		.fb{
			margin-top:15px;
			margin-bottom:7%;
		}
		.jumbotron
		{
			padding-top:20px;
			margin-left:0px;
		}
		.jumbotron p{

			font-size:15px;
		}
		.send
		{
			padding-top:10px;
			margin-left:10%;
		}
		.prev_feedback
		{
			text-align:center;
			background-color:#f8e8a0;
			border-radius:10px;
		}
		.pre_feedback 
		{
			height:50%;
			width:65%;
			margin-top:15px;
			margin-bottom:0px;
		}
	</style>
<body>
<div class="col-md-12">
	<div class="fb col-md-4 jumbotron">
	<?php echo "$feed_status"; ?>
	<div  style="display:<?php echo $display_ok; ?>">
	<span></span>
		<pre>We are requesting you to give your valuable 
feedback to us.
		Feedback @ <?php echo $log_username; ?></pre>
		<form action="feedback.php" method="post" onsubmit="return(validate())" name="feedForm">
		<pre><span>Status : </span><input type="radio" value="Help ful" name="status">Help ful</input>
	 <input type="radio" value="Nice" name="status">Nice</input>
	 <input type="radio" value="Good" name="status">Good</input>
	 <input type="radio" value="Need to Develop" name="status">Need to Develop</input>
	 <input type="radio" value="Bad" name="status">Bad</input>
		</pre>
	<?php echo "$feed_error"; ?>
	<span>Comment : </sapn>
	<textarea name="feedback" id="feed" rows="7" cols="45" placeholder="Type suggestions or Comments here !!"></textarea>
	<div class="send">	<input type="submit" value="Submit" class="btn btn-success"/>
	<input type="reset" value="Reset" class="btn btn-primary"/>
	</div>
		</form>
		
	</div>
	</div>
	<div class="pre_feedback col-md-8" style="height:95%;overflow:auto;">		
		<h4 align="center">Given Feedback and Ratings on our site</h4>
		<?php echo "$table"; ?>
	</div>
</div>
</body>
</html>

<?php include_once("footer.php"); ?>
