<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getCatalogItemDetails($item_id);

	$catalogParents = $zh->getCatalogParents();
	
	$charsGroups = $zh->getCharsGroups();

	$rootPath = "../../../../..";
	
	$cardTmp = array(
				'Способ'					=>	array( 'type'=>'redactor', 	'field'=>'name', 		'params'=>array(  ) ),

				'Стоимость'					=>	array( 'type'=>'input', 	'field'=>'price', 	'params'=>array( 'size'=>25 ) )

					 
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createNewDelivery", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Способы доставки (режим создания)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>