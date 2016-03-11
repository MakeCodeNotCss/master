<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getShopQuickOrdersItem($item_id);

	$rootPath = "../../../../..";

	$cardTmp = array(
					 'ID Клиента'				=>	array( 'type'=>'text', 		'field'=>'user_id', 		'params'=>array() ),
					 'Имя'						=>	array( 'type'=>'text', 		'field'=>'user_name', 		'params'=>array() ),
					 'Телефон'					=>	array( 'type'=>'text', 		'field'=>'user_phone', 		'params'=>array() ),
					 'ID товара'				=>	array( 'type'=>'text', 		'field'=>'prod_id', 		'params'=>array() ),
					 'Артикул'					=>	array( 'type'=>'text', 		'field'=>'prod_sku', 		'params'=>array() ),
					 'Наименование'				=>	array( 'type'=>'text', 		'field'=>'prod_name', 		'params'=>array() ),
					 'Количество'				=>	array( 'type'=>'text', 		'field'=>'prod_quant', 		'params'=>array() ),
					 'Стоимость'				=>	array( 'type'=>'text', 		'field'=>'prod_price', 		'params'=>array() ),
					 'Суммарная стоимость'		=>	array( 'type'=>'text', 		'field'=>'order_total',     'params'=>array() ),
					 'Дата заказа'				=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр FAQ #$item_id</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>