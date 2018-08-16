<?php
include_once("../login_status.php"); 
$photo_user="../users/$log_username/$log_username";
if(!file_exists("../users/$log_username"))
	mkdir("../users/$log_username",0075,TRUE);
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
<html>
<head><title>....</title>
</head>
<body>
</body>	
</html>
<?php
if(isset($_POST["submit"]))	
{
	$target_dir = "../users/$log_username/";
	$upload_ok = 0;
	$targetfile_name = (! empty($_FILES['fileToUpload']['name'])) ? $_FILES['fileToUpload']['name'] : null;
	$targetfile_type = (! empty($_FILES['fileToUpload']['type'])) ? $_FILES['fileToUpload']['type'] : null;
	$targetfile_size = (! empty($_FILES['fileToUpload']['size'])) ? $_FILES['fileToUpload']['size'] : null;
	$tmp_targetfile =  (! empty($_FILES['fileToUpload']['tmp_name'])) ? $_FILES['fileToUpload']['tmp_name'] : null;
	$imageFileType = pathinfo($targetfile_name,PATHINFO_EXTENSION);
	//echo "ImageFileType  $imageFileType<br><hr>";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$size_mb = $targetfile_size/(1024*1024);
	$size_kb=floor($size_mb*1024*10)/(10);
	
		if (file_exists($target_file)) 
		{
			echo "Sorry, file already exists.";
			echo "Please upload another file<br><hr>";
			$uploadOk = 0;
		}
		elseif($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "png" 
		 && $imageFileType != "JPEG" && $imageFileType != "jpeg" && $imageFileType != "GIF" && $imageFileType != "gif"  )
		{
			echo "Sorry , your uploaded file not an Image file<br>";
			echo "Please upload jpg or png or gif only <br><hr>";
			$upload_ok = 0;
		}
		elseif($size_mb > 5 )
		{
			echo "Sorry , your uploaded file greater than 5MB<br><br><hr>";
			echo "Please upload less than 5MB <br><hr>";
			$upload_ok = 0;	
		}
		else
		{
			$upload_ok = 1;	
		}
	//shellcode("");
if($upload_ok == 1 )
	{
		if($photo_ok)
			unlink("$photo_path");
		move_uploaded_file($tmp_targetfile,"$target_dir$targetfile_name");
		if($user_ok)
			rename("$target_dir$targetfile_name","$target_dir$log_username.$imageFileType");
		//echo "Your file '$targetfile_name'  has been uploaded successfully ...<br><hr>";
		//echo "File name : $targetfile_name <br><hr>";
		//echo "File size : $size_kb KB <br><hr>";
		//echo "File type : $targetfile_type <br><hr>";
		header("Location:../user.php");
	}
else
	{
		echo "Your File not uploaded !<br><hr>";
		echo "<h4><a href='../user.php'>Go to Profile</a></h4>";
	}
}
?>
