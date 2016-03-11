<?php require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

	// Login check

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error', 'total_summ' => 0, 'total_quant' => 0, 'inCart' => '');


	$uid 		= ACCOUNT_ID;
	$prod_id 	= (int)$_POST['prod_id'];
	$curr_date  = date("Y-m-d H:i:s",time());
	$prod_quant = (isset($_POST['prod_qty']) && ($_POST['prod_qty'])!==0 && ($_POST['prod_qty']) ? (int)$_POST['prod_qty'] : 1);




	$query = "SELECT id, quant
				FROM [pre]shop_cart
				WHERE `uid`='$uid'
				AND `prod_id`=$prod_id
				ORDER BY id DESC
				LIMIT 1
				";
	$existingProd = $db->exec_query($query,1);

	if($existingProd)
	{
		$data['inCart'] = '<i class="fa fa-check"></i> Товар в корзине</button>';
		$quant=$prod_quant+$existingProd['quant'];

		$query = "UPDATE [pre]shop_cart
					SET quant=$quant
					WHERE `uid`='$uid'
					AND `prod_id`='$prod_id'
					";
		$update_success = $db->exec_query($query,0,1);

	}else{
		
		$data['inCart'] = '<i class="fa fa-check"></i>Товар в корзине</button>';
		$query = "INSERT INTO [pre]shop_cart (uid, prod_id, quant)
					VALUES ($uid, $prod_id, $prod_quant)
					";
		$insert_success = $db->exec_query($query,0,1);
	}



	if($insert_success || $update_success)
		{

			$data['status'] = 'success';
			$query = "SELECT C.*,
						(SELECT name FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_name,
						(SELECT alias FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_alias,
						(SELECT price FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_price,
						(SELECT currency FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_currency,
						(SELECT file FROM [pre]files_ref WHERE `ref_id`=C.prod_id ORDER BY id DESC LIMIT 1) as product_image
						FROM [pre]shop_cart as C
						WHERE C.uid='$uid'
						ORDER BY C.id DESC
						";
			$cartProdList = $db->exec_query($query);

			$data['message'] = "Товар успешно добавлен в корзину";

			$countQuery = "SELECT SUM(P.price*C.quant) as cart_price, SUM(C.quant) as cart_quant
							FROM [pre]shop_products as P 
							LEFT JOIN [pre]shop_cart as C ON C.prod_id=P.id
							WHERE C.uid='$uid'
							  ";
			$cart_total = $db->exec_query($countQuery,1);

			//echo "<pre>"; print_r($cart_total); echo "</pre>"; exit();

			$data['total_summ'] = $cart_total['cart_price'];
			$data['total_quant'] = $cart_total['cart_quant'];


ob_start();

														
		if($cartProdList)
		{
		foreach($cartProdList as $item)
			{?>
				<a class="quick-cart-item" href="<?php echo RS.$item['product_alias'].'/'?>">
					<img class="pull-left" src="<?php echo PRODUCT_IMG_PATH.$item['product_image'] ?>" width="40" alt="quick cart">
					<div class="inline-block">
						<span class="title block"><?php echo $item['product_name']?> &nbsp;x&nbsp;<?php echo $item['quant']?></span><span></span>
						<span class="price block"><?php echo ($item['product_price']*$item['quant'])?><strong> &nbsp;<?php echo $item['product_currency']?></strong></span>
					</div>
				</a>
			<?php
			}
		}else{
			echo "<center style='color:black;'>Ваша корзина пуста</center>";
		}
		?>
	
	<!-- cart footer -->
<div class="row cart-footer">
	<div class="col-md-6 nopadding-right">
		<a href="<?php echo RS.cart.'/' ?>" class="btn btn-primary fullwidth">Корзина <i class="fa fa-angle-right"></i></a>
	</div>
	<div class="col-md-6 nopadding-left">
	<span id="emptyQuickCart">
		<?php 
		if($cartProdList)
		{
		?>
			<a href="<?php echo RS.checkout.'/' ?>" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
		<?php
		}else{
		?>
			<a disabled="disabled" href="javascript:void" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
		<?
		}
		?>
	</span>
	</div>
	<?php


$data['fastCartHtml'] = ob_get_contents();
ob_end_clean(); 


			
		}else{
		$data['message'] = "Ваша корзина пуста";
	}
	






$db->db_destroy();

echo json_encode($data);

	