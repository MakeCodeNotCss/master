<?php 
	require_once("_ajax_boot.php");
	
	//require_once("_ajax_no_login.php");

	$db->db_access();

	// Ajax handler for action ADD NEW USER

	$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_email 			= $_POST['email'];
	$_pass  			= $_POST['password'];
	$_pass_con 			= $_POST['passwordConfirm'];
	$_firstName 		= $_POST['firstName'];
	$_lastName 			= $_POST['lastName'];
	$date        	 	= date("Y-m-d H:i:s",time());

	//$_parent_id		= (int)$_POST['parent_id'];

	// VALIDATE POST DATA
	
	if(filter_var($_email,FILTER_VALIDATE_EMAIL))
	{
		 $query = "SELECT login 
		 			FROM [pre]users 
		 			WHERE `login`='$_email'
		 			";
		 $existingMail = $db->exec_query($query);

		if(!$existingMail)
			{
				if(strlen($_pass) >=5)
				{
					if($_pass_con == $_pass)
					{
						if(strlen($_firstName) >=2 && strlen($_lastName) >=2)
						{
							$hash_pass = md5(base64_encode($secret_key.$_pass));
							$query = "INSERT INTO [pre]users (login, pass, name, fname, dateCreate, dateModify) 
										VALUES ('$_email', '$hash_pass', '$_firstName', '$_lastName', '$date', '$date')";
							$userData = $db->exec_query($query,0,1);
							if($userData)
							{
									$data['message'] = "Вы успешно зарегистрированы";
									$data['status'] = 'success';


									$hash_password = md5(base64_encode($secret_key.$_pass));


									$query = "SELECT * 
												FROM [pre]users 
												WHERE `login`='$_email' 
												AND `pass`='$hash_password'
												LIMIT 1";
									$userData = $db->exec_query($query,1);


									$session_old_uid = $_SESSION['account_id'];
				    
								    $_SESSION['account_id'] = $userData['id'];


								    define("ONLINE",TRUE);


								    $query = "UPDATE [pre]shop_cart 
								    			SET `uid`='$uid' 
								    			WHERE `uid`='$session_old_uid'";
								    $userData = $db->exec_query($query);

							}
							
						}else{
								$data['message'] = "Введите корректное имя (минимум 2 символа)";
						}
					}else{
							$data['message'] = "Подтверждение пароля не соответсвует (убедитесь что вы не допустили ошибки)";
					}
				}else{
						$data['message'] = "Ваш пароль сликом короткий (минимум 5 символов)";
				}
			}else{
					$data['message'] = "Ползователь с таким email уже зарегистрирован";
			}
		}else{
				$data['message'] = "Введите действующий email адресс";
			}


$db->db_destroy();

echo json_encode($data);