<?php 
	$cardItem = $zh->getQuickOrderDetails($item_id);

	//print_r($cardItem);
	
	// Start header content
	
	$headOrderParams = array('confirm'=>false,'cancel'=>false);
	
	if($cardItem['status']==1) $headOrderParams['confirm'] = true;
	
	if($cardItem['status']!=5) $headOrderParams['cancel'] = true;
	
	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'shopQuickOrder', 'params'=>$headOrderParams );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	
	// Start body content
	
	
	// Get order statuses
	
	$orderStatuses		= $zh->getOrderStatuses();
	
	$deliveryMethods 	= $zh->getDeliveryMethods();
	
	$paymentMethods 	= $zh->getPaymentMethods();
	
	$cartProducts 		= $card_item['prod_id'];
	
	$nodeList 			= $zh->getCatalogParents(); // get Brands
	
	$paidStatuses = array( array('id'=>'Оплачен','name'=>'Оплачен'), array('id'=>'Не оплачен','name'=>'Не оплачен'));
	
	$orderNotes = array('Создан:'=>$cardItem['dateCreate'],'Автор:'=>"WebPlat STRATEG",'№ заказа:'=>($item_id),'ID:'=>$item_id);
	
	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 
					 'Клиент ID'			=>	array( 'type'=>'hidden', 		'field'=>'user_id' ),
					 
					 'Имя'					=>	array( 'type'=>'input', 		'field'=>'user_name', 				'params'=>array( 'size'=>25, 'hold'=>'Name' ) ),
					 
					 'Телефон'				=>	array( 'type'=>'input', 		'field'=>'user_phone', 				'params'=>array( 'size'=>25, 'hold'=>'Client phone' ) ),
					 
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Статус заказа'			=>	array( 'type'=>'select', 		'field'=>'status', 					'params'=>array( 'list'=>$orderStatuses, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['status'], 
																														 'onChange'=>"" 
																														 ) ),
					 
					 'ProductsJs'			=>	array( 'type'=>'hidden', 		'field'=>'productsJsData' ),
					 
					 'Список товаров'		=>	array( 'type'=>'cartProducts',	'field'=>'prod_id',				'params'=>array( 'items'=>$cartProducts, 'node_list'=>$nodeList, 'delivery_price'=>$cardItem['delivery']['price'], 'type'=>'create' )),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Удалить заказ'		=>	array( 'type'=>'deleteOrder')
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editShopOrder", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Заказ с интернет магазина #".($item_id+5000)."</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>