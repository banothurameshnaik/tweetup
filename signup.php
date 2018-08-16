<?php
include_once("login_status.php");
if($user_ok)
{
    header("Location:user.php");
}
?>
<?php

$camp_id_stat = "";
$fname_stat = "";
$lname_stat = "";
$uname_stat = "";
$pass_stat = "";
$cpass_stat = "";
$gender_stat = "";
$email_stat = "";
$addr1_stat = "";
$addr2_stat = "";
$state_stat = "";
$country_stat = "";
$mobile_stat = "";
$captcha_stat = "";

$status= "";
$camp_id = "";
$fname = "";
$lname = "";
$uname = "";
$pass = "";
$cpass = "";
$gender = "";
$email = "";
$addr1 = "";
$addr2 = "";
$state = "";
$country = "";
$mobile = "";
$captcha = "";
?>

<?php

include_once("database/db_connect.php");
$checked = 0;
if($_SERVER['REQUEST_METHOD'] == "POST")
{

    //$camp_id = $_POST['id_number'];
    $fname = $_POST['fname'];
    //$lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    //$addr1 = $_POST['addr1'];
    //$addr2 = $_POST['addr2'];
    //$state = $_POST['state'];
    //$country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $captcha = $_POST['captcha'];
    //validation starts from here

    /*if(strlen($camp_id) == 7)
    {
        if( !preg_match("/^B[0-9]*$/",$camp_id) )
        {
            $camp_id_stat = "<p style='color:red;'>Enter valid ID</p>";
            $checked++;
        }
    }
    else
    {
        $camp_id_stat = "<p style='color:red; font-size:16px;'>Exactly 7 characters</p>";
        $checked++;
    }
    $qry = "SELECT * FROM users WHERE campus_id='$camp_id'";
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    if($rows>0)
    {
        $camp_id_stat = "<p style='color:red;font-size:16px;' >ID already exists</p>";
        $checked++;
    }
	*/
    if(strlen($fname) <= 30)
    {
        if( !preg_match("/^[a-zA-Z ]*$/",$fname) )
        {
            $fname_stat = "<p style='color:red;font-size:16px;'>Enter valid First Name</p>";
            $checked++;
        }
    }
    /*if(strlen($lname) <= 30)
    {
        if( !preg_match("/^[a-zA-Z ]*$/",$lname) )
        {
            $lname_stat = "<p style='color:red;font-size:16px;'>Enter valid Last Name</p>";
            $checked++;
        }
    }
    else
    {
        $name_stat = "<p style='color:red;font-size:16px;'>atmost 30 characters</p>";
        $checked++;
    }*/
    if(strlen($uname)<=15)
    {
        if(!preg_match("/^[a-zA-Z][0-9a-zA-Z]*$/",$uname))
        {
            $uname_stat = "<p style='color:red;font-size:16px;'>special characters and digits are ommitted at beginning</p>";
            $checked++;
        }
    }
    $qry = "SELECT * FROM users WHERE username='$uname'";
    $sql = mysqli_query($conn,$qry);
    $rows = mysqli_num_rows($sql);
    if($rows>0)
    {
        $uname_stat = "<p style='color:red;font-size:16px;'>username already exists</p>";
        $checked++;
    }

    if(strlen($pass)<4 || strlen($pass)>20)
    {
        $pass_stat = "<p style='color:red;font-size:16px;'>Range: 4-6 characters</p>";
        $checked++;
    }
    if($pass != $cpass)
    {
        $cpass_stat = "<p style='color:red;font-size:16px;'>Password fields do not match</p>";
        $checked++;
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $email_stat = "<p style='color:red;font-size:16px;'>Enter valid Email</p>";
        $checked++;
    }
    /*if($country == null)
    {
        $country_stat = "<p style='color:red;font-size:16px;'>Select your country</p>";
    }
    if(!preg_match("/^[a-zA-Z ]*$/",$state))
    {
        $state_stat = "<p style='color:red;font-size:16px;'>Enter valid State Name</p>";
    }
	*/
    if(strlen($mobile))
    {
	if(strlen($mobile)!=10)
     {

	 $mobile_stat = "<p style='color:red;font-size:16px;'>Enter valid Mobile Number</p>";
        $checked++;
        if(!preg_match("/^[0-9]*$/",$mobile))
        {
            $mobile_stat = "<p style='color:red;font-size:16px;'>Enter valid Mobile Number</p>";
            $checked++;
        }
	}
    }
    if($checked == 0)
    {
        $qry = "SELECT * FROM users";
        $sql = mysqli_query($conn,$qry);
        $id = mysqli_num_rows($sql);
        $id++;
        $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
        $signup = date('m-d-Y g:i:sA');
        $crypt_pass = md5($pass);
		if(file_exists("users/$uname"))
		{
			$file_ok=1;
		}
		else
		{
			mkdir("users/$uname");
			$file_ok=1;
		}
        if($file_ok)
        {
            /*setcookie("id",$id,strtotime('+1 days'),"/","","",TRUE);
            setcookie("username",$uname,strtotime('+1 days'),"/","","",TRUE);
            setcookie("password",$crypt_pass,strtotime('+1 days'),"/","","",TRUE);
            */
			$_SESSION['id'] = $id;
            $_SESSION['username'] = $uname;
            $_SESSION['password'] = $crypt_pass;
            $qry = "INSERT INTO users(first_name,username,password,gender,email,mobile,signup,last_login,login_stat,ip)
                    VALUES('$fname','$uname','$crypt_pass','$gender','$email','$mobile','$now','$now','1','$ip')";
            $sql = mysqli_query($conn,$qry);
			if($sql)
			{
				header("Location:user.php");
			}
        }
    }

}
?>

