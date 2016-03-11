<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getLandingHeader($headParams);
	
	// Get page items
	
	$itemsList = $zh->getAllMyAccounts();

	
	// Table structure
	
	$tableColumns = array(
						  'Checkbox'	=>	array('type'=>'checkbox',	'field'=>''),
						  'Номер счета'	=>	array('type'=>'text',		'field'=>'acc_number'),
						  'Название'	=>	array('type'=>'text',		'field'=>'name'),
						  'Реквизит'	=>	array('type'=>'text',		'field'=>'props'),
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