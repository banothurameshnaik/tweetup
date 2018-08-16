<?php
include_once("db_connect.php");
$databasename = "ci2";
mysqli_select_db($conn,$databasename);
$tablename = "picture";
$table = "CREATE TABLE ".$tablename."(
                    id INT AUTO_INCREMENT NOT NULL,
                    pic_name VARCHAR(500)  NULL,
                    pic_title VARCHAR(500) NOT NULL,
                    pic_alter VARCHAR(500) NULL,
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$table);
if($sql)
    echo "Table ".$tablename." is created";
else
    echo $tablename." Table hadn't been created";
//echo $table;