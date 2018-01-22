<?php

session_start();
$_SESSION["session"]='false';

/*
 * If register, validate input, create and save new user to database and allow login
 * Else show error messages and allow them to make corrections and try again
 * Use JQuery Ajax call to allow distinict username by check database
 * Inviation code ensure only those that got email with that secrete password can register
 */
	include("config.php");
        include("class/user.php");
  // 
    $ch='';

    if( isset( $_REQUEST['email'] )  ) {

	$usr = new Users;

	$usr->storeFormValues( $_REQUEST );
        //$ch = $usr->userLogin();
$fullname = $usr->userLogin();
        if (!$fullname){
            $_SESSION["authenticated"]= 'false';
            //var_dump($_REQUEST);
            header('location:index.php?err=1');

        }
        else{
var_dump($_SESSION);
            $_SESSION["authenticated"]= 'true';
            $sess_cookie =session_id();
            $_SESSION["id"]= $sess_cookie;  //session_id();
            $_SESSION["fullname"] = $fullname;
           // echo $fullname;
            echo '<script>$.setcookie("sessionId",$sess_cookie);</script>';
            //echo '<script>$.cookie("sessionId", '.$sess_cookie.')</script>';
            echo '<script>console.log("login-exe: "+$.cookie("sessionId"));</script>';
            header('location:./ace');
        }


    }
    
        
       
        
     
?>
 