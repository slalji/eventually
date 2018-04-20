<?php
include("config.php");
include("class/user.php");
session_start();
//var_dump($_SESSION);
$fullname='';
$email='';
$dbid='';

if (isset($_SESSION['fullname']))
	$fullname = $_SESSION['fullname'];


?>

<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>Update Password</title>
	<meta charset="utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />


	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
</head>
<body style="background:#a71616">

<!-- Header -->
<header id="header">
	<h1><i class="fa fa-tree"></i>Boresha Maisha</h1>
	<span class="errors">Expired Password !</span>  <br><span style="color:#1cb495"><?php echo $fullname?> </span> Your password has expired. Do not change it to any of the
	<b>last 3 passwords</b> used. Please choose a new strong password.

</header>

 <p>Already a user?  <a href="index.php">Login</a></p>
<div class="tooltip">
	<span class="tooltiptext"><i class="fa fa-info-circle"></i> Strong password: 8 characters long, with one lower and uppercase, number and special character</span>
</div>

<div class="errors" id="errors">

</div>


<p>
<!-- Signup Form -->
<form id="theForm" method="post" >
	<input type="email" id="email"  autofocus name="email"  placeholder="Email address" required value="<?php echo $email?>" />
	<input type="password" id="temppass"  autofocus name="temppass"  placeholder="Previous Password" required value=""   />
	<input type="password" id="newpass"  autofocus name="newpass"  placeholder="New Password" value="" required class="new" />
	<input type="password" id="confirmpass"  autofocus name="confirmpass"  placeholder="Confirm New Password" required value="" />


	 <input type="submit" value="Submit" id="submit" name="submit" />


</form>
<style>
	form{
		width: 100% !important;
		display:  inline-flex !important;
	}
	li{
		xline-height: 14px;
		xfont-size: 90%;
		list-style: none;

	}
	.errors{
		color:white; padding:5px; line-height: 18px; font-weight: bold; font-size: 14px; opacity: 1;
	}
	/* Tooltip container */
	.tooltip {
		position: relative;
		display: inline-block;
		border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
	}

	/* Tooltip text */
	.tooltip .tooltiptext {
		visibility: hidden;

		/* Position the tooltip text - see examples below! */
		xposition: absolute;
		xz-index: 1;
	}

	/* Show the tooltip text when you mouse over the tooltip container */
	.tooltip:hover .tooltiptext {
		visibility: visible;
	}
	input.new:focus{
		visibility: visible;
	}

</style>





<!-- Scripts -->
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
<script src="ace/assets/js/jquery-2.1.4.min.js"></script>
<script>

	$(document).ready(function() {
		$("#submit").attr("disabled", "disabled");

		$("input[type=password]").keyup(function() {
			if ($("input[type=submit]").is( ":disabled" ) )
				$("input[type=submit]").removeAttr("disabled");
		});
		$(".new").click(function() {
			$(".tooltiptext").css("visibility", "visible");
		});
		$(".new").focusout(function() {
			$(".tooltiptext").css("visibility", "hidden");
		});
		$("#submit").click(function () {
				var email = $('#email').val();
			var temppass = $('#temppass').val();
				var pass = $('#newpass').val();
				var conpass = $('#confirmpass').val();

				//$('body').addClass('loading');
				$.ajax({
					type: "POST",
					url: "ajax/expiredPassword.php", //Relative or absolute path to response.php file
					data: {'email':email, temppass:temppass, password:pass, conpassword:conpass},
					success: function (msg) {
						//alert(msg);


						if (msg == 'db updated') {
							//$('.message').css('display','inline');
							$('#errors').html('<br><span >Password changed</span>'+msg);

						}
						else {
							var errors=null;
							var arr = JSON.parse(msg);
							//alert(arr);

							$('#errors').html('<br><span >' + arr + '</span>');

						}
					},
					error: function (msg) {
						alert(msg);
						var errors=null;
						var arr = JSON.parse(msg);
						//alert(arr);

						$('#errors').html('<br><span >' + arr + '</span>'+msg);
					}
				});
				return false;
			});

	});
</script>
</html>