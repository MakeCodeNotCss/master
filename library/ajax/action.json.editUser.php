<?php require_once("_ajax_boot.php");
		require_once("_ajax_no_login.php");

// Ajax handler for action USER UPDATE

	$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_user_id 		= (int)$_POST['user_id'];
	
	$_name 				= strip_tags(trim(str_replace("'","\'",$_POST['name'])));
	$_email 			= $_POST['email'];
	$_position_id 		= (int)$_POST['position_id'];
	$_position_name 	= strip_tags(trim(str_replace("'","\'",$_POST['position_name'])));
	$_parent_id			= (int)$_POST['parent_id'];
	
	$can_edit = false;
	
	if($_user_id)
	{
		$userData = $usersObj->findUsetById($_user_id);
		
		if($userData) $can_edit = true;
	}

	// VALIDATE POST DATA
	
	if($can_edit)
	{
		if(filter_var($_email,FILTER_VALIDATE_EMAIL))
		{
			if(strlen($_name) >= 2)
			{
				if($_position_id || strlen($_position_name) >= 2)
				{
					if(!$_position_id)
					{
						$_position_id = $usersObj->createNewUserPosition($_position_name);
					}
					
					$user_update = $usersObj->updateUserData($_user_id,$_name,$_email,$_parent_id,$_position_id);
					
					if($user_update)
					{
						$data['status'] = 'success';
						
						$data['message'] = "User data updated successfully";
					
					}else{
							$data['message'] = "MySQL error.";
						}
				}else{
						$data['message'] = "Please select user position.";
					}
			}else{
					$data['message'] = "Please enter correct Name (minimum 2 symbols).";
				}
		}else{
				$data['message'] = "Please enter correct Email.";
			}
	}else{
			$data['message'] = "Wrong user ID!";
		}


$db->db_destroy();

echo json_encode($data);