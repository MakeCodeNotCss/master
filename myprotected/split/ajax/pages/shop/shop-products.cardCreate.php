<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getProductsItemDetails($item_id);

	$catalogList = $zh->getCatalogParents();
	
	$charsGroups = $zh->getCharsGroups();
	
	$productsGroups = $zh->getProductsGroups();
	
	//$mf_list = $zh->getCategoryMf($cardItem['category']['id']);
	
	$mf_list = $zh->getAllMf();

	$delivers_list = $zh->getAllDelivers();
	
	$access_list = $zh->getProdAccessuares($item_id);
	
	$colors = $zh->getColors();

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>25, 'hold'=>'Alias' ) ),
					 
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Артикул'				=>	array( 'type'=>'input', 	'field'=>'sku', 			'params'=>array( 'size'=>25, 'hold'=>'Article' ) ),
					 
					 'Модель'				=>	array( 'type'=>'input', 	'field'=>'model', 			'params'=>array( 'size'=>25, 'hold'=>'Model Name' ) ),
					 
					 'Цвет'					=>	array( 'type'=>'select', 	'field'=>'color_id', 		'params'=>array( 'list'=>$colors, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>0, 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Выберите цвет', 'id'=>0 ) 
																														 ) ),
					 'Площадь в упаковке м2'	=> array('type'=>'input',        'field'=>'square',          'params'=>array( 'size'=>20, 'hold'=>'В м.кв.' ) ),
					 
					 'Штрих-код'			=>	array( 'type'=>'hidden', 	'field'=>'code', 			'params'=>array( 'size'=>25, 'hold'=>'Code' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 'Название цвета'		=>	array( 'type'=>'input', 	'field'=>'color_name', 			'params'=>array( 'size'=>25, 'hold'=>'Black (for example)' ) ),
					 
					 'Значение цвета'		=>	array( 'type'=>'input', 	'field'=>'color_value', 		'params'=>array( 'size'=>25, 'hold'=>'#000000' ) ),
					 
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					'Категория'			=>	array( 'type'=>'select', 	'field'=>'cat_id', 			'params'=>array( 'list'=>$catalogList, 
					 																									 'type'=>'allCatalog', 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['category']['id'], 
					'onChange'=>"updateProductCharsForm(0,".json_encode($cardItem['charsGroup']).",".json_encode($cardItem['chars']).",$(this).val());", 
																														 'first'=>array( 'name'=>'-- Без категории --', 'id'=>0 ) 
																														 ) ),
																														 
					 
					 'Цена (грн)'			=>	array( 'type'=>'input', 	'field'=>'price', 			'params'=>array( 'size'=>25, 'hold'=>'UAH Price' ) ),
					 
					 'Цена от'				=>	array( 'type'=>'input', 	'field'=>'usd_price', 		'params'=>array( 'size'=>25, 'hold'=>'USD Price' ) ),
					 
					 'Старая Цена (грн)'	=>	array( 'type'=>'input', 	'field'=>'sale_price', 		'params'=>array( 'size'=>25, 'hold'=>'SALE Price' ) ),
					 
					 'Сопровождающий текст'	=>	array( 'type'=>'input', 	'field'=>'dop_text', 		'params'=>array( 'size'=>100, 'hold'=>'Text about price...' ) ),
					 
					 'clear-3'				=>	array( 'type'=>'clear' ),
					 
					 /*
					  'Производитель'		=>	array( 'type'=>'select', 	'field'=>'mf_id', 			'params'=>array( 'list'=>$mf_list, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['mf_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'-- Не указан --', 'id'=>0 ) 
																														 ) ),
					 */
					 
					 'Штрих-код'			=>	array( 'type'=>'hidden', 	'field'=>'mf_id', 			'params'=>array( 'size'=>25, 'hold'=>'Code' ) ),
					 
					 'Производитель'		=>	array( 'type'=>'autocomplete', 	'field'=>'mf_name', 	'params'=>array( 'size'=>50, 'hold'=>'Начните вводить название', 
					 																										'value'=>"" ) ),


					'Поставщик'			=>	array( 'type'=>'select', 	'field'=>'deliver_id', 	'params'=>array( 	'list'=>$delivers_list,
						'fieldValue'=>'id',
						'fieldTitle'=>'name',
						'currValue'=>0,
						'onChange'=>"",
						'first'=>array( 'name'=>'-- Не назначен --', 'id'=>0 )
					) ),

					'На складе (шт)'		=>	array( 'type'=>'hidden', 	'field'=>'quant', 			'params'=>array( 'size'=>25, 'hold'=>'Quant' ) ),
					
					'В продаже (шт)'		=>	array( 'type'=>'hidden', 	'field'=>'in_stock', 		'params'=>array( 'size'=>25, 'hold'=>'In stock' ) ),
					
					'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Индексация'			=>	array( 'type'=>'block', 	'field'=>'index', 			'params'=>array( 'reverse'=>false ) ),
					
					'Групы товаров'			=>	array( 'type'=>'multiselect', 'field'=>'product_groups', 			'params'=>array( 
																														 'list'=>$productsGroups, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['productGroups'], 
																														 'onChange'=>"" 
																														 ) ),
					
					
					'Свойства товара'		=>	array( 'type'=>'header'),
					
					'Текущая категория'		=>	array( 'type'=>'hidden',	'field'=>'prevent_cat_id', 	'params'=>array( 'field'=>"category", 'arr_field'=>'id' ) ),
					
					'Наличие свойств'		=>	array( 'type'=>'hidden', 	'field'=>'has_chars', 		'params'=>array( 'size'=>25, 'hold'=>'Has chars?' ) ),
					
					$cardItem['charsGroup']['name'] => array( 'type'=>'shopProductChars', 'field'=>'char', 'params'=>array('chars'=>$cardItem['chars'],'has_chars'=>$cardItem['has_chars']) ),
					
					//$cardItem['charsGroup']['name'] => array( 'type'=>'shopProductChars', 'field'=>'char', 'params'=>array('chars'=>$cardItem['chars'],0) ),
					 
					'clear-4'				=>	array( 'type'=>'clear' ),
					 
					'Описание товара'		=>	array( 'type'=>'redactor', 	'field'=>'details', 		'params'=>array(  ) ),
					 
					'Параметры доставки'	=>	array( 'type'=>'header'),
					
					
					'Ширина (мм)'			=>	array( 'type'=>'input', 	'field'=>'width', 			'params'=>array( 'size'=>15, 'hold'=>'Width' ) ),
					
					'Толщина (мм)'			=>	array( 'type'=>'input', 	'field'=>'depth', 			'params'=>array( 'size'=>15, 'hold'=>'Depth' ) ),
					
					'Высота (мм)'			=>	array( 'type'=>'input', 	'field'=>'height', 			'params'=>array( 'size'=>15, 'hold'=>'Height' ) ),
					
					'Вес (г)'				=>	array( 'type'=>'input', 	'field'=>'weight', 			'params'=>array( 'size'=>15, 'hold'=>'Weight' ) ),
					
					//'Параметры публикации'	=>	array( 'type'=>'header'),
					 
					'Начало публикации'		=>	array( 'type'=>'hidden', 		'field'=>'date_start', 		'params'=>array( ) ),
					 
					'Завершение публикации'	=>	array( 'type'=>'hidden', 		'field'=>'date_finish', 	'params'=>array( ) ),
					 
					'Мета теги'				=>	array( 'type'=>'header'),
					 
					'Title'					=>	array( 'type'=>'input', 	'field'=>'title', 			'params'=>array( 'size'=>50, 'hold'=>'Title', 'onchange'=>"" ) ),
					 
					'Keywords'				=>	array( 'type'=>'input', 	'field'=>'keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords', 'onchange'=>"" ) ),
					 
					'Description'			=>	array( 'type'=>'area', 		'field'=>'desc', 			'params'=>array( 'size'=>100, 'hold'=>'Description' ) ),
					 
					'Изображения'			=>	array( 'type'=>'header'),
					 
					'Выбор файлов'			=>	array( 'type'=>'image_mult','field'=>'images', 		'params'=>array( 'path'=>"/split/files/shop/products/", 'appTable'=>$appTable, 'id'=>$item_id, 'field'=>'file', 'method'=>'create' ) ),
					
					'Аксессуары'			=>	array( 'type'=>'header'),
					
					'Список аксессуаров'	=>	array( 'type'=>'prod_access_script', 'access_list'=>$access_list)
					
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createShopProductsItem", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма создания карточки товара ".((isset($params['copyItem']) && $params['copyItem'] > 0) ? "(Дубликат карточки #".$params['copyItem'].")" : "")."</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>