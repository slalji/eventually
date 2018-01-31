<!--<div class="page-header">

</div> /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->


		<div>
			<div id="user-profile-1" class="user-profile row">
				<div class="col-xs-12 col-sm-3 center">
					<div>

						<div class="well well-lg">
							<div class="inline position-relative">
								<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
									<i class="ace-icon fa fa-user"></i>
									&nbsp;
									<span ><?php
										include_once "../config.php";
										include_once "../class/user.php";

										$usr = new Users();
										$usr->setEmail($_SESSION['email']);
										$data = $usr->getUser($_SESSION['email']);

										echo 'Fullname '.$_SESSION['fullname'];
										?></span>
								</a>



							</div>
						</div>
						<div class="col-xs-12 col-sm-9">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><?php echo $_SESSION['joined']?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Email </div>

									<div class="profile-info-value">
										<span class="editable" id="username"><?php echo $_SESSION['email']?></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="space-6"></div>


				</div>


				<div class="col-xs-11 col-sm-9">

					<div class="alert alert-danger profile-user-danger"> Change Password
				</div>
				<div class="col-xs-12 col-sm-9">


					<div class="profile-user-info profile-user-info-striped">
					<form id="theForm">

						<div class="profile-info-row">
							<div class="profile-info-name"> Temporary Password </div>

							<div class="profile-info-value">
								<span><input type="password" name="current" id="current"></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> New Password </div>

							<div class="profile-info-value">
								<span ><input type="password" name="newpass" id="newpass"></span>
							</div>
						</div>
						<div class="profile-info-row">
							<div class="profile-info-name"> Confirm New Password </div>

							<div class="profile-info-value">
								<span ><input type="password" name="newpassconfirm" id="newpassconfirm"></span>
								<input type="text" name="email" id="email" value="<?php echo $_SESSION['email']?>">
							</div>
						</div>
						<div class="profile-info-row">

							<div class="profile-info-name"> <submit type="button" class="btn btn-info">Change</submit> </div>

							<div class="profile-info-value">
								<span > </span>
							</div>
						</div>
					</form>
					</div>
				</div


				</div>
			</div>
		</div>


		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
<script>
	$("document").ready(function() {
		$("#submit").click(function () {
			//$('body').addClass('loading');
			$.ajax({
				type: "POST",
				url: "../updatepassword.php", //Relative or absolute path to response.php file
				data: $("#myform").serialize(),
				success: function (msg) {
					//$('body').removeClass('loading');
					//alert($("#sessionorder").val());
					//window.location.replace("fuelit.php?orderid=" + $("#sessionorder").val());
					//window.print();
				}
			});
			return false;
		});
	});
</script>