<?php
include_once("login_status.php");
if(!$user_ok)
{
    header("Location:localhost:8888");
}
$qry = "SELECT * FROM users WHERE username='$log_username'";
$arr = mysqli_fetch_array(mysqli_query($conn,$qry));
$id = $arr['id'];
$camp_id=$arr['campus_id'];
$fname=$arr['first_name'];
$lname=$arr['last_name'];
$uname=$arr['username'];
$password=$arr['password'];
$gender=$arr['gender'];
$email=$arr['email'];
$address1=$arr['address1'];
$address2=$arr['address2'];
$state=$arr['state'];
$country=$arr['country'];
$mobile=$arr['mobile'];
?>
<?php include_once("pagetop.php"); ?>
<?php
$logmsg = "<h3>";
$update_ok="";
$display_ok ="block";
$redirect=0;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
$camp_id = $_POST['camp_id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$mail=$_POST['mail'];
$addr1=$_POST['addr1'];
$addr2=$_POST['addr2'];
$state=$_POST['state'];
$country=$_POST['country'];
$mobile=$_POST['mobile'];
$user_check=0;
if($uname!=$log_username)
{
	$user_check=1;
}

$qry = "UPDATE users SET campus_id='$camp_id',first_name='$fname',last_name='$lname',gender='$gender',email='$mail',address1='$addr1', address2='$addr2',state='$state',country='$country',mobile='$mobile' WHERE username='$log_username'";
$sql = mysqli_query($conn,$qry);
	if($sql)
	{
		$display_ok="none";
		$logmsg .=  "Thank You...
				<br>
				<br>Your profile has been updated successfully ...";
		if($user_check)
		{
			$logmsg .= "<br> And you had been changed your Username to $uname";
			$logmsg .= "<br><br>Please <a href='login.php'>Re-login Here</a><br>";
	//		$m="Please <a href='login.php'>Re-login Here";
		//	echo "<script>alert('$m')</script>";
		}
		
	}
	else
	{	
		$display_ok ="";
		$update_ok = "Sorry...Your data not been Updated";
		$logmsg .=  "Please Try Again";
	}
	$logmsg .= "</h3>";
}
?>
<?php
if(!file_exists("users/$log_username"))
	mkdir("users/$log_username",0075,TRUE);
$photo_user="users/$log_username/$log_username";
if(file_exists("$photo_user.jpg"))
{
	$photo_ok=1;
	$photo_path="users/$log_username/$log_username.jpg";
}
else if(file_exists("$photo_user.jpeg"))
{
	$photo_ok=1;
	$photo_path="users/$log_username/$log_username.jpeg";
}
else if(file_exists("$photo_user.png"))
{
	$photo_ok=1;
	$photo_path="users/$log_username/$log_username.png";
}
else if(file_exists("$photo_user.gif"))
{
	$photo_ok=1;
	$photo_path="users/$log_username/$log_username.gif";
}
else
{
	$photo_ok=0;
	$photo_path="images/index.jpg";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>WELCOME : <?php echo "$log_username"; ?></title>
<style>
#blank
{
	height:90%;
	width:20%;
	float:left;
}
#e-profile
{
	height:90%;
	width:50%;
	float:left;
}
#image
{
		height:90%;
		width:30%;
		float:left;
}
#photo
{
	margin-top:100px;
	border:solid 2px ;
	border-radius:15px;
	align:middle;
	height:120;
	width:120;
}

</style>
</head>
<script>

</script>
<body >
	<div style="display:<?php echo $display_ok;?>;">
	<div id="blank"><h3>&nbsp;</h3></div>
    <div id="e-profile" align="center" >
		<p id="demo"></p>
		<?php echo "$update_ok";?>
		<form action="user_update.php" method="POST">
		<table cellspacing="5" cellpadding="5">
			<caption><h3><?php echo "Update Details: $log_username "; ?></h3></caption>
			<tr><th>ID:</th><td><input type="text" value="<?php echo "$camp_id"?>" name="camp_id"></td></tr>
			<tr><th>Frist NAME:</th><td><input type="text" value="<?php echo "$fname"?>" name="fname" ></td></tr>
			<tr><th>Last NAME:</th><td><input type="text" value="<?php echo "$lname"?>" name="lname" ></td></tr>
			<tr><th>GENDER:</th><td><input type="radio" name="gender" checked="checked" value="Male"/>Male
						<input value="Female" type="radio" name="gender"/>FeMale</td></tr>
			<tr><th>EMAIL:</th><td><input type="text" value="<?php echo "$email"?>" name="mail" ></td></tr>
			<tr><th>ADDRESS 1:</th><td><input type="text" value="<?php echo "$address1"?>" name="addr1" ></td></tr>
			<tr><th>ADDRESS 2:</th><td><input type="text" value="<?php echo "$address2"?>" name="addr2" ></td></tr>
			<tr><th>STATE:</th><td><input type="text" value="<?php echo "$state"?>" name="state" ></td></tr>
			<tr><th>COUNTRY:</th><td><input type="text" value="<?php echo "$country"?>" name="country" ></td></tr>
			<tr><th>MOBILE:</th><td><input type="text" value="<?php echo "$mobile"?>" name="mobile" ></td></tr>
		<tr><td></td><td><input type="submit" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="reset"></td></tr>
		</table>
		</form>
	</div>
	<div id="image">
		<abbr title="Click to Change Profile Photo">	
	<a href="upload/upload_r.php">
		<img src="<?php echo $photo_path ?>" id="photo" alt="<?php echo "$log_username PHOTO"?>"/>
	</a>
		<br>
		</abbr>
	</div>
	</div>
	<div class='logmsg' align="center" style="color:red;">
		<?php echo $logmsg; ?>
	</div>
	
	
</body>
</html>
<?php include_once("footer.php"); ?>
