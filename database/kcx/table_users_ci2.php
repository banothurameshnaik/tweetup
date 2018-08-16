<?php
include_once("db_connect.php");
$databasename = "ci2";
mysqli_select_db($conn,$databasename);
$tablename = "users";
$table = "CREATE TABLE ".$tablename."(
                    id INT AUTO_INCREMENT NOT NULL,
                    fullname VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NULL,
                    username VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    authtype VARCHAR(255) NULL,
                    login_stat BOOLEAN NULL,
                    UNIQUE(username),
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$table);
if($sql)
    echo "Table ".$tablename." is created";
else
    echo $tablename." Table hadn't been created";
//echo $table;