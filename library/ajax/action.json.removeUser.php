<?php require_once("_ajax_boot.php");
		require_once("_ajax_no_login.php");

// Ajax handler for action USER DELETE

$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_user_id = (int)$_POST['user_id'];
	
	// VALIDATE POST DATA
	
	if($_user_id)
	{
		$delete_status = $usersObj->deleteUser($_user_id);
		
		if($delete_status)
		{
			$data['status'] = 'success';
			$data['message'] = "User has been deleted successfully.";
		}else{
			$data['message'] = "MySQL error.";
			}
		
	}else{
			$data['message'] = "Please select user.";
		}


$db->db_destroy();

echo json_encode($data);