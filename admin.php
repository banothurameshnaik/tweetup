<?php
$admin_options='';
$form_dis='';
include_once("login_status.php");
if($log_username = 'admin')
if(isset($_POST['key']))
{
	$key = $_POST['key'];
	$password = $_POST['password'];
	$qry="SELECT password FROM users WHERE username='admin'";
	//echo $qry;
	$sql=mysqli_query($conn,$qry);
	$row=mysqli_fetch_array($sql);
	$ps=$row['password'];
	if($key == "255" && md5($password) == $ps )
	{
		$U='users';
		$M='messages';
		$FB='feedback';
		$F='forum';
		$form_dis = 'none';
		//$admin_options .="<form method='post'>";
		$admin_options .="<button  type='submit' class='btn btn-success' onclick='restore();'>1 . Restore Users Table </button><br><br>";
		$admin_options .="<button  class='btn btn-success' onclick='restore(".$M.");' >2 . Restore Messages Table</button><br><br>";
		$admin_options .="<button  class='btn btn-success' onclick='restore(".$FB.");'>3 . Restore Feedback Table</button><br><br>";
		$admin_options .="<button  class='btn btn-success' onclick='restore(".$F.");' > 4 . Restore Forum Tables</button><br><br>";
		//$admin_options .="</form >";
	}
	else
	{
		$admin_options .="Inccorrect Details";
	}
}
?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>
    <title>Feedback</title>
    <head>
	<script src="js/ajax.js"></script>
   <!--     <link rel="stylesheet" type="text/css" href="css/main_all.css"/> -->
    </head>
	<script>
		function restore()
		{
			
			var conf = confirm("Are you sure to delete Table"+table);
			if(!conf)
				return false;
			var ajax = ajaxObj("POST" , "database/admin.php");
		ajax.onreadystatechange = function()
		 {
		 	if(ajaxReturn(ajax) == true)
		 	{
		 		if(ajax.responseText.trim() == "delete_success")
		 		{
		 			document.getElementById("report") = "Deleted Successfully";
		 		}
		 	}
		 };
		 ajax.send("wtd=delete&table="+table);
		}
		
		
	</script>
<body>
<div class="col-md-12">
	<div class="login col-md-12" align="center">
        	<div class="col-md-2">
	        	&nbsp;
        	</div>
		<div class="login-form col-md-8">
			<h3>Admin Works</h3>
			<form action='' method='post' class="form-horizontal" style='display:<?php echo $form_dis; ?>'>
			<div class="login_form">
				<div class="form-group row">
					<label class="col-md-3 control-label">Privacy Key:</label>
					<div class="col-md-5">
					<input type="text" name="key" required="required" size="10" class="form-control" 
							// placeholder="Enter Key"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 control-label">Password:</label>
					<div class="col-md-5">
					<input type="password" name="password" required="required" class="form-control" 
							placeholder="password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-1 col-md-6">
						<input type="submit" value="Log In" class="btn btn-success"/>
						<input type="reset" value="Reset" class="btn btn-primary"/>
					</div>
				</div>
			</div>
			</form>
			<?php echo $admin_options; ?>
			<span id='report'></span>
 		</div>
		</div class="col-md-3">
			&nbsp;
		</div>
</div>
</body>
</html>

<?php include_once("footer.php"); ?>