<?php
$rand = mt_rand(10000,99999);
if($checked == 0)
    $table_width = "50%";
else
    $table_width = "70%";
?>
<?php
 
?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SIGNUP FORM</title>
        <link rel="stylesheet" type="text/css" href="css/signup_style.css" />
        <link rel="stylesheet" type="text/css" href="css/main_all.css" >
        <script type="text/Javascript">
            var random;
            function random()
            {
                random = Math.floor(Math.random()*(10000,99999));
                document.getElementById("captcha_print").innerHTML= random;
            }
            function validate()
            {
                if(document.myForm.captcha.value == "" || document.myForm.captcha.value != random)
                {
                    alert("Fill the captcha agian");
                    document.myForm.captcha.focus();
                    return false;
                }
                return (true);
            }
        </script>
        <style>
        	.form-group{
     
        	}
        	#signup{
        		margin:0% 10% 00% 20%;
        	}
       
        </style>
    </head>

<body onload="random()">
    
    <div align="center" id='signup' >
        <h3>Sign Up</h3>
        <form action="signup.php" class="signup-form form-horizontal jumbotron " method="POST" name="myForm" onsubmit="return(validate())">

		  <!--<div class="form-group">
			<div class="error"><?php echo $status;?></div>
			<label for="ID numder" class="col-md-3 control-label">ID number<span style="color:red;">&nbsp;*</span>:</label>
			<div class="col-md-3">
			<input type="text" name="id_number" class="form-control" placeholder="BXXXXXX" value="<?php echo $camp_id; ?>" />
			</div>
			<span id="camp_id_stat" class='col-md-3'><?php echo $camp_id_stat; ?></span>
		</div>
		-->
		<div class="form-group">
			<label for="first name" class="col-md-3 control-label">Full name:</label>
			<div class="col-md-3">
			<input type="text" name="fname" class="form-control" placeholder="Full name" value="<?php echo $fname; ?>" />
			</div>
			<span id="fname_stat" class='col-md-3'><?php echo $fname_stat; ?></span>
		</div>
		<!--
		<div class="form-group">
			<label for="last name" class="col-md-3 control-label">Last Name:</label>
			<div class="col-md-3">
			<input type="text" name="lname" class="form-control" placeholder="last name" value="<?php echo $lname; ?>" />
			</div>
			<span id="lname_stat" class='col-md-3'><?php echo $lname_stat; ?></span>
		</div>
		-->
		<div class="form-group">
			<label for="user name" class="col-md-3 control-label">User name<span style="color:red;">&nbsp;*</span>:</label>
			<div class="col-md-3">
			<input type="text" name="uname" class="form-control" placeholder="user name" value="<?php echo $uname; ?>" />
			</div>
			<span id="uname_stat" class='col-md-3'><?php echo $uname_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="password" class="col-md-3 control-label">Password<span style="color:red;">&nbsp;*</span>:</label>
			<div class="col-md-3">
			<input type="password" name="password" class="form-control" placeholder="password"  />
			</div>
			<span id="pass_stat" class='col-md-3'><?php echo $pass_stat; ?></span>
		</div>
		<div class="form-group">
		<label for="Confirm pass" class="col-md-3 control-label">Confirm Password<span style="color:red;">&nbsp;*</span>:</label>
			<div class="col-md-3">
			<input type="password" name="confirm_password" class="form-control" placeholder="confirm pass" />
			</div>
			<span id="cpass_stat" class='col-md-3'><?php echo $cpass_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="gender" class="col-md-3 control-label">Gender:</label>
			<div class="col-md-3">
			<input type="radio" name="gender" value="MALE" id="i7" checked="checked" required="required">Male</input>
                           <input type="radio" name="gender" value="FEMALE" id="i7" required="required">FeMale</input>
                         </div>
                         <span id="gender_stat" class='col-md-3'><?php echo $gender_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="email" class="col-md-3 control-label">E-mail<span style="color:red;">&nbsp;*</span>:</label>
			<div class="col-md-3">
			<input type="text" name="email" class="form-control" placeholder="email" value="<?php echo $email; ?>"/>
			</div>
			<span id="email_stat" class='col-md-3'><?php echo $email_stat; ?></span>
		</div>
		<!--
		<div class="form-group">
			<label for="addr1" class="col-md-3 control-label">Address 1:</label>
			<div class="col-md-3">
			<input type="text" name="addr1" class="form-control" placeholder="address" value="<?php echo $addr1; ?>"/>
			</div>
			<span id="addr1_stat" class='col-md-3'><?php echo $addr1_stat; ?></span>
		</div>

		<div class="form-group">
			<label for="addr2" class="col-md-3 control-label">Address 2:</label>
			<div class="col-md-3">
			<input type="text" name="addr2" class="form-control" placeholder="address" value="<?php echo $addr2; ?>"/>
			</div>
			<span id="addr2_stat" class='col-md-3'><?php echo $addr2_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="state" class="col-md-3 control-label">State:</label>
			<div class="col-md-3">
			<input type="text" name="state" class="form-control" placeholder="state" value="<?php echo $state; ?>"/>
			</div>
			<span id="state_stat" class='col-md-3'><?php echo $state_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="country" class="col-md-3 control-label">Country:</label>
			<div class="col-md-3">
			<select name="country" class="form-control" value="<?php echo $country ?>" >
			<?php include_once("template_country_list.php"); ?></select>
			</div>
			<span id="country_stat" class='col-md-3'><?php echo $country_stat; ?></span>
		</div>
		-->
		<div class="form-group">
			<label for="mobile" class="col-md-3 control-label">Mobile:</label>
			<div class="col-md-3">
				<input type="text" name="mobile" class="form-control" placeholder="mobile (optional)" value="<?php echo $mobile; ?>"/>
			</div>
			<span id="mobile_stat" class='col-md-3'><?php echo $mobile_stat; ?></span>
		</div>
		<div class="form-group">
			<label for="mobile" class="col-md-3 control-label"></label>
			<div class="col-md-3">
				<p id="captcha_print" style="color:#660066;font-size:18px;background-color:pink;width:30%;"></p>
			</div>
		</div>	
		<div class="form-group">
			<label for="captcha" class="col-md-3 control-label">Captcha:<span style="color:red;">&nbsp;*</span></label>
			<div class="col-md-3">
				<input type="text" name="captcha" class="form-control" placeholder="Enter Captcha" />
			</div>
		</div><br>
		<div class="form-group">
			<div class="col-md-offset-1 col-md-4">
				<input type="submit" value="Signup" class="btn btn-success"/>
				<input type="reset" value="Reset" class="btn btn-primary"/>
			</div>
		</div>

        </form>
    </div>
    
</body>
</html>
<?php echo "<br><br><br>";include_once("footer.php");?>
