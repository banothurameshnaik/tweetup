<?php
include_once("db_connect.php");

$table = "CREATE TABLE users(
                    id INT AUTO_INCREMENT NOT NULL,
                    campus_id VARCHAR(255) NOT NULL,
                    first_name VARCHAR(255) NOT NULL,
                    last_name VARCHAR(255) NOT NULL,
                    username VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    gender VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    address1 VARCHAR(255) NULL,
                    address2 VARCHAR(255) NULL,
                    state VARCHAR(255) NOT NULL,
                    country VARCHAR(255) NOT NULL,
                    mobile VARCHAR(255) NULL,
                    signup VARCHAR(255) NOT NULL,
                    last_login VARCHAR(255) NOT NULL,
                    login_stat BOOLEAN NOT NULL,
                    ip VARCHAR(255),
                    PRIMARY KEY(id),
                    UNIQUE(username,campus_id)
)";
$sql = mysqli_query($conn,$table);
if($sql)
    echo "Table users is created";
else
    echo "Table can't be created";
?>
