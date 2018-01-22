<?php
include("config.php");
include("class/user.php");
?>
<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Eventually by HTML5 UP</title>
		<meta charset="utf-8" />
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
		<p> Already a user?  <a href="index.html">Login</a>
		<div >
			<?php
			$err=array();

			if( ($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['register'] ) ) ) {
				$_POST['secret'] ='M6irpx5w';
				$usr = new Users();
				$usr->storeFormValues( $_POST );
				$err = $usr->validate();
				if ($err){
					foreach($err as $msg) {
						echo '<br><span class="message failure">*',$msg.'</span>';
					}

				}
				else {
					if ($usr->register() == 1)
					{
						echo '<br><span class="message success" style="color:#1cb495;">Registration successful, Thank you</span>';
					}

				}
				unset($_POST);
				$_POST['register'] = "";
				$err ="";
			}



			?>
		</div>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="<?php $_SERVER['PHP_SELF']?>">
				<input type="text" id="fullname" required autofocus name="fullname" placeholder="Fullname" />

				<br><input type="email" required name="email" id="email" placeholder="Email Address" />
				<br><input type="password" name="password" id="password" placeholder="Password" />
				<br><input type="password" id="conpasswd" size="50" maxlength="50" required name="conpassword" placeholder="Confirm Password" class="confirm"  />

				<input type="submit" value="Register" name="register" />
			</form>

		<!-- Footer
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Selcom 2018</li><li>Credits: <a href="http://selcom.net">Selcom</a></li>
				</ul>
			</footer>-->

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>