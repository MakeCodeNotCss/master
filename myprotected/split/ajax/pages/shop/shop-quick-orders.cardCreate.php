<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type' =>'quickOrders');
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content

	$orderStatuses		= $zh->getOrderStatuses();
	
	$deliveryMethods 	= $zh->getDeliveryMethods();
	
	$paymentMethods 	= $zh->getPaymentMethods();
	
	$cardItem = $zh->getShopQuickOrdersItem($item_id);

	$cartProducts 		= array();
	
	$nodeList 			= $zh->getCatalogParents(); // get Brands
	
	$paidStatuses = array( array('id'=>'Оплачен','name'=>'Оплачен'), array('id'=>'Не оплачен','name'=>'Не оплачен'));
	
	$orderNotes = array('Создан:'=>$cardItem['dateCreate'],'Автор:'=>"WP ZEN",'№ заказа:'=>($item_id+5000),'ID:'=>$item_id);

	$rootPath = "../../../../..";


	$cardTmp = array(
					 'Имя'						=>	array( 'type'=>'input', 		'field'=>'user_name', 		'params'=>array('size'=>40, 'hold'=>'Имя клиента' ) ),

					 'Телефон'					=>	array( 'type'=>'input', 		'field'=>'user_phone', 		'params'=>array('size'=>25, 'hold'=>'Телефон клиента' ) ),

					 'clear-0'					=>	array( 'type'=>'clear' ),


					 'Доставка'				=>	array( 'type'=>'header'),
					 
					 'Способ доставки'		=>	array( 'type'=>'select', 		'field'=>'delivery_method', 		'params'=>array( 'list'=>$deliveryMethods, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['delivery_method'], 
																														 'onChange'=>"" 
																														 ) ),
																														 
					 'Адрес до
					  ставки'		=>	array( 'type'=>'input', 		'field'=>'delivery_address', 		'params'=>array( 'size'=>100, 'hold'=>'Address' ) ),
					 																									 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Дата доставки'		=>	array( 'type'=>'date', 			'field'=>'delivery_date', 			'params'=>array( ) ),
					 
					 'Время доставки'		=>	array( 'type'=>'input', 		'field'=>'delivery_time', 			'params'=>array( 'size'=>25, 'hold'=>'Time' ) ),

					  'Товары'				=>	array( 'type'=>'header'),
					 
					 'ProductsJs'			=>	array( 'type'=>'hidden', 		'field'=>'productsJsData' ),
					 
					 'Список товаров'		=>	array( 'type'=>'cartProducts',	'field'=>'products',				'params'=>array( 'items'=>$cartProducts, 'node_list'=>$nodeList, 0, 'type'=>'create' )),
					 
					 );
	

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createQuickOrder", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания быстрого заказа</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>