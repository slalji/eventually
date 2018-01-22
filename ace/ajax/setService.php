<?php 
require_once '../includes/db.php'; // The mysql database connection script
//if insert key is pressed then do insertion

if(isset($_POST['row-id'])){

	$id  =($_POST['row-id']);
	$service =($_POST['service']);
	$description =($_POST['description']);
	$errorcode =($_POST['errorcode']);
	$recipient =($_POST['recipient']);
	$en_msg =($_POST['en_msg']);
	$sw_msg =($_POST['sw_msg']);


	$query   = "update service_message set description = '$description', service='$service', errorcode='$errorcode',recipient='$recipient',en_msg='$en_msg',sw_msg='$sw_msg' where id = '" .$id."'";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($result)
		echo true;
	else
		echo $mysqli->error.__LINE__;

}
else
	echo "Error, not pressed saved button";
?>