<?php 
include_once("login_status.php");
if(!$user_ok)
{
    header("Location:localhost/site");
}
include_once("pagetop.php");
?>
<?php 
$logerror1 ="";
$logerror2 ="";
$display_ok="";
$logmsg="";
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$old_pwd=md5($_POST["old_pwd"]);
		$pwd=$_POST["pwd"];
		$cpwd=$_POST["cpwd"];
		$pwd_update="";
		if($log_password!=$old_pwd)
		{
			$logerror1 ="<p style='color:red'>Password does not match with our records!</p>";		
		}
		elseif($pwd!=$cpwd)
		{
				$logerror2 ="<p style='color:red'>Passwords does not match !...Try again....</p>";
				
		}
		else
		{
				$crpt_pwd=md5($pwd);
				$qry = "UPDATE users SET password='$crpt_pwd' WHERE username='$log_username'";
				$sql=mysqli_query($conn,$qry);
				if($sql)
				{
					$pwd_update=1;
				}
		}		
		if($pwd_update)
		{	
			//header("Location: user.php");
			$logmsg .= "<div align='center'><h4>PASSWORD CHANGED SUCCESSFULLY!!";
			$logmsg .= "<br> ";
			$logmsg .= "<br><br>Please <a href='login.php'>Re-login Here</a></h4><br></div>";
			$display_ok="none";
		}	
		else
			$logmsg = "<div align='center'><h5 style='color:blue'>PASSWORD NOT UPDATED</h5></div>";
		
	}
?>
<!DOCTYPE HTML>

<HTML>
<head>
<title>Password Change</title>
<link rel="stylesheet" href="css/main_all.css" />
<style>
.login_form{
margin:0px 0px 0px 20%;
}
</style>
</head>

<body>
	<div class="change_pwd">
	<div align="center" style="display:<?php echo $display_ok;?>;">
	<br>
	<!--<fieldset>
		
	<form action="change_password.php" method="post">
		<table cellspacing="5" cellpadding="5">
				<tr><th>Old Password </th><td>:&nbsp;&nbsp;<input type="password" name="old_pwd"/></td><td><?php echo $logerror1 ?></td></tr>
				<tr><th>New Password </th><td>:&nbsp;&nbsp;<input type="password" name="pwd"/></td><td><?php echo $logerror2 ?></td></tr>
				<tr><th>Confirm Password </th><td>:&nbsp;&nbsp;<input type="password" name="cpwd"/></td></tr>
				<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" value="Reset"></td></tr>
		</table>
	
	</form>
	</fieldset>-->
	<!--#########-->
	</div>
	</div>
	<?php echo $logmsg;?>
	<div class="login_form" style="display:<?php echo $display_ok;?>;">
		
        <form action="" class="form-horizontal" method="POST"  >
		<h3 style='color:red'>&nbsp;&nbsp;&nbsp;&nbsp;Change Password </h3><br>
		<div class="form-group">
			<label class="col-md-2 control-label">Old Password:</label>
			<div class="col-md-4">
		<input type="password" name="old_pwd" required="required" size="10" class="form-control" placeholder="old password"/>
		<?php echo $logerror1 ?>
			</div>
			
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">New Password:</label>
			<div class="col-md-4">
			<input type="password" name="pwd" required="required" class="form-control" placeholder="new password">
		<?php echo $logerror2 ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Confirm Password:</label>
			<div class="col-md-4">
			<input type="password" name="cpwd" required="required" class="form-control" placeholder="retype password">
			</div>
		</div>
		<div class="form-group">
				<br>
			<div class="col-md-offset-2 col-md-4">
				<input type="submit" value="Submit" class="btn btn-success"/>
				<input type="reset" value="Reset" class="btn btn-primary"/>
			</div>
		</div>
        </form>
	</div>
	<!--#########-->


</body>
</HTML>
<?php include_once("footer.php");?>
