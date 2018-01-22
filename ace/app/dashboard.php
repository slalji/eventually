<!-- first panel-->
<div class="col-lg-6 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Group Info Stats</label>
            <div class="row">
                <!-- first panel-->
                <div class="row" style="padding: 5px">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php include "class/dashboard.php";
                                            $d = new dashboard(); echo "".$d->totalGroups();?></div>
                                        <div>Total Groups</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar-o fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">158</div>
                                        <div>~ Age of group in <b class="badge">days</b></div>

                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-secret fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo "".$d->totalMembers();?></div>
                                        <div>Total members</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">5154</div>
                                        <div>Pay-ins<span class="badge">TZS 83,696,621</span></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $d->totalLoanRepayments();?></div>
                                        <div>Loan repayments<span class="badge">TZS <?php  $arr= $d->loanRepayment(); echo number_format($arr['p']-$arr['c']) ;?></span></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Total funds available <span class="badge">TZS 5,033,123</span></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- first panel-->
<!-- second panel-->
<div class="col-lg-6 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <label label-info>Loan Stats</label>
            <div class="row" style="padding: 5px">
                <!-- second panel-->
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Total loan balance outstanding	<span class="badge>">TZS 13,894,634</span> </div>

                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-lock fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Average loan amount at issuance <span class="badge">TZS 124,068.97</span> </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-paper-plane-o fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">454</div>
                                        <div>Total number of loans disbursed</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
               </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-times-circle-o fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">174</div>
                                        <div>Number of loans outstanding</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar-plus-o fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $d->noPastDueLoans();?></div>
                                        <div>Number of loans past due</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-percent fa-2x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">TZS
                                        <div class="huge">3.41</div>
                                        <div>Average group interest rate <span class="badge">per 2 weeks</span></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- second panel-->




<div class="hr hr32 hr-dotted"></div>

<div class="row">
    <div class="col-sm-5">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-star orange"></i>
                    Popular Domains
                </h4>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-bordered table-striped">
                        <thead class="thin-border-bottom">
                        <tr>
                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>name
                            </th>

                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>price
                            </th>

                            <th class="hidden-480">
                                <i class="ace-icon fa fa-caret-right blue"></i>status
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>internet.com</td>

                            <td>
                                <small>
                                    <s class="red">$29.99</s>
                                </small>
                                <b class="green">$19.99</b>
                            </td>

                            <td class="hidden-480">
                                <span class="label label-info arrowed-right arrowed-in">on sale</span>
                            </td>
                        </tr>

                        <tr>
                            <td>online.com</td>

                            <td>
                                <b class="blue">$16.45</b>
                            </td>

                            <td class="hidden-480">
                                <span class="label label-success arrowed-in arrowed-in-right">approved</span>
                            </td>
                        </tr>

                        <tr>
                            <td>newnet.com</td>

                            <td>
                                <b class="blue">$15.00</b>
                            </td>

                            <td class="hidden-480">
                                <span class="label label-danger arrowed">pending</span>
                            </td>
                        </tr>

                        <tr>
                            <td>web.com</td>

                            <td>
                                <small>
                                    <s class="red">$24.99</s>
                                </small>
                                <b class="green">$19.95</b>
                            </td>

                            <td class="hidden-480">
																	<span class="label arrowed">
																		<s>out of stock</s>
																	</span>
                            </td>
                        </tr>

                        <tr>
                            <td>domain.com</td>

                            <td>
                                <b class="blue">$12.00</b>
                            </td>

                            <td class="hidden-480">
                                <span class="label label-warning arrowed arrowed-right">SOLD</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->

    <div class="col-sm-7">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-signal"></i>
                    Sale Stats
                </h4>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <div id="sales-charts"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<style>
    .badge{
        font-size: 11px;
        font-weight: normal;
    }
</style>
								