<?php
include_once("db_connect.php");
$table = "CREATE TABLE users(
                    id INT AUTO_INCREMENT NOT NULL,
                    campus_id VARCHAR(255)  NULL,
                    first_name VARCHAR(255) NOT NULL,
                    last_name VARCHAR(255) NULL,
                    username VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    gender VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    address1 VARCHAR(255) NULL,
                    address2 VARCHAR(255) NULL,
                    state VARCHAR(255)  NULL,
                    country VARCHAR(255)  NULL,
                    mobile VARCHAR(255) NULL,
                    signup VARCHAR(255) NULL,
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
    echo "Users Table hadn't been created";
$qry = "CREATE TABLE profile(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    username VARCHAR(255) NOT NULL,
                    color VARCHAR(255) NULL,
                    theme VARCHAR(255) NULL,
                    PRIMARY KEY(id),
                    UNIQUE(username)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table profile created<br>";

$qry = "CREATE TABLE messages(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    sender VARCHAR(255) NOT NULL,
                    ip VARCHAR(255) NULL,
                    receiver VARCHAR(255) NOT NULL,
                    message VARCHAR(255) NULL,
                    read_status BOOLEAN NOT NULL,
					deleted_from VARCHAR(255) NULL,
					deleted_count INT(10) NULL DEFAULT  '0',
                    time DATETIME,
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table messages created<br>";

    $qry = "CREATE TABLE feedback(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    username VARCHAR(255) NOT NULL,
                    ip VARCHAR(255) NULL,
					status varchar(255) NOT NULL,
                    feedback VARCHAR(255) NULL,
					time VARCHAR(255) NULL,
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table feedback created<br>";
    
    $qry = "CREATE TABLE istyping(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    typing ENUM('0','1') NULL DEFAULT '0',
                    username VARCHAR(255) NOT NULL,
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table istyping created<br>";
    
$qry = "CREATE TABLE forum_questions(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    ref_id VARCHAR(11) NOT NULL UNIQUE,
                    user VARCHAR(255) NOT NULL,
                    subject VARCHAR(255) NULL,
                    question VARCHAR(2000) NOT NULL,
                    datetime VARCHAR(255),
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table forum_questions created<br>";
    
$qry = "CREATE TABLE forum_answers(
                    id INT(11) AUTO_INCREMENT NOT NULL,
                    user VARCHAR(255) NOT NULL,
                    replyto VARCHAR(11) NOT NULL,
                    answer VARCHAR(2000) NOT NULL,
                    datetime VARCHAR(255),
                    PRIMARY KEY(id)
)";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "table forum_answers created<br>";
?>