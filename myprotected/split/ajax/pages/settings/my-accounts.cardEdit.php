<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'my-accounts' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getMyAccount($item_id);

	$cardItem = $cardItem[0];

	//print_r($cardItem);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Номер счета'		=>	array( 'type'=>'input', 	'field'=>'acc_number', 			'params'=>array( 'size'=>35, 'hold'=>'Номер счета' ) ),

					 'Название'			=>	array( 'type'=>'input', 	'field'=>'name', 				'params'=>array( 'size'=>63, 'hold'=>'Название банка' ) ),
					 
					 'Реквизит'			=>	array( 'type'=>'redactor', 	'field'=>'props', 				'params'=>array(  'size'=>255, 'hold'=>'Реквизит' ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editMyAccount", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
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