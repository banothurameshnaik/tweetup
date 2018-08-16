<?php include_once("login_status.php"); ?>
<?php
if(!isset($_GET['ref']))
{
	header("Location:user.php");
}
else
{
	$ref = $_GET['ref'];
	$qry = "SELECT id FROM forum_questions WHERE ref_id='$ref'";
	$sql = mysqli_query($conn,$qry);
	if(mysqli_num_rows($sql) == 0)
	{
		header("Location:user.php");
	}
}
?>
<?php
if(isset($_POST['answer']))
{
	$ans = $_POST['answer'];
	$qry = "INSERT INTO forum_answers(user,replyto,answer,datetime) VALUES('$log_username','$ref','$ans','$now')";
	$sql = mysqli_query($conn,$qry);
}
?>
<?php
//Retreiving question from forum_quesstions
$quest_forum = "";
$ref = $_GET['ref'];

$qry = "SELECT * FROM forum_questions WHERE ref_id='$ref'";
$sql = mysqli_query($conn,$qry);

$row = ($sql) ? mysqli_fetch_array($sql) : 0;

	$questioner = $row['user'];
	$sub = $row['subject'];
	$quest = nl2br($row['question']);
	$datetime = $row['datetime'];


$quest_forum .= "<div class='col-md-9 jumbotron myquestion'>";
$quest_forum .= "<span style='color:green;'>Subject <span style='font-size:12px;'>($datetime)</span> </span>: <h5><a href='forum.php?ref=$ref'>$sub</a></h5>";
$quest_forum .= "<hr>";
$quest_forum .= "<div><span style='color:green;'>Question </span>: <br>$quest</div><br>";
$quest_forum .= "</div>";

//Retreiving answers from forum_answres
$qry = "SELECT * FROM forum_answers WHERE replyto='$ref' ORDER BY datetime";
$sql = mysqli_query($conn,$qry);

$ans_list = "";
//$row = ($sql == true) ? mysqli_fetch_array($sql) : 0;

while( $row = mysqli_fetch_array($sql) )
{
	$replier = $row['user'];
	$quest_ref = $row['replyto'];
	$ans = nl2br($row['answer']);
	$datetime = $row['datetime'];
	
	$ans_list .= "<div class='col-md-12 jumbotron'>";
	$ans_list .= "<h6><a href='#' style='text-decoration:none;'>$replier</a> says :</h6>: <span style='font-size:12px;'>$datetime</span>";
	$ans_list .= "<hr>";
	$ans_list .= "<div class='col-md-3'></div><div class='col-md-8'>$ans</div>";
	$ans_list .= "</div><br>";
}
if(!mysqli_num_rows($sql))
	$ans_list = "Be first person to answer this question";
?>

<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
<div class="col-md-12 container">
	
	<div class="question col-md-9">
		<?php echo $quest_forum; ?>
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-9">
			<?php echo $ans_list; ?>
			
		<form action="" method="POST" class="form-horizontal">
			<div class="form-group">
				<br><label for="answer" class="col-md-3 control-label" style='font-size:18px;'>Reply :</label>
				<div class="col-md-5" >
					<textarea type="text" name="answer" rows='7' class="form-control" placeholder="Answer" 
						value="Reply to Question" ></textarea>
					
				</div>
				<div class="col-md-4">
					<input type="submit" value="Submit" class="btn btn-success"/>
				</div>
				
			</div>
			
		</form>
	</div>
</div>
</body>

</html>

<?php include_once("footer.php"); ?>
