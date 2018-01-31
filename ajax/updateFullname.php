<?php
include("../config.php");
include("../class/user.php");
$fullname = null;
$email=null;


if( isset( $_POST['fullname'] ) ) $fullname = ( $_POST['fullname'] );
if( isset( $_POST['email'] ) ) $email =  $_POST['email'] ;

$usr = new Users();
echo $usr->setFullname($email, $fullname);

