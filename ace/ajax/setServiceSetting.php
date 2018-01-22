<?php 
require_once '../includes/db.php'; // The mysql database connection script
//if insert key is pressed then do insertion

if(isset($_POST['row-id'])){

	$id  =($_POST['row-id']);
	$setting =($_POST['setting']);

	$sgroup =($_POST['sgroup']);
	$setting_value =($_POST['setting_value']);


	$query   = "update settings set setting='$setting', sgroup='$sgroup',value='$setting_value' where id = '" .$id."'";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if ($result)
		echo true;
	//else
		//echo false.$mysqli->error.__LINE__;

}
/*else
	echo "Error, not pressed saved button";
*/
?>