<?php
include_once("database/db_connect.php");
$checked = 0;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $camp_id = $_POST['id_number'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $addr1 = $_POST['addr1'];
    $addr2 = $_POST['addr2'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $mobile = $_POST['mobile'];
    $captcha = $_POST['captcha'];
    $now = date('m-d-Y g:i:sA');


    //validation starts from here

    if(strlen($camp_id) == 7)
    {
        if( !preg_match("/^B[0-9]*$/",$camp_id) )
        {
            $camp_id_stat = "Enter valid ID";
            $checked++;
        }
    }
    else
    {
        $camp_id_stat = "Campus ID can not be lesser or greater than 7 characters";
        $checked++;
    }
    if(strlen($fname) <= 30)
    {
        if( !preg_match("/^[a-zA-Z ]*$/",$fname) )
        {
            $name_stat = "Enter valid First Name";
            $checked++;
        }
    }
    if(strlen($lname) <= 30)
    {
        if( !preg_match("/^[a-zA-Z ]*$/",$lname) )
        {
            $name_stat = "Enter valid Last Name";
            $checked++;
        }
    }
    else
    {
        $name_stat = "This field can't be greater than 30 characters";
        $checked++;
    }
    if(strlen($uname)<=15)
    {
        if(!preg_match("/^[a-zA-Z][0-9a-zA-Z]*$/",$uname))
        {
            $uname_stat = "This can't have special characters or digits at beginning";
            $checked++;
        }
    }
    if(strlen($pass)<4)
    {
        $pass_stat = "Password should have atleast 4 characters";
        $checked++;
        if($pass != $cpass)
        {
            $cpass_stat = "Password fields do not match";
            $checked++;
        }
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $email_stat = "Enter valid Email";
        $checked++;
    }
    if($country == null)
    {
        $country_stat = "Select your country";
    }
    if(!preg_match("/^[a-zA-Z ]*$/",$state))
    {
        $state_stat = "Enter valid State Name";
    }

    if(strlen($mobile) != 10)
    {
        $mobile_stat = "Enter valid Mobile Number";
        $checked++;
        if(!preg_match("/^[0-9]*$/",$mobile))
        {
            $mobile_stat = "Enter valid Mobile Number";
            $checked++;
        }
    }
    if($captcha != $rand)
    {
        $captcha_stat = "Type in captcha again";
    }

    if($checked == 0)
    {
        echo "signup successfull";
    }

}
?>
