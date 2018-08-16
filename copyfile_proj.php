<?php	
	copy("C:\Users\RAMESH NAIK\Desktop\IISC Project_MSP430\Code\tera_uart.tty","C:\Users\RAMESH NAIK\Desktop\IISC Project_MSP430\c1.txt");
	$file = fopen("C:\Users\RAMESH NAIK\Desktop\IISC Project_MSP430\c1.txt",'r');
	$size = filesize("C:\Users\RAMESH NAIK\Desktop\IISC Project_MSP430\c1.txt");
	//$data = fread($file,$size);
	$data="";
	$count=0;
	while(! feof($file))
	{	$count++;
		$data .= $count;
		$data .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$data .= fgets($file);
		$data .= "<br>";
	}
?>
<html>
<head>
<meta http-equiv="refresh" content="10" > 
<title>Refresh- Copy </title>
</head>
<body>
	<?php echo $data?>
</body>
</html>