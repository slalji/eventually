<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_bridge";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
//var_dump($_REQUEST);
$cols = explode(',',$_REQUEST['cols']);
$columns = array();
$section = $_REQUEST['section'];
$where = '';
$orderby='';

foreach($cols as $col){
	$columns[]=$col;
}

// getting total number records without any search
$sql = "SELECT first_name, last_name, email, gender, ip_address ";
$sql.=" FROM serverside";
if ($section == 'logs')
	$sql="SELECT t.id, t.date, s.name, t.reference, t.step, t.description  from tlog t join savings_group s on s.groupid = t.groupid  ";
if ($section == 'transactions')
	$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.account, t.service,t.reference, t.amount, t.tstatus, t.lang, s.name from transactions t join savings_group s on s.groupid = t.groupid ";
if ($section == 'accountstatement')
	$sql="SELECT t.id,  t.msisdn, t.transtype, t.reference, t.service, t.amount, t.triggeredby, t.obal,t.cbal, s.name from ledger_savings t join savings_group s on s.groupid = t.groupid   ";
if ($section == 'loanstatement')
	$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.transtype, t.reference, t.service, t.principal, t.charge, t.pricipal_obal,t.principal_cbal, t.charge_obal,t.charge_cbal, s.name from ledger_loan t join savings_group s on s.groupid = t.groupid ";
if ($section == 'cashout')
	$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.transid, t.serial, t.utilitytype, t.amount, t.status, t.message from cashout t ";
if ($section == 'shareout') {
	$sql = "SELECT t.id, t.fulltimestamp, t.msisdn, t.userfee, t.total_shareout, t.totalsavings, t.income, t.avg_balance, t.sum_avg_balance, s.name from shareout t join savings_group s on s.groupid = t.groupid ";
	$where = "t.msisdn not like '%GLINCOME01%'";
}
if ($section == 'savingsgroup')
	$sql="SELECT ". $_REQUEST['cols'] ."   from savings_group ";
if ($section == 'servicemsg' )
	$sql="SELECT ". $_REQUEST['cols'] ."  from service_message ";
if ($section == 'servicedesc' )
	$sql="SELECT ". $_REQUEST['cols'] ."  from service_desc ";
if ($section == 'settings' )
	$sql="SELECT  ". $_REQUEST['cols'] ."  from settings ";

$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT first_name, last_name, email, gender, ip_address ";
$sql.=" FROM serverside";
if ($section == 'logs'){
	$where = ' 1 ';
	$sql="SELECT t.id, t.date, s.name, t.reference, t.step, t.description  from tlog t join savings_group s on s.groupid = t.groupid ";
}

if ($section == 'transactions'){
	$where = ' 1 ';
	$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.account, t.service,t.reference, t.amount, t.tstatus, t.lang, s.name from transactions t join savings_group s on s.groupid = t.groupid ";

}
	if ($section == 'accountstatement'){
		$where = ' 1 ';
		$sql="SELECT t.id, t.msisdn, t.transtype, t.reference, t.service, t.amount, t.triggeredby, t.obal,t.cbal, s.name from ledger_savings t join savings_group s on s.groupid = t.groupid   ";

	}
	if ($section == 'loanstatement'){
		$where = ' 1 ';
		$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.transtype, t.reference, t.service, t.principal, t.charge, t.pricipal_obal,t.principal_cbal, t.charge_obal,t.charge_cbal, s.name from ledger_loan t join savings_group s on s.groupid = t.groupid  ";

	}
	if ($section == 'cashout'){
		$where = ' 1 ';
		$sql="SELECT t.id, t.fulltimestamp, t.msisdn, t.transid, t.serial, t.utilitytype, t.amount, t.status, t.message from cashout t   ";

	}
	if ($section == 'shareout') {
	$sql = "SELECT t.id, t.fulltimestamp, t.msisdn, t.userfee, t.total_shareout, t.totalsavings, t.income, t.avg_balance, t.sum_avg_balance, s.name from shareout t join savings_group s on s.groupid = t.groupid ";
	$where = "t.msisdn not like '%GLINCOME01%'";
}
if ($section == 'savingsgroup'){
	$where = ' 1 ';
	$sql="SELECT ". $_REQUEST['cols'] ."  from savings_group ";

}
if ($section == 'servicemsg' ){
	$where = ' 1 ';
	$sql="SELECT ". $_REQUEST['cols'] ."  from service_message ";
}
if ($section == 'servicedesc' ){
	$where = ' 1 ';
	$sql="SELECT ". $_REQUEST['cols'] ." from service_desc ";
}
if ($section == 'settings' ){
	$where = ' 1 ';
	$sql="SELECT  ". $_REQUEST['cols'] ."  from settings ";
}




//because field names are different in sql statement, you need to explode else search will not work
$exp=explode('SELECT',$sql);
$exp2 = explode('from', $exp[1]);
$q_cols = explode(',', $exp2[0]);
//print_r($q_cols);
$where = " where " . $where;
if( !empty($requestData['data']) ){ 
	$range = explode('|', $requestData['data']); 
	 
    $start = trim($range[0]); //name
    $end = trim($range[1]); //name
    $where.=" AND t.fulltimestamp >= '".$start."' AND t.fulltimestamp <= ('" .$end. "' + INTERVAL 1 DAY) ";
}

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$where.=" AND (".$q_cols[0]." LIKE '".$requestData['search']['value']."%' ";
	foreach($q_cols as $col)
		$where .= "OR ". $col . " LIKE '" . $requestData['search']['value']."%' ";

}
 
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.= $where . " ORDER BY 1  ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
//print_r($sql);
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$finfo = mysqli_fetch_fields($result);//_fetch_assoc($result);

$headers = array();
foreach ($finfo as $val) {
    $headers[] = $val->name;
}

$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
	fputcsv($fp, $headers);
	 //print_r($sql);
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
	//print_r(mysqli_query($conn, $sql) );
	
	while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
		fputcsv($fp, $rows); 
		
	}
}

?>
