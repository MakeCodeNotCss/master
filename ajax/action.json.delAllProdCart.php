<?php require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

	// Login check

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error', 'total_summ' => 0, 'total_quant' => 0, 'emptyCart'=>'');


	$uid = ACCOUNT_ID;
	$cart_id = $_POST['ID'];



		$query = "DELETE FROM [pre]shop_cart 
					WHERE `uid`=$uid 
					";
		$delete_success = $db->exec_query($query,0,1);
		
		if($delete_success)
		{
			$countQuery = "SELECT SUM(P.price*C.quant) as cart_price, SUM(C.quant) as cart_quant
				FROM [pre]shop_products as P 
				LEFT JOIN [pre]shop_cart as C ON C.prod_id=P.id
				WHERE C.uid='$uid'
				  ";
			$cart_total = $db->exec_query($countQuery,1);

			$data['total_summ'] = $cart_total['cart_price'];
			$data['total_quant'] = $cart_total['cart_quant'];


			$data['status'] = 'success';

			$data['message'] = "Cart item ass been deleted";

		}else{

			$data['message'] = "Permission denied";

		}


		$query = "SELECT C.*,
					(SELECT name FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_name,
					(SELECT alias FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_alias,
					(SELECT model FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_model,
					(SELECT price FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_price,
					(SELECT currency FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_currency,
					(SELECT file FROM [pre]files_ref WHERE `ref_id`=C.prod_id ORDER BY id DESC LIMIT 1) as product_image
					FROM [pre]shop_cart as C
					WHERE C.uid='$uid'
					ORDER BY C.id DESC
					";
		$cartProdList=$db->exec_query($query);


		if(!$cartProdList)
		{
			$data['emptyCart'] = 'Ваша корзина пуста';
			$data['emptyCartBtn'] = '<a href="javascript:void" class="btn btn-primary pull-right">В корзине нет товаров :(</a>';
			$data['tranqBtn'] = '';
			$data['emptyQuickCart'] = '<a disabled="disabled" href="javascript:void" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>';

		}


ob_start();


	?>
			<center style='color:black;'>Ваша корзина пуста</center>
			<!--<p id="response"><i class="fa fa-warning"></i></p>-->
			<div class="row cart-footer">
				<div class="col-md-6 nopadding-right">
					<a href="<?php echo RS.'cart/' ?>" class="btn btn-primary fullwidth">Корзина <i class="fa fa-angle-right"></i></a>
				</div>
				<div class="col-md-6 nopadding-left">
					<a disabled="disabled" href="javascript:void" class="btn btn-info fullwidth">Заказ <i class="fa fa-angle-right"></i></a>
				</div>
			</div><!-- /cart footer -->
	<?php


$data['fastCartHtml'] = ob_get_contents();
ob_end_clean(); 



$db->db_destroy();

echo json_encode($data);
	
	