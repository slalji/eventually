<?php
require_once '../includes/db.php'; // The mysql database connection script

function fundsAvailable($groupid){
$querys = "SELECT SUM(totalsavings) FROM cbsg_account WHERE statuscode!='D' AND groupid='$groupid'";
$savings = mysql_fetch_row(mysql_query($querys));

$queryl = "SELECT SUM(principal_due), SUM(charge_due) FROM cbsg_loan WHERE status='DUE' AND groupid='$groupid'";
$loan = mysql_fetch_row(mysql_query($queryl));

$queryg = "SELECT interest_collected FROM savings_group WHERE id='$groupid'";
$revenue_collection = mysql_fetch_row(mysql_query($queryg));

$funds_available = ($savings[0] + $revenue_collection[0]) - $loan[0];
return $funds_available;
}

function weekly_report_alert(){
//mysql_query("UPDATE cbsc_account SET status='D' WHERE msisdn like '%_DEL'");
//mysql_query("UPDATE cbsc_customer SET status='D' WHERE msisdn like '%_DEL'");

$query = "SELECT groupid,DATEDIFF(NOW(),fulltimestamp), loan_service_charge FROM savings_group WHERE initiated=1";
$result = mysql_query($query);
    //$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$group_arr = array();
$total_days = 0;
$total_interest = 0;
$funds_available = 0;
while($row = mysql_fetch_array($result)){
    array_push($group_arr, $row[0]);
    $total_days += $row[1];
    $total_interest +=$row[2];
    $funds_available += fundsAvailable($row[0]);

}
$funds_available = 'TZS '. number_format($funds_available);

$groups = implode(',', $group_arr);
$total_groups = count($group_arr);
$average_group_avg = number_format($total_days/$total_groups,0);
$average_interest = 'TZS '.number_format($total_interest/$total_groups,2);

$query = "SELECT count(id), SUM(totalsavings) FROM cbsg_account WHERE statuscode!='D' AND groupid in ($groups) ";
//echo $query;
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$total_members = intval($row[0]);
$total_savings = 'TZS '. number_format($row[1],2);

$query = "SELECT count(id), SUM(principal), SUM(charge) FROM cbsg_loan  WHERE groupid in ($groups)"; //AND groupid in ($groups)
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$total_loan = doubleval($row[1] + $row[2]);
$loans_outstanding  = intval($row[0]);
$avg_loan_amount = 'TZS '. number_format(($total_loan/$loans_outstanding), 2);
$total_loan_balance = 'TZS '. number_format($total_loan, 2);


$query = "SELECT count(id), SUM(principal_due), SUM(charge_due) FROM cbsg_loan WHERE status='DUE' AND duedate<NOW() AND groupid in ($groups)"; //AND groupid in ($groups)
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$loans_past_due = $row[0];

$query = "SELECT count(id), SUM(amount) FROM transactions WHERE service='MEMCASHIN' and tstatuscode='200'"; //AND groupid in ($groups)
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$total_payins = 'TZS '. number_format($row[1]);
$total_no_payins = $row[0];

$query = "SELECT count(id), SUM(amount) FROM transactions WHERE service='MEM_LOANREPAY' and tstatuscode='200'"; //AND groupid in ($groups)
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$total_loanrepay = 'TZS '. number_format($row[1]);
$total_no_loanrepay = $row[0];

$query = "SELECT count(id) FROM cbsg_loan";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$total_loans_disbursed = $row[0];



$content = "<h1> Boresha Maisha</h1>
<h2> Weekly Statistics </h2>
<table border=1>
    <tr><td>Total groups </td><td>$total_groups </td>
    <tr><td>Average age of group in days </td><td>$average_group_avg </td></tr>
    <tr><td>Total members </td><td>$total_members </td></tr>
    <tr><td>Total pay-ins to date </td><td>$total_payins ($total_no_payins payins)</td></tr>
    <tr><td>Total loan repayments to date </td><td>$total_loanrepay ($total_no_loanrepay loan repayments)</td></tr>
    <tr><td>Total funds available </td><td>$funds_available </td></tr>
    <tr><td>Total loan balance outstanding </td><td>$total_loan_balance  </td></tr>
    <tr><td>Average loan amount </td><td>$avg_loan_amount </td></tr>
    <tr><td>Total number of loans disbursed</td><td> $total_loans_disbursed </td></tr>
    <tr><td>Number of loans outstanding </td><td>$loans_outstanding </td></tr>
    <tr><td>Number of loans past due </td><td>$loans_past_due </td></tr>
    <tr><td>Average group interest rate (per two weeks)</td><td> $average_interest</td></tr></table>";

return $content;


}