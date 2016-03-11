<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	require_once "../../../require.base.php";
	
	$appTable = "shop_orders";
	
	$orderId	= $_POST['orderId'];
	
	$account	= $_POST['accNum'];

	//SELECT ORDER BY ID///////////////////////////////
	
	$query = "SELECT *
				FROM [pre]shop_orders
				WHERE id=$orderId
				LIMIT 1
				";

	$orderData = $ah->rs($query);


	///////
	$order_id 			= $orderId;
	$client_id        	= $orderData[0]['user_id'];
	$client_name      	= $orderData[0]['client_name'];
	$client_lastName  	= $orderData[0]['client_fname'];
	$client_phone     	= $orderData[0]['client_phone'];
	$client_email     	= $orderData[0]['client_email'];
	///////
	$order_summ         = $orderData[0]['sum'];
	$delivery_method    = $orderData[0]['delivery_method'];
	$client_address   	= $orderData[0]['delivery_address'];
	$pay_method			= $orderData[0]['pay_method'];
	///////
	$curr_date		    = date("Y-m-d H:i:s",time());
	$prod_list 			= unserialize($orderData[0]['products']);



	//GET DELIVERY AND PAY METHODS/////////////////////

			$q = "SELECT *
					FROM [pre]shop_delivery_methods
					WHERE `id`=$delivery_method
					LIMIT 1
				";

	$delivery = $ah->rs($q);

	$delivery_price = $delivery[0]['price'];
	$delivery_type  = $delivery[0]['name'];



			$w = "SELECT *
					FROM [pre]shop_payment_methods
					WHERE `id`=$pay_method
					LIMIT 1
				";

	$payment = $ah->rs($w);

	$payment_method = $payment[0]['name'];


	//CHECK ORDER SUMM//////////////////////////////////

	$query = "SELECT SUM(P.price*C.quant) as cart_price, SUM(C.quant) as cart_quant
				FROM [pre]shop_products as P 
				LEFT JOIN [pre]shop_cart as C ON C.prod_id=P.id
				WHERE C.uid='$client_id'
				  ";
	$order_total_summ = $ah->rs($query);

	$order_summ = $order_total_summ[0]['cart_price'];

	$order_quant = $order_total_summ[0]['cart_quant'];

	//SELECT ACC PROPS//////////////////////////////////

	$query = "SELECT *
				FROM [pre]my_accounts
				WHERE `acc_number`='$account'
				LIMIT 1

			";
	$account_props = $ah->rs($query);
	$account_props = $account_props[0];
	$props = $account_props['props'];
	$account_number = $account_props['acc_number'];

	//SEND MESSAGE//////////////////////////////////////

	//print_r($prod_list);


	$sendTo = $client_email;

	$from = "info@parquet-board.com";

			    $sendMessage .= "<p>Номер вашего заказа: <strong>".($orderId+5000)."</strong></p>";
			    $sendMessage .= "<p><strong>Список товаров:</strong></p>";
			    $sendMessage .= "<table style=\"margin:10px 0px; border-top:1px solid #CCC; border-left:1px solid #CCC;\">"; 
			    $sendMessage .= "<tr>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Наименование</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Количество</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Стоимость</th>
			        </tr>"; 

			    $totalSum = 0;
			    foreach($prod_list as $i => $item)
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
			    $sendMessage .= "<p>Адресс доставки: <strong>".$client_address."</strong></p>";
			    $sendMessage .= "<p>Стоимость доставки: <strong>".$delivery_price." грн.</strong></p>";
			    $sendMessage .= "<p>Способ оплаты: <strong>".$payment_method."</strong></p>";
			    $sendMessage .= "<p><strong>Счет для оплаты: ".$account_number."</strong></p>";
			    $sendMessage .= "<p><strong>Реквизиты для оплаты: ".$props."</strong></p>";
			    $sendMessage .= "<p><strong>К оплате: ".$fullSumm." грн.</strong></p>";



	$sendStatus = $ah->send_letter($sendTo,$from,"Подтверждение заказа",$sendMessage,"Parquet Board");


	//SEND MESSAGE//////////////////////////////////////
		
	


	if(isset($sendStatus))
	{
		$data['status'] = "success";
		
		$data['message'] = "Сообщение успешно отправлено";

		$query = "UPDATE [pre]$appTable SET `prop_status`='Отправлено' WHERE `id`=$orderId LIMIT 1";
	
		$ah->rs($query);
	}
	
