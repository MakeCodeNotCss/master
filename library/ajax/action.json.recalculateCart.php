<?php require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

include_once("../_auth.php");

$data = array('status'=>'failed','message'=>'Error','prod_price'=>'');

$cart = $_POST['qty'];

 foreach($cart as $cart_id => $quant)
	{
		$curr_quant = (int)$quant;
		
		if($curr_quant > 100) $curr_quant = 100;
		$query = "UPDATE [pre]shop_cart SET `quant`=$curr_quant WHERE `id`=$cart_id AND `uid`=".ACCOUNT_ID." LIMIT 1";
		$cartData = $db->exec_query($query);
		
		$data['status'] = 'success';
		$data['message'] = 'Success';

	}
			


		
// Database connection
$db->db_destroy();

echo json_encode($data);
	