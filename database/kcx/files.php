<?php
$server= "localhost";
$username= "root";
$password= '';
$conn = new mysqli($server,$username,$password);
if ($conn->connect_error)
{
  die("Connection to database failed:". $conn->connect_error);
}
$databasename = "ci2";
mysqli_select_db($conn,$databasename);
$tablename = "files";
$table = "CREATE TABLE ".$databasename.".".$tablename."(
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL
)";
$sql = mysqli_query($conn,$table);
if($sql)
    echo "Table ".$tablename." is created";
else
    echo $tablename." Table hadn't been created";
//echo $table;