<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$cat_id = (int)$_POST['cat_id'];
	
	$model = trim(strip_tags($_POST['model']));
	
	$color_id = (int)$_POST['color_id'];
	
	$query = "SELECT * FROM [pre]shop_colors WHERE `id`=$color_id LIMIT 1";
	$color = $ah->rs($query);
	
	// color func
	
	if(!$color_id)
	{
		$color_name = trim(strip_tags($_POST['color_name']));
		$color_value = trim(strip_tags($_POST['color_value']));
		
		if($color_name && strlen($color_value)==7)
		{
			$query = "INSERT INTO [pre]shop_colors (`name`,`value`) VALUES ('$color_name','$color_value')";
			$ah->rs($query);
			
			$color_id = mysql_insert_id();
		}
	}
	
	$cardUpd = array(
					'name'			=> $_POST['name'],
					'alias'			=> $_POST['alias'],
					'block'			=> $_POST['block'][0],
					'index'			=> $_POST['index'][0],
					
					'model'			=> $model,
					'color_id'		=> $color_id,
					
					'mf_id'			=> (float)$_POST['mf_id'],
					'deliver_id'	=> (float)$_POST['deliver_id'],

					'price'			=> (float)$_POST['price'],
					'usd_price'			=> (float)$_POST['usd_price'],
					'sale_price'			=> (float)$_POST['sale_price'],
					
					'dop_text'		=> $_POST['dop_text'],
					
					'quant'			=> (int)$_POST['quant'],
					
					'width'			=> (float)$_POST['width'],
					'depth'			=> (float)$_POST['depth'],
					'height'		=> (float)$_POST['height'],
					'weight'		=> (float)$_POST['weight'],
					
					'in_stock'		=> $_POST['in_stock'],
					'sku'			=> $_POST['sku'],
					'code'			=> $_POST['code'],
					'details'		=> $_POST['details'],
					'title'			=> $_POST['title'],
					'keys'			=> $_POST['keys'],
					'desc'			=> $_POST['desc'],
					'date_start'	=> date("Y-m-d H:i:s", strtotime($_POST['date_start'])),
					'date_finish'	=> date("Y-m-d H:i:s", strtotime($_POST['date_finish'])),
					
					'adminMod'=>ADMIN_ID,
					
					'dateCreate'	=> date("Y-m-d H:i:s", time()),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
					
	if($cardUpd['in_stock'] > $cardUpd['quant']) $cardUpd['in_stock'] = $cardUpd['quant'];
					
	$query = "SELECT id FROM [pre]shop_products WHERE `alias`='".$cardUpd['alias']."' LIMIT 1";
	$test_alias = $ah->rs($query);
	
	$query = "SELECT id FROM [pre]shop_products WHERE `sku`='".$cardUpd['sku']."' LIMIT 1";
	$test_sku = $ah->rs($query);	
	
	if(strlen($cardUpd['name'])>1)
	{
		if(strlen($cardUpd['sku'])>1)
		{
			if(!$test_alias)
			{
				if(!$test_sku)
				{
					if($cat_id)
					{
				
				// Start of success saving
				
				// Create main table item
	
				$query = "INSERT INTO [pre]$appTable ";
	
				$fieldsStr = " ( ";
	
				$valuesStr = " ( ";
	
				$cntUpd = 0;
				foreach($cardUpd as $field => $itemUpd)
				{
					$cntUpd++;
		
					$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");
		
					$valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");
				}
	
				$fieldsStr .= " ) ";
				
				$valuesStr .= " ) ";
				
				$query .= $fieldsStr." VALUES ".$valuesStr;
					
				$data['block'] = $cardUpd['block'];
				
				$data['query'] = $query;
					
				$ah->rs($query);
				
				$item_id = mysql_insert_id();
				
				
				$data['item_id'] = $item_id;
				
				// Ref with assessuares
				
				$query = "UPDATE [pre]shop_prod_access_ref SET `prod_id`=$item_id WHERE `prod_id`=0 LIMIT 1000";
				$ah->rs($query);
				
				// Ref with category
				
				$query = "INSERT INTO [pre]shop_cat_prod_ref (`cat_id`,`prod_id`) VALUES ('$cat_id','$item_id')";
				
				$ah->rs($query);
				
				// Ref with product Groups
				
				$product_groups = $_POST['product_groups'];
				
				foreach($product_groups as $group_id)
				{
					$query = "INSERT INTO [pre]shop_prod_group_ref (`prod_id`,`group_id`) VALUES ('$item_id','$group_id')";
					$ah->rs($query);
				}
				
				// Ref with chars
				
				$char = (isset($_POST['char']) ? $_POST['char'] : array());
				$char2 = (isset($_POST['char2']) ? $_POST['char2'] : array());
				
				foreach($char as $char_id => $value)
				{
					$value2 = (isset($char2[$char_id]) ? $char2[$char_id] : "");
					$is_filter = 1;
					$query = "INSERT INTO [pre]shop_chars_prod_ref (`prod_id`,`char_id`,`value`,`value2`,`filter`) VALUES ('$item_id','$char_id','$value','$value2','$is_filter')";
					$ah->rs($query);
				}
				
				// Upload files
				
				$filename = "images";
				
				if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
				{
					$file_path = "../../../../split/files/shop/products/";
					
					$files_upload = $ah->mtvc_add_files_file_miltiple(array(
							'path'			=>$file_path,
							'name'			=>5,
							'pre'			=>"prod_",
							'size'			=>10,
							'rule'			=>0,
							'max_w'			=>2500,
							'max_h'			=>2500,
							'files'			=>$filename,
							'resize_path'	=>$file_path."crop/",
							'resize_w'		=>250,
							'resize_h'		=>250,
							'resize_path_2'	=>"0",
							'resize_w_2'	=>0,
							'resize_h_2'	=>0
						  ));
					if($files_upload)
					{
						foreach($files_upload as $file_upload)
						{
							$query = "INSERT INTO [pre]files_ref (`ref_table`, `ref_id`, `file`, `crop`, `path`) VALUES ('shop_products', '$item_id', '$file_upload', '0', 'split/files/shop/products/')";
							
							$ah->rs($query);
						}
					}
				}
				
				$data['status'] = "success";
				$data['message'] = "Новый товар успешно создан";
				
				// End of success saving
				
				
					}else{
						$data['status'] = "failed";
						$data['message'] = "Укажите категорию товара";
					}
				}else{
					$data['status'] = "failed";
					$data['message'] = "Товар с таким Артикулом уже существует";
				}
			}else{
					$data['status'] = "failed";
					$data['message'] = "Товар с таким Алиасом уже существует";
				}
		}else{
				$data['status'] = "failed";
				$data['message'] = "Укажите артикул товара";
			}
	}else{
			$data['status'] = "failed";
			$data['message'] = "Укажите название товара";
		}
	
	