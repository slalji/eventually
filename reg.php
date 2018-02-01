<?php
include("config.php");
include("class/user.php");
$fullname='';
$email='';
if (isset($_POST['fullname']))
	$fullname = $_POST['fullname'];

if (isset($_POST['email']))
	$email = $_POST['email'];
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
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><i class="fa fa-tree"></i>Boresha Maisha</h1>Admin
				<p>Register New Admin User</p>

			</header>
		<p> Already a user?  <a href="index.php">Login</a>
		<br><strong >Note: password will automatically be generated. User must change their password at first login !</strong></p>
		<p>
			<?php


			if( ($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['register'] ) ) ) {
				$usr = new Users();
				$usr->storeFormValues( $_POST );
				/**
				 * Generated auto password. User changes password on first login
				 * check for email, make sure its not in use.
				 */
				$err=array();
				$err = $usr->checkemail();

				if ($err) {
					//else {
					foreach ($err as $msg) {
						echo '<br><span class="message failure" style="opacity: 1">*', $msg . '</span>';
					}
				}
				else{
					$result = $usr->register();
					if ($result) {
						$my_password = $usr->getPassword();

						if ($my_password) {

							echo '<br><span class="message success" style="color:#1cb495; opacity: 1">Registration successful,' .
								' Thank you</span><br>Your Password is: ' .
								' <code> ' . $my_password . '</code> <br>' .
								'<span style="color:red">COPY and email it to the user :</span> <a href"mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>';
							header("Refresh: 10; location:index.php");
						}else{
							echo $result;
						}
					}


				}
			}



			?>
		</p>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
				<input type="text" id="fullname" required autofocus name="fullname" placeholder="Fullname" value="<?php echo $fullname ?>" />

				<br><input type="email" required name="email" id="email" placeholder="Email Address" value="<?php echo $email?>" />
				<select name="interval" required="required" >
					<option value=0>Expiry Interval</option>
					<option value=30">30 Days</option>
					<option value=90>90 Days</option>
					<option value=180>180 Days</option>
					<option value=270>270 Days</option>
					<option value=365>365 Days</option>
				<br><input type="submit" value="Register" name="register" />
			</form>


		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
	<script src="ace/assets/js/jquery-2.1.4.min.js"></script>
<script>

	$(document).ready(function() {
		$("#submit").attr("disabled", "disabled");

		$("input[type=text]").keyup(function() {
			if ($("input[type=submit]").is( ":disabled" ) )
				$("input[type=submit]").removeAttr("disabled");
		});
		$("#signup-form").submit(function(e) {
			e.key('F5').preventDefault();
			e.preventDefault();
		});


	});
</script>
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

</style>
</html>