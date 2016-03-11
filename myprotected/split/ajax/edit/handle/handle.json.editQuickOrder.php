<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (int)$_POST['item_id'];
	
	$cardUpd = array(
					'prod_id'		=> $_POST['prod_id'],
					'user_name'		=> $_POST['user_name'],
					'user_phone'	=> $_POST['user_phone'],
					'prod_quant'	=> (int)$_POST['prod_quant']
					);
						
	// Update main table
	
	$query = "UPDATE [pre]$appTable SET ";
	
	$cntUpd = 0;
	foreach($cardUpd as $field => $itemUpd)
	{
		$cntUpd++;
		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
	}
	
	$query .= " WHERE `id`=$item_id LIMIT 1";
			
	$ah->rs($query);
	
	//$data['query'] = $query;

	$data['message'] = "Заказ сохранен.";
	