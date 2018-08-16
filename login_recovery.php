<?php
include_once("login_status.php");
$root = $_SERVER['DOCUMENT_ROOT'];
$ip = preg_replace('#[^0-9.]#','',getenv('REMOTE_ADDR'));
$file = fopen("$root/tweetup/visited.txt",'a');
$save = "$ip  $now".PHP_EOL;
fwrite($file,"$save");

?>
<html>
<head>
	<title>TweetUp</title>
	<?php include_once("pagetop.php")?>
	<link href="css/nav1.css" rel="stylesheet" type="text/css"/>
	<link href="css/r_all.css" rel="stylesheet" type="text/css"/>
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
	<script src="bs_files/js/carousel.js" rel="javascript"></script>
	<style>
	 .slideshow
	 {
	 	margin-top:15px;
	 }
	 .footer2
	 {
	 	padding-left:15px;
	 }
	 .updates
	 {
	 	margin-top:15px;
	 	padding:0px;
	 	height:85%;
	 	border:solid 1px black;
	 	overflow:auto;
	 }
	 .under_process
	 {
	 	margin-top:100px;
	 }
	</style>
	<script type="text/javascript">
		
	</script>
</head>
<body onbeforeunload="return logout()">

	<div class="col-md-12">
	<div class="alert alert-warning alert-dismissible under_process" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><h2 align="center"> Work under process... </h2></strong>

	    <h5 align="center"> <font color="green"></font> </h5>
	    <h5 align="center"> <font color="">We'll provide this service as soon as possible</font> </h5>
		</div>
	</div>
</body>
</div>
<div class="footer2">
<?php include_once("footer.php")?>
</div>
</body>
</html>
