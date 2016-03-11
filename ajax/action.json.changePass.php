<?php require_once("_ajax_boot.php");

	// Database connection
	
	$db->db_access();

	// Check Login

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_userId		= ACCOUNT_ID;
	$_pass 			= $_POST['pass'];
	$_newPass 		= $_POST['newPass'];
	$_newPassConfirm= $_POST['newPassConfirm'];

	// VALIDATE POST DATA

		$hash_password = md5(base64_encode($secret_key.$_pass));
		//$hash_pass = md5($_pass);

		$hash_new_password = md5(base64_encode($secret_key.$_newPass));
		

	
	 if(ONLINE)
	 {

		if($hash_password == $userData['pass'])
		{
			if(strlen($_newPass) >= 5)
			{
				if($_newPass == $_newPassConfirm)
				{
						$query = "UPDATE [pre]users 
									SET 
									`pass`='$hash_new_password'
									WHERE `id`=".ACCOUNT_ID."
									LIMIT 1
									";
						$update_success = $db->exec_query($query,0,1);

						if($update_success)
						{
							$data['status'] = 'success';
							$data['message'] = "Новый пароль успешно сохранен";
						}else{
							$data['message'] = "SQL Error";
						}
				}else{
						$data['message'] = "Подтверждение не соответствует новому паролю";
					}
			}else{
					$data['message'] = "Ваш пароль слишком короткий (минимум 5 символов)";
				}
		}else{
				$data['message'] = "Вы ввели неверный пароль";
			}
	 }else{
	 		$data['message'] = "Ошибка авторизации";
	 	}


$db->db_destroy();

echo json_encode($data);