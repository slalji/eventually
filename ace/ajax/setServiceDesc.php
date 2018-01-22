<?php 
require_once '../includes/db.php'; // The mysql database connection script
//if insert key is pressed then do insertion

if(isset($_POST['row-id'])){

	$id  =($_POST['row-id']);
	$service =($_POST['service']);

	$en_desc =($_POST['service_en']);
	$sw_desc =($_POST['service_sw']);


	$query   = "update service_desc set service='$service', service_en='$en_desc',service_sw='$sw_desc' where id = '" .$id."'";
	$result = $mysqli->query($query); //or die($mysqli->error.__LINE__);

	if ($result)
		echo true;
	else {
		header('HTTP/1.0 500 Internal Server Error');
		// Return error message
		die($mysqli->error.__LINE__);
	}
	//else
		//echo false.$mysqli->error.__LINE__;

}
/*else
	echo "Error, not pressed saved button";
*/
?>