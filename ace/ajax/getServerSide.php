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
$cols = explode(',',$_REQUEST['columns']);
$columns = array();
$section = $_REQUEST['section'];
$where = '';
$orderby='';

foreach($cols as $col){
	$columns[]=$col;
}
/*$columns = array(
// datatable column index  => database column name
	0 =>'first_name',
	1 =>'last_name',
	2 => 'email',
	3 =>'gender',
	4=> 'ip_address'

);
*/
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
	$sql="SELECT id, fulltimestamp, min_payin, max_payin, meeting_open_status, last_meeting_close_time, max_loan_duration, cycle_counter, meetings_remaining,  meetings_remaining_seton, savings_total, savings_since_last_meeting, loan_outstanding_total, interest_collected, name  from savings_group ";
if ($section == 'servicemsg' )
	$sql="SELECT id, service, description, errorcode,recipient,en_msg, sw_msg from service_message ";
if ($section == 'servicedesc' )
	$sql="SELECT * from service_desc ";
if ($section == 'settings' )
	$sql="SELECT  id, setting, sgroup, value, tstatus, creator, modifier, authorizer, astatus, rtimestamp, uid from settings ";

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
	$sql="SELECT id, fulltimestamp, min_payin, max_payin, meeting_open_status, last_meeting_close_time, max_loan_duration, cycle_counter,
meetings_remaining,  meetings_remaining_seton, savings_total, savings_since_last_meeting, loan_outstanding_total, interest_collected, name  from savings_group ";

}
if ($section == 'servicemsg' ){
	$where = ' 1 ';
	$sql="SELECT id, service, description, errorcode,recipient,en_msg, sw_msg from service_message ";
}
if ($section == 'servicedesc' ){
	$where = ' 1 ';
	$sql="SELECT  id, service, service_en, service_sw from service_desc ";
}
if ($section == 'settings' ){
	$where = ' 1 ';
	$sql="SELECT  id, setting, sgroup, value, tstatus, creator, modifier, authorizer, astatus, rtimestamp, uid from settings ";
}




//because field names are different in sql statement, you need to explode else search will not work
$exp=explode('SELECT',$sql);
$exp2 = explode('from', $exp[1]);
$q_cols = explode(',', $exp2[0]);
//print_r($q_cols);
$where = " where " . $where;
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$where.=" AND (".$q_cols[0]." LIKE '".$requestData['search']['value']."%' ";
	foreach($q_cols as $col)
		$where .= "OR ". $col . " LIKE '" . $requestData['search']['value']."%' ";
	//$where .= ' AND ' ;
	/*$sql.=" OR first_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR gender LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR ip_address LIKE '".$requestData['search']['value']."%' )";
	*/
	$where.="  )";
}

$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.= $where . " ORDER BY ". $q_cols[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
$rows = array();
$data = array();
while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
	$nestedData=array();
foreach($rows as $row)
	$nestedData[] = $row;
	/*$nestedData[] = $row["first_name"];
	$nestedData[] = $row["last_name"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["gender"];
	$nestedData[] = $row["ip_address"];*/

	$data[] = $nestedData;
}



$json_data = array(
"query" => $sql,
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
