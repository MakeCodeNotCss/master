<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$has_chars = (int)$_POST['has_chars'];
	
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
					'square'        => (float)$_POST['square'],
					
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
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
					
	if($cardUpd['in_stock'] > $cardUpd['quant']) $cardUpd['in_stock'] = $cardUpd['quant'];
	
	$cat_id = (int)$_POST['cat_id'];
					
	$query = "SELECT id FROM [pre]shop_products WHERE `alias`='".$cardUpd['alias']."' AND `id`!=$item_id LIMIT 1";
	$test_alias = $ah->rs($query);
	
	$query = "SELECT id FROM [pre]shop_products WHERE `sku`='".$cardUpd['sku']."' AND `id`!=$item_id LIMIT 1";
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
	
	// Update category
	
	$cat_id = (int)$_POST['cat_id'];
	
	$query = "SELECT * FROM [pre]shop_cat_prod_ref WHERE `prod_id`='$item_id' LIMIT 1";
	$catRes = $ah->rs($query);
	
	if(!$catRes)
	{
		$query = "INSERT INTO [pre]shop_cat_prod_ref (`cat_id`,`prod_id`) VALUES ('$cat_id','$item_id')";
	}else
	{
		$query = "UPDATE [pre]shop_cat_prod_ref SET `cat_id`='$cat_id' WHERE `prod_id`=$item_id LIMIT 1";
	}
	
	$ah->rs($query);
	
	// Update product Groups
	
	$product_groups = $_POST['product_groups'];
	
		$query = "SELECT M.id, M.name, M.block FROM [pre]shop_products_groups as M LEFT JOIN [pre]shop_prod_group_ref as R on M.id = R.group_id WHERE R.prod_id = $item_id LIMIT 100";
		$groupsMassive = $ah->rs($query);
	
	foreach($groupsMassive as $mas_item)
	{
		$find_ref = false;
		$di = -1;
		foreach($product_groups as $i => $group_id)
		{	
			if($mas_item['id']==$group_id)
			{
				$find_ref = true;
				$di = $i;
				break;
			}	
		}
		if(!$find_ref)
			{
				$query = "DELETE FROM [pre]shop_prod_group_ref WHERE `prod_id`=$item_id AND `group_id`=".$mas_item['id']." LIMIT 1";
				$ah->rs($query);
			}else
			{
				unset($product_groups[$di]);
			}
	}
	foreach($product_groups as $group_id)
	{
		$query = "INSERT INTO [pre]shop_prod_group_ref (`prod_id`,`group_id`) VALUES ('$item_id','$group_id')";
		$ah->rs($query);
	}
	
	// Update chars
	
	$prevent_cat_id = $_POST['prevent_cat_id'];
	
	$char = (isset($_POST['char']) ? $_POST['char'] : array());
	$char2 = (isset($_POST['char2']) ? $_POST['char2'] : array());
	
	if($prevent_cat_id == $cat_id && $has_chars)
	{
		foreach($char as $char_id => $value)
		{
			$value2 = (isset($char2[$char_id]) ? $char2[$char_id] : "");
			$is_filter = 1;
			
			$findRowQuery = "SELECT id FROM [pre]shop_chars_prod_ref WHERE `char_id`=$char_id AND `prod_id`=$item_id LIMIT 1";
			$findRow = $ah->rs($findRowQuery);
			
			if($findRow)
			{
				$query = "UPDATE [pre]shop_chars_prod_ref SET `value`='$value', `value2`='$value2' WHERE `char_id`=$char_id AND `prod_id`=$item_id LIMIT 1";
				$ah->rs($query);
			}else
			{
				$query = "INSERT INTO [pre]shop_chars_prod_ref (`prod_id`,`char_id`,`value`,`value2`,`filter`) VALUES ('$item_id','$char_id','$value','$value2','$is_filter')";
				$ah->rs($query);
			}
		}
	}else
	{
		$char_ref_data = $ah->rs("SELECT char_id,id FROM [pre]shop_chars_prod_ref WHERE `prod_id`=$item_id LIMIT 1000");
		
		foreach($char_ref_data as $char_ref)
		{
			$char_data = $ah->rs("SELECT id FROM [pre]shop_chars WHERE `id`='".$char_ref['char_id']."' AND `is_dinamic`=0 LIMIT 1");
			
			if($char_data)
			{
				$query = "DELETE FROM [pre]shop_chars_prod_ref WHERE `id`='".$char_ref['id']."' LIMIT 1";
				$ah->rs($query);
			}	
		}
		
		foreach($char as $char_id => $value)
		{
			$value2 = (isset($char2[$char_id]) ? $char2[$char_id] : "");
			$is_filter = 1;
			
			$query = "INSERT INTO [pre]shop_chars_prod_ref (`prod_id`,`char_id`,`value`,`value2`,`filter`) VALUES ('$item_id','$char_id','$value','$value2','$is_filter')";
			$ah->rs($query);
		}
	}
	
	// Update dinamical Chars
	
	if(isset($_POST['charD']))
	{
		$charsD = $_POST['charD'];
		$priceD = $_POST['charD3'];
		
		foreach($charsD as $refID => $currVal)
		{
			$currValue = strip_tags($currVal);
			$currPrice = (float)$priceD[$refID];
			
			$query = "UPDATE [pre]shop_chars_prod_ref SET `value`='$currValue',`price_dif`='$currPrice' WHERE `id`=$refID AND `prod_id`=$item_id LIMIT 1";
			$ah->rs($query);
		}
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
	
	// Upload docs
			
			$filename = "docs";
			
			if(isset($_FILES[$filename]) && count($_FILES[$filename]) > 0)
			{
				$file_path = "../../../../split/files/documents/";
				
				$files_upload = $ah->mtvc_add_files_file_miltiple(array(
						'path'			=>$file_path,
						'name'			=>5,
						'pre'			=>"doc_",
						'size'			=>20,
						'rule'			=>0,
						'max_w'			=>2500,
						'max_h'			=>2500,
						'files'			=>$filename
					  ));
				if($files_upload)
				{
					foreach($files_upload as $file_upload)
					{
						$query = "INSERT INTO [pre]docs_ref (`ref_table`, `ref_id`, `file`, `crop`, `path`) VALUES ('shop_products', '$item_id', '$file_upload', '0', 'split/files/documents/')";
						
						$ah->rs($query);
					}
				}
			}
	
	$data['message'] = "Успешное сохранение!";
	
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
	
	