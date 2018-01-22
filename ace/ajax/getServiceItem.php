<?php 
require_once '../includes/db.php'; // The mysql database connection script
$section ='';
if (isset($_GET['section']))
	$section = $_GET['section'];
if (isset ($_GET['id']))
	$myid = $mysqli->real_escape_string($_GET['id']);
if ($section == 'servicedesc' && isset($myid))
	$query = "SELECT * from service_desc where id = '" . $myid ."' ";
else if ($section == 'servicemsg' && isset($myid))
	$query="SELECT id, service, description, errorcode,recipient,en_msg, sw_msg from service_message where id = '" . $myid."'";
else if ($section == 'settings' && isset($myid))
	$query="SELECT * from settings where id = '" . $myid."'";
//echo $query;
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>