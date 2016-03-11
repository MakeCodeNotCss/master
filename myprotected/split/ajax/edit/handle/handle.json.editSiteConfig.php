<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$cardUpd = array(
					'sitename'			=> $_POST['sitename'],
					'support_email'		=> $_POST['support_email'],
					'phone_number'		=> $_POST['phone_number'],
					'active'			=> $_POST['active'][0],
					'index'				=> $_POST['index'][0],
					'meta_title'		=> $_POST['meta_title'],
					'meta_keys'			=> $_POST['meta_keys'],
					'meta_desc'			=> $_POST['meta_desc'],
					'bussiness_hours'	=> $_POST['bussiness_hours'],
					'company_address'	=> $_POST['company_address'],
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
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
		
	$data['query'] = $query;
		
	$ah->rs($query);
	
	
	
	$data['message'] = "Настройки успешно вступили в силу";
	