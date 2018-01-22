<?php 
require_once '../includes/db.php'; // The mysql database connection script
$section ='';
if (isset($_GET['section']))
	$section = $_GET['section'];
if ($section == 'servicedesc')
	$query = "SELECT Distinct service from service_desc order by service";
else if ($section == 'settings')
	$query = "SELECT Distinct setting from settings order by setting";
else
	$query="SELECT Distinct service from service_message order by service ";


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