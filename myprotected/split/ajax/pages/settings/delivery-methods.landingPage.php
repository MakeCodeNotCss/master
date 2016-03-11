<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getLandingHeader($headParams);
	
	// Get page items
	
	$itemsList = $zh->getDeliveryMethods();

	
	// Table structure
	
	$tableColumns = array(
						  'Checkbox'	=>	array('type'=>'checkbox',	'field'=>''),
						  'Способ	'	=>	array('type'=>'text',		'field'=>'name'),
						  'Стоимость'	=>	array('type'=>'text',		'field'=>'price'),
						  'ID'			=>	array('type'=>'text',		'field'=>'id'),
						  'Edit'		=>	array('type'=>'cardEdit',	'field'=>'Edit')
						  );
	
	$tableParams = array( 'itemsList'=>$itemsList, 'tableColumns'=>$tableColumns, 'headParams'=>$headParams );
	
	$tableStr = $zh->getItemsTable($tableParams);
	
	// START PAGINATION
	
	// $pagiParams = array( 'headParams'=>$headParams, 'start_page'=>$start_page, 'pages'=>$pages, 'on_page'=>$on_page );
	
	// $pagiStr = $zh->getLandingPagination($pagiParams);
	
	// Join Content
	
	$data['bodyContent'] = $filterFormStr;
	
	$data['bodyContent'] .= $tableStr;
	
	$data['bodyContent'] .= $pagiStr;

?>