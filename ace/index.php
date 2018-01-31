<?php
session_start();
//var_dump($_SESSION);
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == 'true' && $_SESSION['firsttime']=='true')
	$page = 'newuser';
else if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == 'true' && $_SESSION['firsttime']='false')
	$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
else
	header(('location:../index.php'));
$page_title[]= array();
$page_title = ['newuser'=>'First Time Login','profile' => 'User Profile & Settings','dashboard'=>'Dashboard', 'transactions' => 'Transactions', 'servicemsg' => 'Service Messages', 'accountstatement' => 'Account Statement', 'loanstatement' => 'Loan Statement', 'cashout' => 'Cash Out', 'shareout' => 'Share Out', 'savingsgroup' => 'Savings Group', 'servicedesc' =>'Service Description', 'settings' => 'Settings', 'logs' =>'Log Report']

?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once('layout/header.html'); ?>
	<?php include_once('layout/sidenav.php'); ?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="breadcrumbs ace-save-state" id="breadcrumbs" style="display:none">


					<div class="nav-search" id="nav-search">

						</div><!-- /.nav-search -->
					</div>


						<div class="page-header" style="margin:1px 0px 1px 0px">
							<div style="display: none" id="section"><?php echo $page; ?></div>
							<h1 >

								<?php echo $page_title[$page]; ?>

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

									<?php

										if (isset($page))
											include "app/".$page.".php";
										else
											include "app/dashboard.php";

									?>


								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php include "layout/footer.html"; ?>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
	<!--</div> /.main-container -->

		<!-- inline scripts related to this page -->
	<style>
		@keyframes fadein {
			from {
				opacity: 0;
			}
			to {
				opacity: 1;
			}
		}

		@keyframes fadeinbg {
			from {
				background-image: none;
			}
			to {
				background:url('body.png') no-repeat;
			}
		}

		.main-content {
			animation: fadein 2s;
		}

		body {
			animation: fadeinbg 2s;
	</style>

		<script>
			<?php include "app/js/".$page.".js"; ?>
		</script>
	</body>
</html>
