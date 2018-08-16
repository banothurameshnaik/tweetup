<?php
include_once("login_status.php");
$_next ='';
if(isset($_GET['_Nto']))
{
	$next = $_GET['_Nto'];
}
if($user_ok)
{
	if($next!="")
	    header("Location:$next.php");
	else
	    header("Location:user.php");
}
$status = "";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $uname = $_POST['id_number'];
    $pass = md5($_POST['password']);

    $qry = "SELECT * FROM users WHERE username='$uname'";
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    if($rows > 0)
    {
        $array = mysqli_fetch_array($sql);
        $uname = $array['username'];
        $db_pass = $array['password'];
        $id = $array['id'];

        if($db_pass == $pass)
        {

            /*setcookie("id",$id,strtotime('+1 days'),"/","","",TRUE);
            setcookie("username",$uname,strtotime('+1 days'),"/","","",TRUE);
            setcookie("password",$pass,strtotime('+1 days'),"/","","",TRUE);
            */
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $uname;
            $_SESSION['password'] = $pass;
            $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

            $qry = "UPDATE users SET last_login='$now',ip='$ip',login_stat='1' WHERE id='$id' AND username='$uname'";
            $sql = mysqli_query($conn,$qry);
            if($sql)
            {
                if($next!="")
		    header("Location:$next.php");
		else
		   header("Location:user.php");
            }
        }
        else
            $status = "<p>Paasword does not match  </p> Please Enter Correctly !!!</p>";
    }
    else
    {
        $status = "<p>Username does not match </p> Please Enter Correctly !!!</p>";
    }
}

?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>

<html>
    <title>Login Form</title>
    <head>
	<style>
		.login_form{
			margin-top:100px;
			margin-left:00px;
			margin-right:000px;
		}
	</style>
    </head>

    <body>
        <div class="login col-md-12" align="center">
        	<div class="col-md-2">
	        	&nbsp;
        	</div>
		<div class="login-form col-md-8">
			<h3>Login Here</h3>
			<form action='' method='post' class="form-horizontal">
			<div class="login_form ">
				<?php echo $status; ?>
				<div class="form-group row">
					<label class="col-md-3 control-label">UserName:</label>
					<div class="col-md-5">
					<input type="text" name="id_number" required="required" size="10" class="form-control" 
							placeholder="username"/>
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
					<p >New !!! <a href='signup.php'>Sign Up Here</a></p>
					<div class="col-md-offset-1 col-md-6">
						<input type="submit" value="Log In" class="btn btn-success"/>
						<input type="reset" value="Reset" class="btn btn-primary"/>
					</div>
				</div>
			</div>
			</form>
		</div>
		</div class="col-md-3">
			&nbsp;
		</div>
        </div>
    </body>
</html>
<?php include_once("footer.php")?>
