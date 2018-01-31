<!--<div class="page-header">

</div> /.page-header -->
<?php
//var_dump($_SESSION);
include("../config.php");
include("../class/user.php");
$usr = new Users();
$expiry_date = $usr->getExpiryDate($_SESSION['token']);
$email = $usr->getEmail($_SESSION['token']);
$fullname = $usr->getFullname($_SESSION['token']);
$lastlogin = $usr->getLastlogin($_SESSION['token']);
//$fullname = $_SESSION['fullname'];

	$_SESSION['fullname']=$fullname;

?>

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->


		<div>
			<div id="user-profile-1" class="user-profile row">
				<div class="col-xs-12 center">

						<div class="col-xs-12 col-sm-9">
							<div class="profile-user-info profile-user-info-striped">
								<div class="alert alert-info message">Personal Profile
									<h1 ><i class="fa fa-user"></i> <span class="fullname"><?php echo $fullname ?></span></h1>
									 <form id="name-form"><?php
									echo '<input type="text" name=fullname id=fullname value="'. $fullname. '">
										 <input type="hidden" id="email2" name="email2" value="'. $email.'">';?>
										<input type="submit" value="Update" name="update" id="update" class="btn btn-info"></i>
									</form>
								</div>
							</div>
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"><i class="fa fa-calendar "></i> Last Login </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><?php echo $lastlogin?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"><i class="fa fa-calendar green"></i> Joined </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><?php echo $_SESSION['joined']?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"><i class="fa fa-send "></i> Email </div>

									<div class="profile-info-value">
										<span class="editable" id="username"><?php echo $email;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> <i class="fa fa-calendar orange2"></i> Expiry </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><span id="expiry"><?php echo $_SESSION['interval']?> </span>Days, Date: <span class="badge badge-warning" id="expiry_date"><?php echo $expiry_date;?></span></span>
									</div>
								</div>
							</div>

							<div class="profile-user-info profile-user-info-striped">

								<div class="widget-box widget-color-orange " id="messages">
									<div class="widget-header widget-header-small">
										<h5 xclass="widget-title smaller orange">Messages</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<span class="expire"> Your password has expired! Please change it today</span>
											<span class="success"></span><span class="error"></span>
										</div>
									</div>
								</div>
							</div>
							<div>
								<div class="profile-user-info profile-user-info-striped">
									<div class="alert alert-success">Change Password Form</div>
									<div>

						<form id="theForm" method="post" >
							<div class="profile-user-info profile-user-info-striped">

								<div class="profile-info-row">
									<div class="profile-info-name"> Current Password </div>


									<div class="profile-info-value">
										<input type="hidden" name="email" id="email" value="<?php echo $email?>"></span>
										<span class="editable" ><input type="password" name="temppass" id="temppass">

									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> New Password </div>

									<div class="profile-info-value">
										<span class="editable"><input type="password" name="newpass" id="newpass"></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Confirm Password </div>

									<div class="profile-info-value">
										<span class="editable"><input type="password" name="confirmpass" id="confirmpass"></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="confirm"> </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><input type="submit" name="submit" id="submit" class="btn btn-info">
										</span>
									</div>
								</div>
							</div>
					</div></form>
								</div>
							</div>

					<div class="space-6"></div>


				</div>

			</div>
		</div>


		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->

	<script>

		$(document).ready(function() {
			//$('#messages').hide();
			var expiry = $('#expiry_date').html();
			var d = new Date();
			var curr_date = d.getDate();
			var curr_month = d.getMonth() + 1;
			if (curr_month < '10')
				var new_month = '0' + curr_month;
			var curr_year = d.getFullYear();
			var today = curr_year + '-' + new_month + '-' + curr_date;

			if (expiry == today)
				 $('.expire').show();
			else
				 $('.expire').hide();
			$('input').focus(function () {
				//$('.success').hide();
				//$('.errors').hide();
			});

				$("#submit").click(function () {
					//$('.success').hide();
					//$('.errors').hide();

					var email = $('#email').val();
					var temp = $('#temppass').val();
					var pass = $('#newpass').val();
					var conpass = $('#confirmpass').val();


					//$('body').addClass('loading');
					$.ajax({
						type: "POST",
						url: "../ajax/updatePassword.php", //Relative or absolute path to response.php file
						data: {'email':email, temppass:temp, newpass:pass, confirmpass:conpass},
						success: function (msg) {
							alert(msg);

							if (msg == 'db updated') {
								$('.error').hide();
								$('.success').show();
								$('.success').html('<br><span class="badge badge-success">Password changed</span>');
								$('#temppass').val('');$('#newpass').val('');$('#confirmpass').val('');
							}
							else {
								$('.error').show();
								$('.error').html('<br><span class="badge badge-danger">' + msg + '</span>');
								alert('error '+JSON.stringify(msg));
							}
						},
						error: function (msg) {
							alert('error'.JSON.stringify(msg));
						}
					});
					return false;
				});
			$("#update").click(function () {

				$('.success').hide();
				$('.errors').hide();
				var fullname = $('#fullname').val();
				var email2 = $('#email2').val();


				//$('body').addClass('loading');
				$.ajax({
					type: "POST",
					url: "../ajax/updateFullname.php", //Relative or absolute path to response.php file
					data: {'fullname':fullname, email:email2},
					success: function (msg) {
						//alert(msg);

						if (msg !='0') {
							$('.error').hide();
							$('.success').show();
							$('.success').html('<br><span class="badge badge-success">Full name changed</span>');
							$('#fullname').val(fullname);
							$('.fullname').html(fullname);

						}
						else {
							$('.error').show();
							$('.error').html('<br><span class="badge badge-danger">Error: Name was not updated!</span>');
							//alert('error '+JSON.stringify(msg));
						}
					},
					error: function (msg) {
						alert('error'.JSON.stringify(msg));
					}
				});
				return false;
			});
			});
	</script>

