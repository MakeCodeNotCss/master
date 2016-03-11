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
	$client_name      	= $_POST['clientName'];
	$client_lastName  	= $_POST['clientLastName'];
	$client_phone     	= $_POST['clientPhone'];
	$client_email     	= $_POST['clientEmail'];
	$order_summ         = $_POST['order_Sum'];
	// DELIVERY POST
	$delivery_method    = (isset($_POST['delivery_method']) && $_POST['delivery_method'] && $_POST['delivery_method']!==0 ? $_POST['delivery_method'] : 1);
	$client_street   	= $_POST['street'];
	$client_house    	= $_POST['house'];
	$client_apps   	    = $_POST['appartments'];
	// NOVA POSHTA POST
	$delivery_np_city	= $_POST['np_city'];
	$delivery_np_part	= $_POST['np_part'];
	// OTHER POST
	$order_id 			= 0;
	$curr_date		    = date("Y-m-d H:i:s",time());
	$pay_method			= $_POST['payment'];
	$status 			= 1;




	//Get total price of order

	$query = "SELECT SUM(P.price*C.quant) as cart_price, SUM(C.quant) as cart_quant
				FROM [pre]shop_products as P 
				LEFT JOIN [pre]shop_cart as C ON C.prod_id=P.id
				WHERE C.uid='$client_id'
				  ";
	$order_total_summ = $db->exec_query($query,1);

	$order_summ = $order_total_summ['cart_price'];

	$order_quant = $order_total_summ['cart_quant'];

	//echo "<pre>"; print_r($order_total_summ); echo "</pre>"; exit();

	//Get products order_list for client

	$query = "SELECT C.*,
				(SELECT name FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_name,
				(SELECT price FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_price,
				(SELECT currency FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_currency
				FROM [pre]shop_cart as C
				WHERE C.uid='$client_id'
				";
	$cart_order = $db->exec_query($query);

	//echo "<pre>"; print_r($cart_order); echo "</pre>"; exit();

	//===================================================================
	//INSERT INTO ORDERS
	
	if($cart_order)
	{
		if(strlen($client_name) >= 2)
		{
			if(strlen($client_lastName) >= 2)
			{
				if(filter_var($client_email, FILTER_VALIDATE_EMAIL))
				{
					if(strlen($client_phone) >= 10)
					{
						if($delivery_method==1)
						{

							$data['status']='success';
							$data['message']='Заказ успешно оформлен';

							$cart_serialize = serialize($cart_order);

							$query = "INSERT INTO [pre]shop_orders (client_name, client_fname, client_phone, client_email, type, products, products_quant, sum, user_id, author_id, details, delivery_address, delivery_method, pay_method, dateCreate, dateModify, status, code)
										VALUES (
										'$client_name', 
										'$client_lastName', 
										'$client_phone', 
										'$client_email', 
										'internet-shop',
										'$cart_serialize', 
										'$order_quant', 
										'$order_summ', 
										'$client_id', 
										'$client_id',
										'$client_dt', 
										'$client_street.$client_house.$client_apps',
										'$delivery_method',
										'$pay_method',
										'$curr_date',
										'$curr_date',
										'$status',
										'".time()."'


										)
										";

							$insert_success = $db->exec_query($query,0,1);

							//echo "<pre>"; print_r($insert_success); echo "</pre>"; exit();

							$query = "SELECT id
										FROM [pre]shop_orders
										WHERE `user_id` = $client_id
										LIMIT 1
										";
							$order_id = $db->exec_query($query,1);

							//echo "<pre>"; print_r($order_id); echo "</pre>"; exit();

							$orderNumber = (int)$order_id['id']+5000;

							ob_start();

							echo '<center class="h150 padding-top50"><h3>Спасибо за Вашу заявку, в ближайшее время с Вами свяжеться наш менеджер.</h3></center>';

							$data['checkoutHtml'] = ob_get_contents();

							ob_end_clean(); 

						}
						elseif($delivery_method==2)
						{
							if(isset($delivery_np_city) && $delivery_np_city)
							{
								if(isset($delivery_np_part) && $delivery_np_part)
								{

									$data['status']='success';
									$data['message']='Заказ успешно оформлен';

									$cart_serialize = serialize($cart_order);

									$query = "INSERT INTO [pre]shop_orders (client_name, client_fname, client_phone, client_email, type, products, products_quant, sum, user_id, author_id, details, delivery_address, delivery_method, pay_method, dateCreate, dateModify, status, code)
												VALUES (
												'$client_name', 
												'$client_lastName', 
												'$client_phone', 
												'$client_email', 
												'internet-shop',
												'$cart_serialize', 
												'$order_quant', 
												'$order_summ', 
												'$client_id', 
												'$client_id',
												'$client_dt', 
												'$delivery_np_city.$delivery_np_part',
												'$delivery_method',
												'$pay_method',
												'$curr_date',
												'$curr_date',
												'$status',
												'".time()."'


												)
												";

									$insert_success = $db->exec_query($query,0,1);

									//echo "<pre>"; print_r($insert_success); echo "</pre>"; exit();

									$query = "SELECT id
												FROM [pre]shop_orders
												WHERE `user_id` = $client_id
												LIMIT 1
												";
									$order_id = $db->exec_query($query,1);

									//echo "<pre>"; print_r($order_id); echo "</pre>"; exit();

									$orderNumber = (int)$order_id['id']+5000;

									ob_start();

									echo '<center class="h150 padding-top50"><h3>Спасибо за Вашу заявку, в ближайшее время с Вами свяжеться наш менеджер.</h3></center>';

									$data['checkoutHtml'] = ob_get_contents();

									ob_end_clean(); 

								}else{
									$data['message'] = "Вы должны выбрать отделение Новой Почты";
								}
							}else{
								$data['message'] = "Вы должны выбрать город доставки";
							}


						}
						elseif($delivery_method==3)
						{
							if(strlen($client_street) >= 4)
							{
								if(strlen($client_house) >= 1)
								{
									if(strlen($client_apps) >= 1)
									{

										$data['status']='success';
										$data['message']='Заказ успешно оформлен';

										$cart_serialize = serialize($cart_order);

										$query = "INSERT INTO [pre]shop_orders (client_name, client_fname, client_phone, client_email, type, products, products_quant, sum, user_id, author_id, details, delivery_address, delivery_method, pay_method, dateCreate, dateModify, status, code)
													VALUES (
													'$client_name', 
													'$client_lastName', 
													'$client_phone', 
													'$client_email', 
													'internet-shop',
													'$cart_serialize', 
													'$order_quant', 
													'$order_summ', 
													'$client_id', 
													'$client_id',
													'$client_dt',
													'$client_street.$client_house.$client_apps',
													'$delivery_method',
													'$pay_method',
													'$curr_date',
													'$curr_date',
													'$status',
													'".time()."'


													)
													";

										$insert_success = $db->exec_query($query,0,1);

										//echo "<pre>"; print_r($insert_success); echo "</pre>"; exit();

										$query = "SELECT id
													FROM [pre]shop_orders
													WHERE `user_id` = $client_id
													LIMIT 1
													";
										$order_id = $db->exec_query($query,1);

										//echo "<pre>"; print_r($order_id); echo "</pre>"; exit();

										$orderNumber = (int)$order_id['id']+5000;

										ob_start();

										echo '<center class="h150 padding-top50"><h3>Спасибо за Вашу заявку, в ближайшее время с Вами свяжеться наш менеджер.</h3></center>';

										$data['checkoutHtml'] = ob_get_contents();

										ob_end_clean(); 

									}else{
										$data['message'] = "SQL ERROR";
									}
								}else{
									$data['message'] = "Вы должны указать номер дома";
								}
							}else{
								$data['message'] = "Вы должны указать улицу";
							}
							
						}else{
								$data['message'] = "Ваш способ доставки не определен";
						}
					}else{
							$data['message'] = "Введенный вами номер слишком короткий";
					}
				}else{
						$data['message'] = "Введенный вами email недействителен";
				}
			}else{
					$data['message'] = "Введите корректную фамилию (минимум 2 символа)";
			}
		}else{
				$data['message'] = "Введите корректное имя (минимум 2 символа)";
		}
	}else{

		echo "SQL Error";

		ob_start();

		echo '<center class="h150 padding-top50"><h3>На сервере произошла ошибка, свяжитесь с нашим менеджером по контактному номеру.</h3></center>';

		$data['checkoutHtml'] = ob_get_contents();

		ob_end_clean(); 
	}




	if(isset($insert_success) && $insert_success)
		{
			$query = "DELETE FROM [pre]shop_cart
						WHERE `uid`= '$client_id'
						";
			$delete_success = $db->exec_query($query,0,1);
		}

	

		$query = "SELECT *
					FROM [pre]shop_delivery_methods
					WHERE `id`=$delivery_method
					LIMIT 1
				";

		$delivery = $db->exec_query($query,1);

		$delivery_price = $delivery['price'];
		$delivery_type  = $delivery['name'];
	

 	//Send a letter 

 

	include_once("../model/mod.helper.php");

	$helper = new Helper($db);

	$sendTo = "info@parquet-board.com";

	$from = $client_email;

				$sendMessage = "<p>Новый заказ для: $client_name &nbsp; $client_lastName</p>";
				$sendMessage .= "<p>ID пользователя: $client_id</p>";
				$sendMessage .= "<p>Контактный номер: $client_phone</p>";
				$sendMessage .= "<p>Адресс доставки: $client_country &nbsp; $client_city &nbsp; $client_delivery</p>";
				$sendMessage .= "<p>Email: $client_email</p><hr>";
				$sendMessage .= "<p>Номер заказа: $orderNumber</p><hr>";
				$sendMessage .= "<p>Список товаров:</p>";
				$sendMessage .= "<p>Наименование  Количество  Стоимость</p>";

				$totalSum = 0;
				foreach($cart_order as $item)
					{
						$product_name = $item['product_name'];
						$product_quant = $item['quant'];
						$product_price = $item['product_price'];
						$sendMessage .= "<p>$product_name &nbsp; $product_quant &nbsp; $product_price</p>";
						$totalSum += $product_quant*$product_price;
					}

				$sendMessage .= "<p>Суммарная стоимость заказа: $totalSum</p><p> $order_summ</p>";
				$sendMessage .= "<p>Способ доставки: $delivery_type</p>";
				$sendMessage .= "<p>Стоимость доставки: $delivery_price</p>";


	$sendStatus = $helper->send_letter($sendTo,$from,"Новый заказ для $client_name $client_lastName",$sendMessage,"Parquet Board Orders");


	$sendTo = $client_email;

	$from = "info@parquet-board.com";


			 	$sendMessage = "<p>Ваш заказ успешно обработан.</p>";
			    $sendMessage .= "<p>Номер вашего заказа: <strong>".$orderNumber."</strong></p>";
			    $sendMessage .= "<p><strong>Список товаров:</strong></p>";
			    $sendMessage .= "<table style=\"margin:10px 0px; border-top:1px solid #CCC; border-left:1px solid #CCC;\">"; 
			    $sendMessage .= "<tr>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Наименование</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Количество</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Стоимость</th>
			        </tr>"; 

			    $totalSum = 0;
			    foreach($cart_order as $item)
			     {
			      $product_name = $item['product_name'];
			      $product_quant = $item['quant'];
			      $product_price = $item['product_price'];
			      $totalSum += $product_quant*$product_price;
			            
			      $sendMessage .= "<tr>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">".$product_name."</td>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\" align=\"center\">".$product_quant."</td>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\" align=\"center\">".$product_price."</td>
			          </tr>";     
			     }

			     $fullSumm = $totalSum + $delivery_price;

			    $sendMessage .= "</table>";
			    $sendMessage .= "<p>Суммарная стоимость заказа: <strong>".$totalSum." грн.</strong></p>";
			    $sendMessage .= "<p>Способ доставки: <strong>".$delivery_type."</strong></p>";
			    $sendMessage .= "<p>Стоимость доставки: <strong>".$delivery_price." грн.</strong></p>";
			    
			    $sendMessage .= "<p><strong>К оплате: ".$fullSumm." грн.</strong></p>";



			    //======



				/*$sendMessage = "<p>Ваш заказ успешно обработан.</p>";
				$sendMessage .= "<p>Номер вашего заказа: $orderNumber.</p>";
				$sendMessage .= "<p>Доставка: $delivery_type.</p>";
				$sendMessage .= "<p>Стоимость доставки: $delivery_price.</p>";
				$sendMessage .= "<p>Суммарная стоимость заказа: $totalSum грн.</p>";
				$sendMessage .= "<p>Список товаров:</p>";
				foreach($cart_order as $item)
					{
						$product_name = $item['product_name'];
						$product_quant = $item['quant'];
						$product_price = $item['product_price'];
						$sendMessage .= "<p>$product_name &nbsp; $product_quant &nbsp; $product_price</p>";
					}*/



	$sendStatus = $helper->send_letter($sendTo,$from,"Подтверждение заказа",$sendMessage,"Parquet Board");



$db->db_destroy();

echo json_encode($data);

	