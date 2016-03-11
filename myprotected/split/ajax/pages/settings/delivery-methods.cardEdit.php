<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'my-accounts' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getMyDelivery($item_id);

	$cardItem = $cardItem[0];

	//print_r($cardItem);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Способ'				=>	array( 'type'=>'redactor', 	'field'=>'name', 			'params'=>array( 'size'=>255, 'hold'=>'Способ' ) ),
					 
					 'Стоимость'			=>	array( 'type'=>'input', 	'field'=>'price', 			'params'=>array(  'size'=>25, 'hold'=>'Стоимость' ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editMyDelivery", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Мои счета (режим редактирования)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>