<?php
require_once '../includes/db.php'; // The mysql database connection script
$filter = '';
$where = '';
$section ='';

if(isset($_GET['section'])){
	$section = $mysqli->real_escape_string($_GET['section']);
}

$query='';
if ($section == 'transactions')
	$query="SELECT t.id, t.fulltimestamp, t.msisdn, t.account, t.service,t.reference, t.amount, t.tstatus, t.lang, s.name from transactions t join savings_group s on s.groupid = t.groupid order by fulltimestamp desc";
else if ($section == 'accountstatement')
	$query="SELECT t.id, t.fulltimestamp, t.msisdn, t.transtype, t.transid,t.reference, t.service, t.amount, t.triggeredby, t.obal,t.cbal, s.name from ledger_savings t join savings_group s on s.groupid = t.groupid  order by t.fulltimestamp desc";
else if ($section == 'loanstatement')
	$query="SELECT t.id, t.fulltimestamp, t.msisdn, t.transtype, t.reference, t.service, t.principal, t.charge, t.pricipal_obal,t.principal_cbal, t.charge_obal,t.charge_cbal, s.name from ledger_loan t join savings_group s on s.groupid = t.groupid  order by t.fulltimestamp desc";
else if ($section == 'cashout')
	$query="SELECT t.id, t.fulltimestamp, t.msisdn, t.transid, t.serial, t.utilitytype, t.amount, t.status, t.message from cashout t  order by t.fulltimestamp desc";
else if ($section == 'shareout')
	$query="SELECT t.id, t.fulltimestamp, t.msisdn, t.userfee, t.total_shareout, t.totalsavings, t.income, t.avg_balance, t.sum_avg_balance, s.name from shareout t join savings_group s on s.groupid = t.groupid  where t.msisdn not like '%GLINCOME01%' order by t.fulltimestamp desc";
else if ($section == 'savingsgroup')
	$query="SELECT * from savings_group t order by fulltimestamp desc ";
else if ($section == 'logs')
	$query="SELECT t.id, t.date, s.name, t.reference, t.step, t.description  from tlog t join savings_group s on s.groupid = t.groupid  order by t.date desc";
else if ($section == 'servicemsg' )
	$query="SELECT id, service, description, errorcode,recipient,en_msg, sw_msg from service_message t order by id desc";
else if ($section == 'servicedesc' )
	$query="SELECT * from service_desc t order by id desc";
else if ($section == 'settings' )
	$query="SELECT * from settings t order by id desc";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
$columns = array();
if($result->num_rows > 0) {
	$rows = mysqli_fetch_assoc($result);
	$columns = array_keys($rows);
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;
	}

}
//var_dump($query);

//$jsonData['data']=$arr;

//$jsonData['columns']= $cols;
//$json =  json_encode($jsonData);//.$query;
//echo $json;
//$d_json = json_decode($json);

$my_results=array();
foreach($arr as $d){
	foreach ($d as $key => $value) {

		/*if ($key == 'msisdn') {

			$val = '+' . preg_replace('/\d{3}/', '$0 ', str_replace('.', null, trim($value)), 3);
			$d['msisdn'] = $val;

			//echo $value;
		}*/
		if ($key == 'tstatus' && $value == 'SUCCESS'){
			$d[$key]=fn_format_label_success($key, $value);
		}
		if ($key == 'status' && $value == 'SUCCESS'){
			$d[$key]=fn_format_label_success($key, $value);
		}

		if ($key == 'tstatus' && $value == 'FAILED'){
			$d[$key]=fn_format_label_danger($key, $value);
		}
		if ($key == 'status' && $value == 'FAILED'){
			$d[$key]=fn_format_label_danger($key, $value);
		}
		if ($key == 'transtype' && $value == 'DEBIT'){
			$d[$key]=fn_format_label_success($key, $value);
		}
		if ($key == 'transtype' && $value == 'CREDIT'){
			$d[$key]=fn_format_label_danger($key, $value);

		}
		if ($key == 'lang' && $value == 'SW'){
			$val='Swhaili';
			$d['lang'] = $val;
		}
		$phone = substr($value, 0, 3);
		if (is_numeric($value) && $key != 'msisdn' && $key != 'reference' && $key != 'id' && $key !='triggeredby')
			$d[$key]=fn_formatNums($key, $value);


	}

	$my_results[]=$d;
}
//$jsonData['data']=$arr;
$jsonData['data']=$my_results;
$jsonData['columns']=$columns;
$json = json_encode($jsonData);
echo $json;

function fn_formatNums($key,$value){
	$val=number_format($value);
	return $val;
}
function fn_format_label_danger($key, $value){
	$val='<span class="label label-danger arrowed arrowed-right arrowed-in">' .strtolower($value).'</span>';
	return $val;
}
function fn_format_label_success($key, $value){
	$val='<span class="label label-success arrowed-in arrowed-in-right">' .strtolower($value).'</span>';
	return $val;
}



//echo $query ."<p>";
# JSON-encode the response
//echo $json_response = json_encode($arr);//.$query;
?>
