<body class="no-skin">
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="index.html" class="navbar-brand">
                <small>
                    <!--<i class="fa fa-tree"></i>-->
                    <img src="../images/boresha.png" width="20">
                    Boresha Maisha
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

<!-- user info -->

                <li class="black dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle"  data-hover="dropdown">
                        <span><i class="fa fa-user-secret fa-5x"></i></span>
								<span class="user-info">
									<small>Welcome,</small>
                                    <?php
                                    isset($_SESSION['fullname']) ? $user= ucfirst($_SESSION['fullname']) : $user= 'Please Login';
                                    echo '<span class="fullname">'.$user . '</span> <i class="ace-icon fa fa-caret-down"></i>';
                                  ?>

								</span>

                        <!--<i class="ace-icon fa fa-arr"></i>-->
                    </a>
                    <ul class="dropdown-menu">
                    <!--<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">-->
                        <!--<li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>-->

                        <li>
                            <a href="<?php echo $_SERVER['PHP_SELF']?>?page=profile">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="../logout.php">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="../logout.php">
                        <i class="ace-icon fa fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<!--<button class="btn btn-success"><br> 
							<!--<i class="ace-icon fa fa-list"></i> 
						</button>

						<button class="btn btn-info"><br> 
							<!--
							<i class="ace-icon fa fa-list-alt"></i> 
						</button>

						<button class="btn btn-warning"><br> 
							<!--
							<i class="ace-icon fa fa-pencil-square-o"></i> 
						</button>

						<button class="btn btn-danger"><br> 
							<!--
							<i class="ace-icon fa fa-file"></i> 
						</button>-->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="<?php echo $_SERVER['PHP_SELF']?>?page=dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text">
								Transactions
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							

							<li class="">
								<a class="click-to-open" href="<?php echo $_SERVER['PHP_SELF']?>?page=transactions">
									<i class="menu-icon fa fa-caret-right"></i>
									Daily Transactions
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=accountstatement">
									<i class="menu-icon fa fa-caret-right"></i>
									Account Statement
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=loanstatement">
									<i class="menu-icon fa fa-caret-right"></i>
									Loan Statement
								</a>

								<b class="arrow"></b>
							</li>

						
						</ul>
					</li>

					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Reports </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=cashout">
									<i class="menu-icon fa fa-caret-right"></i>
									Cash Out
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=shareout">
									<i class="menu-icon fa fa-caret-right"></i>
									Share Out
								</a>

								<b class="arrow"></b>
                            </li>
                            <li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=savingsgroup">
									<i class="menu-icon fa fa-caret-right"></i>
									Savings Group
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Maintenance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=servicemsg">
									<i class="menu-icon fa fa-caret-right"></i>
									Service Messages
								</a>

								<b class="arrow"></b>
                            </li>
                            <li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=servicedesc">
									<i class="menu-icon fa fa-caret-right"></i>
									Service Description
								</a>

								<b class="arrow"></b>
                            </li>
                            <li class="">
								<a href="<?php echo $_SERVER['PHP_SELF']?>?page=settings">
									<i class="menu-icon fa fa-caret-right"></i>
									Service Messages
								</a>

								<b class="arrow"></b>
							</li>
							 
						</ul>
					</li>

					

					<li class="active open">
						<a href="<?php echo $_SERVER['PHP_SELF']?>?page=logs">
							<i class="menu-icon fa fa-file"></i>

							<span class="menu-text">
								Audit Trail

								<!--<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>-->
							</span>
						</a>

						<b class="arrow"></b>
					</li>

				
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
