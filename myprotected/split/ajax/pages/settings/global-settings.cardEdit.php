<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'global-settings' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getSiteConfigs($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название сайта'		=>	array( 'type'=>'input', 	'field'=>'sitename', 			'params'=>array( 'size'=>35, 'hold'=>'Sitename', 'onchange'=>"change_alias();" ) ),
					 
					 'Номер телефона'		=>	array( 'type'=>'input', 	'field'=>'phone_number', 		'params'=>array( 'size'=>35, 'hold'=>'044-000-00-00' ) ),
					 
					 'Email техподдержки'	=>	array( 'type'=>'input', 	'field'=>'support_email', 		'params'=>array( 'size'=>35, 'hold'=>'SupportEmail' ) ),

					 'Наш адресс'			=>	array( 'type'=>'redactor', 		'field'=>'company_address', 	'params'=>array( 'size'=>255, 'hold'=>'CompanyAddress' ) ),

					 'Режим работы'			=>	array( 'type'=>'redactor', 		'field'=>'bussiness_hours', 	'params'=>array( 'size'=>255, 'hold'=>'BussinessHours' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'active', 				'params'=>array( 'reverse'=>false ) ),
					 	
					 'Индексация'			=>	array( 'type'=>'block', 	'field'=>'index', 				'params'=>array( 'reverse'=>false ) ),
					 
					 'Мета теги на главной'	=>	array( 'type'=>'header'),
					 
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'meta_title', 			'params'=>array( 'size'=>50, 'hold'=>'Title', 'onchange'=>"" ) ),
					 
					 'Keywords'				=>	array( 'type'=>'input', 	'field'=>'meta_keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords', 'onchange'=>"" ) ),
					 
					 'Description'			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 			'params'=>array( 'size'=>100, 'hold'=>'Description' ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editSiteConfig", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Глобальные настройки сайта (режим редактирования)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>