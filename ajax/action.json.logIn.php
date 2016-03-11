<?php require_once("_ajax_boot.php");

include_once("../_auth.php");

	// Database connection
	
	$db->db_access();

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_login 	= $_POST['login'];
	$_password 	= $_POST['password'];

	// VALIDATE POST DATA


	 if(filter_var($_login,FILTER_VALIDATE_EMAIL))
	 {
		$hash_password = md5(base64_encode($secret_key.$_password));
		
		$query = "SELECT * FROM [pre]users WHERE `login`='$_login' AND `pass`='$hash_password' LIMIT 1";
		$userData = $db->exec_query($query,1);


		$md5_password = md5($_password);

		$query = "SELECT * FROM [pre]users WHERE `login`='$_login' AND `pass`='$md5_password' LIMIT 1";
		$userDataMd5 = $db->exec_query($query,1);
		
	  if($userData || $userDataMd5)
	  {
		 //==============================================================
		 // Момент авторизации
		   
		    $session_old_uid = $_SESSION['account_id'];
		    
		    $uid = ($userData ? $userData['id'] : $userDataMd5['id']);
		   
		    $_SESSION['account_id'] = $uid;
		    
		    $data['status'] = 'success';
		    
		    $data['message'] = "LogIn is successful";

		    $query = "UPDATE [pre]shop_cart 
		    			SET `uid`='$uid' 
		    			WHERE `uid`='$session_old_uid'";
		    $userData = $db->exec_query($query);

		 //==============================================================

		}else{
		    $data['message'] = "Login or password is wrong!";
		   }
		}else{
		    $data['message'] = "Please enter correct Email.";
		   }



$db->db_destroy();

echo json_encode($data);