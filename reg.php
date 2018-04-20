<?php
include("config.php");
include("class/user.php");
$fullname='';
$email='';




	if( isset( $_POST['register']) && $_POST['register'] == 'Register') {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
	
	
		$usr = new Users();
		$usr->storeFormValues( $_POST );
		/**
		 * Generated auto password. User changes password on first login
		 * check for email, make sure its not in use.
		 */
		$message=array();
		$message[] = $usr->checkusername();
		$message[] = $usr->checkemail();
	
		
			if ($message[0] == '' && $message[1]=='') {
				$result = $usr->register();
				$my_password = $usr->getPassword();
				//print_r($my_password);
				//$usr->sendemail($my_password, $_POST['email']);
				if ($my_password) {

					$message[]= '<br><span id="message" class="message success" style="color:#1cb495; opacity: 1">Registration successful,' .
						' Thank you</span><br>Your Password is: ' .
						' <code> ' . $my_password . '</code> <br>' .
						'<span style="color:#ffc800">COPY and email it to the user :</span> <a href"mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>';
					//header("Refresh: 10; location:index.php");
					
				}else{
					$message[]= $result;
				}
			


		}
	}



	?>
<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Registration</title>
		<meta charset="utf-8" />
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="-1">

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.green.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1></h1>Admin
				<p>Register New Admin User</p>

			</header>
		<p> Already a user?  <a href="index.php">Login</a>
		<br><strong >Note: password will automatically be generated. User must change their password at first login !</strong></p>
		<p><span style="color:#ffc800">
<?php
if (isset($message)){
	
foreach($message as $msg)	
	echo  "<li>".$msg."</li>";
}
?>
	</span></p>
	<div <?php if (isset($my_password)){ echo 'style="display:none;"'; }?>>
	
		<!-- Signup Form -->
			<form id="signup-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
				<input type="text" id="fullname" required autofocus name="fullname" placeholder="Fullname"   />

				<br><input type="text" required name="username" id="username" placeholder="Username"   />
				<br><input type="email" required name="email" id="email" placeholder="Email Address"  />
				
				<br><input type="submit" value="Register" name="register" />
			</form>

</div>
		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
	

<style>
	option  {

		background-color: rgba(9, 8, 9, 0.75) !important;

	}
	select{
		width: 20% !important;
		-webkit-appearance: normal !important;
		-ms-appearance:  normal !important;
		-moz-appearance:  normal !important;
		-webkit-appearance:normal !important;
		appearance:  normal !important;
	}
	.message{
		color:#ffc800;
	}
	li{
		color:#cc0000;
		list-style-type: none;
	}

</style>
<script>
$( document ).ready(function() {
	console.log( "ready!" );
	var code = $( "code" ).text()
	alert(code);
});
</script>
</html>