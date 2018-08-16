<?php include_once("$_SERVER[DOCUMENT_ROOT]/site/pagetop.php"); ?>
<?php
include_once("$root/site/login_status.php");
if($user_ok == false || $log_username != "admin")
{
    header("Location:index.php");
}
?>
<?php

$qry = "SELECT * FROM users";
$sql = mysqli_query($conn,$qry);
$rows = mysqli_num_rows($sql);

#table creation starts from here on...

$users_table = "<div calss='admin_users'><table>";
$users_table .= "<tr>
                    <th>Serial No</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Mobile</th>
                    <th>Signup Date</th>
                    <th>Last Login</th>
                    <th>Login Status</th>
                    <th>IP address</th>
                </tr>";
$var = '1';
for( $var; $var<=$rows ; $var++)
{
    $users_table .= "<tr>";
        $qry = "SELECT * FROM users WHERE id='$var'";
        $sql = mysqli_query($conn,$qry);
        $array = mysqli_fetch_array($sql);

        $id = $array['id'];
        $camp_id = $array['campus_id'];
        $fname = $array['first_name'];
        $lname = $array['last_name'];
        $uname = $array['username'];
        /*$pass = $array['password'];*/
        $gender = $array['gender'];
        $email = $array['email'];
        /*$address1 = $array['address1'];
        $address2 = $array['address2'];*/
        $state = $array['state'];
        $country = $array['country'];
        $mobile = $array['mobile'];
        $signup = $array['signup'];
        $last_login = $array['last_login'];
        $login_stat = $array['login_stat'];
        $ip = $array['ip'];
        $users_table .= "<td>$id</td><td>$camp_id</td><td>$fname</td><td>$lname</td><td>$uname</td><td>$gender</td><td>$email</td><td>$state</td><td>$country</td><td>$mobile</td><td>$signup</td><td>$last_login</td><td>$login_stat</td><td>$ip</td>";
        $users_table .= "</tr>";
}
$users_table .= "</table></div>";
?>
<html>
    <title>Administration</title>
    <head>
        <style>
            table
            {
                border:5px;
                background-color:white;
            }
            th
            {
                background-color:#ef03ed;
            }
            tr
            {
                color:black;
                border:5px;
                width:auto;
            }
        </style>
    </head>

    <body>
        <?php echo $users_table; ?>
    </body>
</html>
