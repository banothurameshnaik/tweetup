<?php
include_once("login_status.php");
if(!$user_ok)
{
    header("Location:''");
}
$qry = "SELECT * FROM users WHERE username='$log_username'";
$arr = mysqli_fetch_array(mysqli_query($conn,$qry));
$camp_id=$arr['campus_id'];
$fname=$arr['first_name'];
$lname=$arr['last_name'];
$uname=$arr['username'];
$gender=$arr['gender'];
$email=$arr['email'];
$address1=$arr['address1'];
$address2=$arr['address2'];
$state=$arr['state'];
$country=$arr['country'];
$mobile=$arr['mobile'];
?>
<?php 
$photo_user="users/$log_username/$log_username";
if(file_exists("$photo_user.jpg"))
{
	$photo_ok=1;
	$photo_path="$photo_user.jpg";
}
else if(file_exists("$photo_user.jpeg"))
{
	$photo_ok=1;
	$photo_path="$photo_user.jpeg";
}
else if(file_exists("$photo_user.png"))
{
	$photo_ok=1;
	$photo_path="$photo_user.png";
}
else if(file_exists("$photo_user.gif"))
{
	$photo_ok=1;
	$photo_path="$photo_user.gif";
}
else
{
	$photo_ok=0;
	$photo_path="images/index.jpg";
}
?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title>WELCOME :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$log_username"; ?></title>
</head>
<style>
#blank
{
	height:60%;
	width:20%;
	float:left;
}
#e-profile
{
	height:60%;
	width:50%;
	float:left;
}

#image
{
		height:60%;
		width:30%;
		float:left;
}
#photo
{
	margin-top:60px;
	border:solid 2px ;
	border-radius:15px;
	align:middle;
	height:120;
	width:120;
}
a
{
	text-decoration:none;
}
button
{
	border-radius:20px;
}
.eprofile{
	margin:20px;
}
.data{
	padding:10px;
}

</style>
<body>
	<!-- ##### 
	<div id="blank"></div>
    <div id="e-profile" align="center" >
		<table cellspacing="5" cellpadding="5">
			<caption><h3><?php echo "Details: $log_username "; ?></h3></caption>
			<tr><td>ID</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$camp_id"?></td></tr>
			<tr><td>NAME</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$fname $lname"?></td></tr>
			<tr><td>USERNAME</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$uname"?></td></tr>
			<tr><td>GENDER</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$gender"?></td></tr>
			<tr><td>EMAIL</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$email"?></td></tr>
			<tr><td>ADDRESS</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$address1  $address2"?></td></tr>
			<tr><td>STATE</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$state"?></td></tr>
			<tr><td>COUNTRY</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$country"?></td></tr>
			<tr><td>MOBILE</td><td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$mobile"?></td></tr>
		</table>
	</div>
	<div id="image">
			<img type='image' src="<?php echo $photo_path ?>" id="photo"/><br>
			<a href="user_update.php"><h3>Update Your Profile : </h3></a>
			<a href="change_password.php"><h3>Change Password : </h3></a>
	</div>
	<h6>&nbsp;</h6> 
		##### -->
<div class="col-md-12 eprofile">
	<div class="col-md-2">
		&nbsp;	&nbsp;
	</div>
	<div class="col-md-6 " >
			<button type='button' class="btn btn-primary disabled"><b>Details : <?php echo  $log_username;?></b></button>
		<div class='data' align="center" >
			<div class="col-md-3" align="right"><label >ID :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$camp_id"?><br></label></div>
			<div class="col-md-3" align="right"><label >NAME :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$fname $lname"?><br></label></div>
			<div class="col-md-3" align="right"><label >USER NAME :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$uname"?><br></label></div>
			<div class="col-md-3" align="right"><label >GENDER :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$gender"?><br></label></div>
			<div class="col-md-3" align="right"><label >Email :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$email"?><br></label></div><br>
		</div>
		<button type='button' class="btn btn-primary disabled"><b>Address Details : </b></button>
		<div class='data' align="center">
			<div class="col-md-3" align="right"><label >Address :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$address1  $address2"?><br></label></div>
			<div class="col-md-3" align="right"><label >Sate :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$state"?><br></label></div>
			<div class="col-md-3" align="right"><label >Country :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$country"?><br></label></div><br>
			<div class="col-md-3" align="right"><label >Mobile :</label></div>
			<div class="col-md-7" align="left"><label><?php echo "$mobile"?><br></label></div>
		</div>
	</div>
	<div class="col-md-4">
			<img type='image' src="<?php echo $photo_path ?>" id="photo"/><br>
			<a href="user_update.php"><h3>Update Your Profile : </h3></a>	
			<a href="change_password.php"><h3>Change Password : </h3></a>
	</div>
</div>

</body>
<script>
	$("input[type='image']").click(function() {
    $("input[id='photo']").click();
});
</script>
</html>
<?php include_once("footer.php"); ?>

