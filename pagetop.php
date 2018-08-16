<?php
$notif = "";
$chat_notif = "";

include_once("login_status.php");
$qry = "SELECT * FROM messages WHERE read_status='0' AND receiver='$log_username'";
$sql = mysqli_query( $conn,$qry );

$unread_no = 0;
if ($sql) {
	while($row  = mysqli_fetch_array($sql))
	{
		$unread_no++;
		$sender = $row['sender'];
		
		$qry2 = "SELECT id FROM messages WHERE read_status='0' AND receiver='$log_username' AND sender='$sender'";
		$sql2 = mysqli_query( $conn,$qry2 );
		$msg_cnt = mysqli_num_rows($sql2);
		$chat_notif = "<li>
					<a href='chat.php?user=$sender'>$sender  ($msg_cnt)</a>
				</li>";
	}
}
if($unread_no)
	$notif = " ( $unread_no ) ";
?>

<?php 
$display1_ok="";
$display2_ok="";
$display_login='';
$display_mmm='';
$display3_ok="none";
if($user_ok)
{
	$display1_ok="none";
	$display2_ok="";
	if($log_username == "admin")
		$display3_ok="";
}
else
{
	$display1_ok="";
	$display2_ok="none";
}
?>
<html>
<head>

<!-- Pagetop Starts Here-->
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
	<script src="bs_files/js/jquery.js" rel="javascript"></script>
	<link href="bs_files/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="bs_files/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="bs_files/css/web2py-bootstrap3.css" rel="stylesheet" type="text/css"/>
	<script src="bs_files/js/bootstrap.js" rel="javascript"></script>
	<script src="bs_files/js/bootstrap.min.js" rel="javascript"></script>

	<script src="bs_files/js/dropdown.js" rel="javascript"></script>
	<script src="bs_files/js/collapse.js" rel="javascript"></script>
	<script src="bs_files/js/web2py-bootstrap3.js" rel="javascript"></script>
	<link href="css/r_all.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" >
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">TweetUp</a>
			</div>
				<!-- ######### Navigation Panel Goes here ###########-->
				
			<div>
				<ul class="nav nav-pills navbar-nav navbar-left">
					<li class="active" ><a href="index.php">
						<i class="glyphicon glyphicon-home"></i> Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Services<i class="caret"></i></a>
						<ul class="dropdown-menu">
							<li><a href="chat.php" ><i class="glyphicon glyphicon-envelope"></i> &nbsp;&nbsp;Chat</a></li>
							<li><a href="create_forum.php" ><i class="glyphicon glyphicon-list"></i> 
									&nbsp;&nbsp;Forum</a></li>

							<li class="disabled"><a href="">Sudoku Game</a></li>
							<li class="disabled"><a href="">Services</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href='' data-toggle="dropdown">Tutorials<i class="caret"></i></a>
						<ul class="dropdown-menu">
							<li >	<a href="services/www.w3schools.com">w3schools</a></li>
							<li >	<a href="services/javatpoint">JavaTpoint</a></li>
							
						</ul>
					</li>
					<li >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Useful Sites<i class="caret"></i></a>
				
						<ul class="dropdown-menu">
							<li><button class="btn btn-info dropdown-header">No Proxy Sites </button></li>
							<li ><a href="http://10.10.2.53/hub" target='_blank'>RGUKT-Hub</a></li>
							<li ><a href="http://engg3a.bas.rgukt.in" target='_blank'>Engg3a</a></li>
							<li ><a href="http://10.10.2.53/hub/results" target='_blank'>RGUKT-Results</a></li>
							<li class="divider"></li>
							<li><button class="btn btn-info dropdown-header"> Proxy Sites </button></li>
							<li ><a href="http://www.google.co.in" target='_blank'>Google</a></li>
							<li ><a href="http://www.w3schools.com" target='_blank'>Learn - HTML</a></li>
						<li ><a href="http://www.tutorialspoint.com" target='_blank'>Turotialspoint.com</a></li>
							<li ><a href="http://www.thehindu.com" target='_blank'>The Hindu News Paper</a></li>
							<li ><a href="http://www.eenadu.net" target='_blank'>Eenadu News Paper</a></li>
						</ul>
				
					</li>
					<li class="drodown disabled" >
						<a href="" >BMA &nbsp;</i></a>
					</li>
					<li class="drodown disabled">
						<a href="libray.php" data-toggle="dropdown">Digital Library<i class="caret"></i></a>
						<ul class="dropdown-menu" style='display:none'>
							<li><a href="login.php">Log-In</a></li>
							<li><a href="status.php">My Status</a></li>
							<li><a href="books-view.php">Book View</a></li>
							<li><a href="books-search.php">Book Search</a></li>
							<li><a href="upload.php">Book Upload</a></li>
							
						</ul>
					</li>
					<li class="drodown disabled" >
						<a href="" data-toggle="dropdown">Attendance<i class="caret"></i></a>
						<ul class="dropdown-menu" style='display:none'>
							<li><a href="stu_login.php">Student Log-In</a></li>
							<li><a href="faculty_login.php">Faculty Log-In </a></li>
							<li><a href="auth_login.php">Authority Log-In</a></li>
						</ul>
					</li>
					<li >
						<a href="about_us.php" >About Us</a>
					</li>
					
				</ul>
				<div class="nav navbar-nav navbar-right navbar-pills" style="margin-right:15px;display:<?php echo $display1_ok?>">
					<li class="drodown">
						<a href="" data-toggle="dropdown">Signup &nbsp;<i class="glyphicon glyphicon-pencil"></i></a>
						<ul class="dropdown-menu">
							<li><a href="signup.php">Sign Up</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Log-In <i class="caret"></i></a>
						<ul class="dropdown-menu">
							<li><a href="login.php"><i class="glyphicon glyphicon-user"></i> &nbsp;Login</a></li>
							<li><a href="login_recovery.php"><i class="glyphicon glyphicon-user"></i> &nbsp;Lost Password</a></li>
						</ul>
					</li>
				</div>
				<div class="nav navbar-nav navbar-right navbar-pills" style="margin-right:15px;display:<?php echo $display2_ok; ?>">
					<li class="dropdown" style="display:<?php echo $display3_ok; ?>">
						<a href='admin.php'>Admin</a>
					</li>
					<li class="dropdown">
						<a href="notifications.php" data-toggle="dropdown" style="text-decoration:none;">Notifications<?php echo $notif; ?></a>
						<ul class="dropdown-menu">
							<?php echo $chat_notif; ?>
							<li><a href="notifications.php">More</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="" data-toggle="dropdown">
							<i class="glyphicon glyphicon-user"></i> <?php echo "$log_username"; ?><i class="caret"></i></a>
						<ul class="dropdown-menu">
							<li ><a href="user.php"><i class="glyphicon glyphicon-th"></i> &nbsp;&nbsp;e-Profile</a></li>
							<li ><a href="chat_history.php"><i class="glyphicon glyphicon-envelope"></i> &nbsp;&nbsp;Chat history</a></li>
							<li ><a href="change_password.php"><i class="glyphicon glyphicon-lock"></i> &nbsp;&nbsp;Password</a></li>
							<li ><a href="logout.php"><i class="glyphicon glyphicon-off"></i> &nbsp;&nbsp;LogOut</a></li>
						</ul>
					</li>
				</div>
			</div>
				<!-- ######### Navigation Panel Ends here #########-->
			
		</nav>
</body>
</html>
<!-- Pagetop  Here-->
