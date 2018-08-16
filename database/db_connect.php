 <?php
$server= "localhost";
$username= "root";
$password= 'rgukt123';
$conn = new mysqli($server,$username,$password);
if ($conn->connect_error)
{
  die("Connection to database failed:". $conn->connect_error);
}
$qry = "CREATE DATABASE EMBASE2";
$sql = mysqli_query($conn,$qry);
if($sql)
    echo "Database created";
mysqli_select_db($conn,'EMBASE2');
?>
