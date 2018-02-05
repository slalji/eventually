<?php
include("../config.php");
include("../class/user.php");
$temp = null;
$confirm=null;
$new=null;
$user=null;
$email='';
$errmsg_arr = array();

if( isset( $_REQUEST['email'] ) ) $email = stripslashes( strip_tags( $_REQUEST['email'] ) );
if( isset( $_REQUEST['temppass'] ) ) $temp =  $_REQUEST['temppass'] ;
if( isset( $_REQUEST['newpass'] ) ) $password = $_REQUEST['newpass'];
if( isset( $_REQUEST['confirmpass'] ) ) $confirm = $_REQUEST['confirmpass'] ;

similar_text($temp, $password, $percent);
if ($percent >=30)
    $message[]="Your new password cannot be similar to your previous password";

$usr = new Users();
$usr->storeFormValues($_REQUEST);
$check = $usr->checkemail();
$err = json_encode($check);
if ($err == 'null')
    $message[]= 'invalid email address '.$email;


$error = ($usr->checkNewPassword($_REQUEST));
//$past_hash = $usr->getPastHash();


foreach($error as $err)
   $message[] =$err;
if (empty($message))
    echo $usr->addNewPassword();
else{
    foreach ($message as $msg)
        echo "<br>".$msg;
}


