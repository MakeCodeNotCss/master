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
				'Номер счета'				=>	array( 'type'=>'input', 	'field'=>'acc_number', 	'params'=>array( 'size'=>25, 'hold'=>'Номер банковского счета' ) ),

				'Название'					=>	array( 'type'=>'input', 	'field'=>'name', 		'params'=>array( 'size'=>63, 'hold'=>'Название банка' ) ),

				'Реквизит'					=>	array( 'type'=>'redactor', 	'field'=>'props', 		'params'=>array(  ) )
					 
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createMyAccount", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Мои счета (режим создания)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>