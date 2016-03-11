<?php require_once("_ajax_boot.php");

	// Database connection
	
	$db->db_access();

	// Check Login

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error', 'rest' => 0);

	// GET POST DATA
	
	$_userId		= ACCOUNT_ID;
	$square 		= $_POST['square'];
	$query 		    = $_POST['countQuery'];


	// VALIDATE POST DATA

	if($query && $square)
	{
		
		$result = ceil($query / $square);
		$resultRest = round(($result*$square)-$query, 2);
		$data['status']='success';
		$data['message']=$result;
		$data['rest']=$resultRest;
		$data['selectedQty']=$result;
		
	}else{
		$data['selectedQty']=1;
		$data['message']=1;
	}

		



$db->db_destroy();

echo json_encode($data);