<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getShopQuickOrdersItem($item_id);

	$rootPath = "../../../../..";

	$cardTmp = array(

					 'Имя'						=>	array( 'type'=>'input', 	'field'=>'user_name', 		'params'=>array( 'size'=>100, 'hold'=>'Имя клиента' ) ),

					 'clear-0'					=>	array( 'type'=>'clear' ),

					 'Телефон'					=>	array( 'type'=>'input', 	'field'=>'user_phone', 		'params'=>array( 'size'=>100, 'hold'=>'Телефон' ) ),

					 'clear-1'					=>	array( 'type'=>'clear' ),

					 'Количество'				=>	array( 'type'=>'number', 	'field'=>'prod_quant', 		'params'=>array() ),

					 'clear-2'					=>	array( 'type'=>'clear' ),

					 'Артикул товара'			=>	array( 'type'=>'input', 	'field'=>'prod_sku', 		'params'=>array('onchange'=>'update_prod_info_by_sku($(this).val());') ),

					 'ID товара'				=>	array( 'type'=>'hidden', 	'field'=>'prod_id' ),

					 'clear-3'					=>	array( 'type'=>'clear' ),

					 'Название товара'			=>	array( 'type'=>'input', 	'field'=>'prod_name', 		'params'=>array('disabled'=>true, 'size'=>50) ),

					 'Цена за товар (грн)'		=>	array( 'type'=>'input', 	'field'=>'prod_price', 		'params'=>array('disabled'=>true) )

					 );


	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editQuickOrder", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования заказа #$id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>