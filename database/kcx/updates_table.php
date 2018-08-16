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
$tablename = "updates";
$table = "CREATE TABLE ".$databasename.".".$tablename."(
                    sno INT AUTO_INCREMENT NOT NULL,
                    news VARCHAR(500)  NULL,
                    readmorelink VARCHAR(500) NOT NULL,
                    status VARCHAR(10) NULL,
                    PRIMARY KEY(sno)
)";
echo $table;
$sql = mysqli_query($conn,$table);
if($sql)
    echo "Table ".$tablename." is created";
else
    echo $tablename." Table hadn't been created";
//echo $table;