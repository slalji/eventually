<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Boresha Maisha</title>
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="180x180" href="ace/images/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="ace/images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="ace/images/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">


		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.green.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><!--<i class="fa fa-tree" </i>--><img src="images/boresha.png" width="100">Boresha Maisha</h1>

				<p><small>Improve Life</small></p>
			</header>
		<?php
			if (isset ($_GET['err']) && $_GET['err'] == 1){
			echo '<span class="error" style="color:#ffc800"> *'."Error username or password, Try again ! "."</span>";
			}
		?>
		<!-- Signup Form -->
			<form id="signup-form" method="post" action="login_exe.php">
				<input type="text" name="username" id="username" placeholder="Username" />
				<input type="password" name="password" id="password" placeholder="Password" />
				<input type="submit" value="Login" />
			</form>
		<?php

		?>



		<!-- Footer -->
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
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>