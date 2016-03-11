<?php require_once("_ajax_boot.php");

	// Database connection
	
	$db->db_access();

	// Check Login

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');

	// GET POST DATA
	
	$_userId		    = ACCOUNT_ID;
	$user_name 			= $_POST['name'];
	$user_lastName 		= $_POST['fname'];
	$user_phone         = $_POST['phone'];
	$user_email			= $_POST['email'];
	$user_delivery      = $_POST['delivery'];

	// VALIDATE POST DATA

	


		if(strlen($user_name) >= 2)
		{
			if(strlen($user_lastName) >= 3)
			{
				if(is_numeric($user_phone))
				{
					if(strlen($user_phone) >= 10)
					{
							$query = "UPDATE [pre]users SET `name`='$user_name', `fname`='$user_lastName', `phone`='$user_phone', `delivery_address`='$user_delivery'
										WHERE `id`=$_userId
										AND `type`=9
										LIMIT 1
										";
							//echo "<pre>"; print_r($query); echo "</pre>"; exit();
							$update_success = $db->exec_query($query,0,1);

							//echo "<pre>"; print_r($update_success); echo "</pre>"; exit();

							if($update_success)
							{
								$data['status'] = 'success';
								$data['message'] = "Ваши данные сохранены";
							}else{
								$data['message'] = "SQL Error";
							}
					}else{
							$data['message'] = "Введите корректный номер телефона без кода страны";
						}
				}else{
						$data['message'] = "Ваш номер не должен содержать букв";
					}
			}else{
					$data['message'] = "Ваша фамилия слишком короткая (мин. 3 символа)";
				}
		}else{
				$data['message'] = "Ваше имя слишком короткое (мин. 2 символа)";
			}



$db->db_destroy();

echo json_encode($data);