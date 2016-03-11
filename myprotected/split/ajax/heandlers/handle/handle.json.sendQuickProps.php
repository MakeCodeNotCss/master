<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	require_once "../../../require.base.php";
	
	$appTable = "shop_quick_orders";
	
	$orderId	= $_POST['orderId'];
	
	$account	= $_POST['accNum'];

	//SELECT ORDER BY ID///////////////////////////////
	
	$query = "SELECT *
				FROM [pre]shop_quick_orders
				WHERE id=$orderId
				LIMIT 1
				";

	$orderData = $ah->rs($query);

	//print_r($orderData);

	     //    [id] => 1
         //    [user_id] => 25
         //    [user_name] => Вадим
         //    [user_phone] => 0953229203
         //    [prod_id] => 22
         //    [prod_quant] => 19
         //    [dateCreate] => 2016-03-10 14:15:15
         //    [order_total] => 
         //    [status] => 1
         //    [prop_status] => Не отправлено


	///////
	$order_id 			= $orderId;
	$client_id        	= $orderData[0]['user_id'];
	$client_name      	= $orderData[0]['user_name'];
	$client_phone     	= $orderData[0]['user_phone'];
	///////
	$curr_date		    = date("Y-m-d H:i:s",time());
	$prod_id 			= $orderData[0]['prod_id'];
	$product_quant 		= $orderData[0]['prod_quant'];


	//CHECK ORDER SUMM//////////////////////////////////

	$query = "SELECT SUM(P.price*C.prod_quant) as cart_price, SUM(C.quant) as cart_quant
				FROM [pre]shop_products as P 
				LEFT JOIN [pre]shop_quick_orders as C ON C.prod_id=P.id
				WHERE C.user_id='$client_id'
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


			 	$sendMessage = "<p>Ваш заказ успешно обработан.</p>";
			    $sendMessage .= "<p>Номер вашего заказа: <strong>".($orderId)."</strong></p>";
			    $sendMessage .= "<p><strong>Список товаров:</strong></p>";
			    $sendMessage .= "<table style=\"margin:10px 0px; border-top:1px solid #CCC; border-left:1px solid #CCC;\">"; 
			    $sendMessage .= "<tr>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Наименование</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Количество</th>
			         <th style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">Стоимость</th>
			        </tr>"; 

			      $totalSum = $product_quant*$product_price;
			            
			      $sendMessage .= "<tr>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\">".$product_name."</td>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\" align=\"center\">".$product_quant."</td>
			           <td style=\"padding:5px; border-bottom:1px solid #CCC; border-right:1px solid #CCC;\" align=\"center\">".$product_price."</td>
			          </tr>";     
			     }

			     $fullSumm = $totalSum;

			    $sendMessage .= "</table>";
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
	
