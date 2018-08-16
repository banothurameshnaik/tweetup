<?php

?>
<?php include_once("pagetop.php"); ?>
<!DOCTYPE html>
<html>
    <title>Feedback</title>
    <head>
   <!--     <link rel="stylesheet" type="text/css" href="css/main_all.css"/> -->
    </head>
	<script>
		function validate()
		{
			if(document.feedForm.status.value == "")
			{
				alert("Please select any one of status !!!");
				return false;
			}
		return (true);
		}
		
	</script>
<body>
<div class="col-md-12">
	
</div>
</body>
</html>

<?php include_once("footer.php"); ?>
