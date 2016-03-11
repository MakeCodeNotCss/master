<?php 
	require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

	// Login check

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');

	// CLIENT INFO POST
	$client_id        	= ACCOUNT_ID;
	$client_name      	= $_POST['quickOrderName'];
	$client_phone  		= $_POST['quickOrderPhone'];
	$prod_id			= $_POST['quickProdId'];
	$prod_quant         = $_POST['quickOrderQty'];
	$date    			= date("Y-m-d H:i:s",time());



	if(strlen($client_name) >=2)
	{
		if(strlen($client_phone) >=7)
		{
			$query = "INSERT INTO [pre]shop_quick_orders (user_id, user_name, user_phone, prod_id, 	prod_quant, dateCreate, status)
						VALUES ('$client_id', '$client_name', '$client_phone', '$prod_id', '$prod_quant', '$date', 1)
						";
						$insert_success = $db->exec_query($query,0,1);

						$data['message']='<center><h4>Ваш заказ отправлен.<br> Наш менеджер свяжется с Вами в ближайшее время.</h4></center>';
						$data['status']='success';
						$data['empty']='';
		}else{
			$data['message']='Введите корректный номер телефона';
		}

	}else{
		$data['message']='Введите Ваше имя (мин. 2 символа)';
	}
	

	




	$db->db_destroy();

	echo json_encode($data);

	