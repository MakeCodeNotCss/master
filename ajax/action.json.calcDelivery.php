<?php require_once("_ajax_boot.php");

	// Database connection
	
	$db->db_access();

	// Check Login

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error', 'delivery_res' => 0, 'total_res' => 0);

	// GET POST DATA
	
	$_userId			= ACCOUNT_ID;
	$delivery_method    = $_POST['delivery_method'];
	$order_summ         = $_POST['order_Sum'];



	$query = "SELECT *
				FROM [pre]shop_delivery_methods
				WHERE `id`=$delivery_method
				LIMIT 1
			";

	$delivery = $db->exec_query($query,1);

	if($delivery)
	{
		$data['message'] ='OK';
		$data['status'] = 'success';

		$delivery_cost = $delivery['price'];

		if($delivery_cost==0)
		{
			$data['delivery_res'] = 'Бесплатно';
			$data['total_res'] = $order_summ ;
		}else{
			$data['delivery_res'] = $delivery_cost.' UAH';
			$data['total_res'] = $order_summ + $delivery_cost;
		}

	}else{
		$data['message'] = "SQL Error";
	}	





		



$db->db_destroy();

echo json_encode($data);