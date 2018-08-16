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
	<link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
	<link href="css/nav1.css" rel="stylesheet" type="text/css"/>
	<link href="css/r_all.css" rel="stylesheet" type="text/css"/>
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
	<link href="bs_files/css/carousel.css" type="text/css"/>
	
	<script src="bs_files/js/carousel.js" rel="javascript"></script>
<style>
#mycarousel
{
	margin-top:10px;
	height:85%;
}
.updates
{
	margin-top:15px;
	height:85%;
	overflow:auto;
	padding:0px;
}
</style>
<style>
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/Preloader_8.gif) center no-repeat #fff;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>	
</head>
<body>
<div class="se-pre-con"></div>
<div class="col-md-12 bg">
	<div class='col-md-8'>
		<div id="mycarousel" class="carousel slide">
			<!--Carousel indicators-->
			<ol class="carousel-indicators">
				<li data-target="#mycarousel" data-slide-to="0" class="active"></li>
				<li data-target="#mycarousel" data-slide-to="1"></li>
				<li data-target="#mycarousel" data-slide-to="2"></li>
				<li data-target="#mycarousel" data-slide-to="3"></li>
				<li data-target="#mycarousel" data-slide-to="4"></li>
				<li data-target="#mycarousel" data-slide-to="5"></li>
			</ol>
			
			<!--Carousel items-->
			<div class="carousel-inner">
				<div class="item active">
					<img src="images/car.jpg" style='height:505px;width:100%;' alt="First"/>
					<div class="carousel-caption">Happy New Year</div>
				</div>
				<div class="item">
					<img src="images/car0.jpg" alt="First"/>
					<div class="carousel-caption">Art</div>
				</div>
				<div class="item">
					<img src="images/car1.jpg"/>
					<div class="carousel-caption">slide2</div>
				</div>
				<div class="item">
					<img src="images/car2.jpg"/>
					<div class="carousel-caption">slide3</div>
				</div>
				<div class="item">
					<img src="images/car3.jpg"/>
					<div class="carousel-caption">slide4</div>
				</div>
				<div class="item">
					<img src="images/car4.jpg"/>
					<div class="carousel-caption">slide5</div>
				</div>
			</div>
			<!--Carousel controls-->
				<a href="#mycarousel" class="carousel-control left " data-slide="prev">&lsaquo;</a>
				<a href="#mycarousel" class="carousel-control right " data-slide="next">&rsaquo;</a>
		</div>
	</div>
	<div class="col-md-4 updates jumbotron ">
		<div class="panel panel-success">
			<div class="panel-heading"><h4>Updates and Downloads</h4></div>
			<ul class="list-group">
				<span class="list-group-item">We are providing offline Tutorials in<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b>Tutorials Menu</b>
				<span>
			
			</ul>
							
			<ul class="list-group">
				<span class="list-group-item">Free to Chat with active users privately.<span>
			
			</ul>
			<ul class="list-group">
				<span class="list-group-item">Our site will be Best view  in chromium 5.0+<br> 
					<a href='downloads/chromium.zip'>click to download </a><span>
			
			</ul>
			
			
			
		</div>
	</div>
</div>
</body>

<div class="footer2">
<?php include_once("footer.php")?>
</div>
</body>
</html>
