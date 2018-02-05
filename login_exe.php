<?php
session_start();
$_SESSION = array();
//$_SESSION='false';



/*
 * If register, validate input, create and save new user to database and allow login
 * Else show error messages and allow them to make corrections and try again
 * Use JQuery Ajax call to allow distinict username by check database
 * Inviation code ensure only those that got email with that secrete password can register
 */
	include("config.php");
        include("class/user.php");
  // 

    if( isset( $_POST['email'] )  ) {

	$usr = new Users;
	$usr->storeFormValues( $_POST );


        $data = $usr->userLogin();

        if ($data == false){
            header('location:index.php?err=1');
            }

        $token = uniqid();
        //die(var_dump($data));
        if (!isset($data['firsttime'])) {
            //
            header('location:index.php?err=1');
        }
        else if ($data['firsttime'] == 'true') {
           // var_dump('First Time! ' . $data);
            $_SESSION["authenticated"] = 'true';
            $_SESSION["fullname"] = $data['fullname'];
            $_SESSION["joined"] = $data['joined'];
            $_SESSION["email"] = $data['email'];
            $_SESSION["firsttime"] = $data['firsttime'];
            $_SESSION["interval"] = $data['expiry'];
            $_SESSION["token"] = $token;
            //session_destroy();
            header('location:new.php');
        }
        else if ($data['firsttime'] == 'false'){

            $_SESSION["authenticated"] = 'true';
            $_SESSION["fullname"] = $data['fullname'];
            $_SESSION['token']=$token;
            $_SESSION['firsttime']='false';
            $_SESSION["joined"] = $data['joined'];
            $_SESSION["interval"] = $data['expiry'];
            $usr->updateToken($token); //lastlogin changed to current
           //die($usr->updateCurrentlogin($token));
            if (date('Y-m-d') >= $usr->getExpiryDate($token))
                header('location:expired.php');
            else {
                //die(var_dump($data));
                header('location:ace/');}
        }






    }
    
        
       
        
     
?>
 