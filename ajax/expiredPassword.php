<?php
include("../config.php");
include("../class/user.php");
$temp = null;
$confirm=null;
$new=null;
$user=null;
$email='';
$errmsg_arr = array();
$messages=null;

if( isset( $_REQUEST['email'] ) ) $email = stripslashes( strip_tags( $_REQUEST['email'] ) );
if( isset( $_REQUEST['temppass'] ) ) $temp = $_REQUEST['temppass'];
if( isset( $_REQUEST['password'] ) ) $password = $_REQUEST['password'];
if( isset( $_REQUEST['conpassword'] ) ) $confirm = $_REQUEST['conpassword'] ;

$usr = new Users();
$usr->storeFormValues($_REQUEST);
//var_dump($_REQUEST);
if (!$usr->verifyPassword($temp))
    $messages[]="Invalid Previous Password";

similar_text($temp, $password, $percent);
if ($percent >=30)
    $messages[]="Your new password cannot be similar to your previous password";

$check = $usr->checkemail();
$err = json_encode($check);
if ($err == 'null')
    $messages[]= 'invalid email address '.$email;


$error = ($usr->validate());
foreach ($error as $err)
    $messages[]  = '<li>'.$err ;

//echo '<div class="message failure" style=opacity:1> ';
if ($usr->getFirsttime($_REQUEST['email']) == 'true')
    $messages[] = '<li>You are a first time user. You require temporary password to login. If you have forgotten, please contact Administration</li>';
if (empty($messages)) {
    $expiry = $usr->expiredPassword();
    if ($expiry != 'true')
        $messages[] = $expiry;
}

if(!$messages){
        echo "db updated";
        //header('refresh:5;url=index.php');

}
else
   echo json_encode($messages);


