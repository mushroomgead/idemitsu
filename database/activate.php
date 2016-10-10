<?php
	require_once("../tools/tools-function.php");

	$code = $_GET['code'];
	$email = $_GET['email'];

	require_once('Encryption.php');
	$encryption = new Encryption($code,'de');
	$validationcode = $encryption->endecrypt();

	require_once("connect_db.php");

	$sql = "update t_team_header
			set status = 'Confirm'
				,last_update_date = sysdate()
				,last_update_by = 'Activate'
			where leader_email = '".$email."'
				and concat(team_name,institute_name,leader_email) = '".$validationcode."'";

	$query2=mysqli_query($con,$sql);

	redirect("../?menu=register&action=confirmed")

?>