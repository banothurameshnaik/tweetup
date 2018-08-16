<?php
include_once("login_status.php");
if($user_ok == false)
{
		header("Location:login.php");
}
?>
<?php
$quest_forum = "";
$qry = "SELECT * FROM forum_questions";
$sql = mysqli_query($conn,$qry);

	$quest_forum .= "<div class='col-md-9 jumbotron myquestion'>";
while($row = mysqli_fetch_array($sql))
{
	$ref = $row['ref_id'];
	$sub = $row['subject'];
	$datetime = $row['datetime'];
	

	$quest_forum .= "<h5><a href='forum.php?ref=$ref' style='text-decoration:none;'>$sub</a>($datetime)</h5>";
}
	$quest_forum .= "</div>";
?>
<?php
$your_forum = "";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$sub = $_POST['subject'];
	$question = $_POST['question'];
	
	$rand1 = mt_rand(10000,99999);
	$rand2 = mt_rand(10000,99999);
	$ref_id = "$rand1"."$rand2";
	
	$qry = "INSERT INTO forum_questions(ref_id,user,subject,question,datetime) VALUES('$ref_id','$log_username','$sub','$question','$now')";
	$sql = mysqli_query($conn,$qry);
	if($sql)
	{
		$your_forum .= "<div class='col-md-8 jumbotron myquestion'>";
		$your_forum .= "Subject : <h5><a href='forum.php?ref=$ref_id'>$sub</a></h5>";
		$your_forum .= "<hr>";
		$your_forum .= "<div>$question</div><br>";
		$your_forum .= "</div>";
	}
	else
		$your_forum .= "Unable to submit";
}
?>

<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>

<head>
<style>
.forum_form
{
	margin-top:20px;
}
</style>
</head>

<body>

<div class="col-md-12">
<label for="Head" class="col-md-9 control-label"><h4 style="text-align:center;color:green;">Forum </h4></label><br>
	<?php echo $your_forum; ?>
	
	<div class="col-md-8">
		<?php  echo $quest_forum; ?>
	</div>
	<label for="Head" class="col-md-4 control-label"><h4 style="text-align:center;color:#ffefff;">Create Forum </h4></label>	
	<div class="col-md-4 forum_form">

		<form action="" method="POST" class="form-horizontal">
			<div class="form-group">
				<label for="subject" class="col-md-3 control-label">Subject<span style="color:red;">&nbsp;*</span>:</label>
				<div class="col-md-8">
					<input type="text" name="subject" class="form-control" placeholder="Subject" value="" />
				</div>
			</div>
			<div class="form-group">
				<label for="question" class="col-md-3 control-label">Question<span style="color:red;">&nbsp;*</span>:</label>
				<div class="col-md-8">
				<textarea type="text" name="question" class="form-control" placeholder="Question" value="" ></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-8">
					<input type="submit" value="Submit" class="btn btn-success"/>
					<input type="reset" value="Reset" class="btn btn-primary"/>
				</div>
			</div>
		</form>
	</div>
</div>



</body>

</html>
<?php include_once("footer.php"); ?>
