<?php
include("../config.php");
include("../class/user.php");
$temp = null;
$confirm=null;
$new=null;
$user=null;
$email='';
$errmsg_arr = array();

if( isset( $_POST['email'] ) ) $email = stripslashes( strip_tags( $_POST['email'] ) );
if( isset( $_POST['temppass'] ) ) $temp =  $_POST['temppass'] ;
if( isset( $_POST['password'] ) ) $password = $_POST['password'];
if( isset( $_POST['conpassword'] ) ) $confirm = $_POST['conpassword'] ;

$usr = new Users();
$usr->storeFormValues($_POST);
$check = $usr->checkemail();
echo $check;
$err = json_encode($check);
$messages= null;
$error = ($usr->validate());
//echo '<div class="message failure" style=opacity:1> ';
if ($err)
    $messages[] = $err;



foreach ($error as $err)
    $messages[]  = $err ;
if(!$messages){
    $err = $usr->addNewPassword();
    if ($err != 'db updated')
        $messages[] = $err;
    else {
        echo "Successfully updated";
        header('location:index.php');
    }
}


