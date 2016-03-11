<?php 

require_once("_ajax_boot.php");

// Database connection
	
$db->db_access();

// Prepare Response Array

$data = array('status'=>'failed', 'resultHtml'=>'<cetner>There are no products were found.</center>', 'filter_chars'=>array());


//====================================================================================================
// Include models

require_once("../model/mod.shop.php");

$shopObj = new Shop($db);

//====================================================================================================
// POST PARAMS

$filters = ""; // Фильтры к запросу в БД

$cat_id = (int)$_POST['cat_id'];


$_SESSION['prods_filter'] = array();
$_SESSION['prods_filter'][$cat_id] = array();

$curr_link = strip_tags(trim($_POST['curr_link']));

$price_range 	= $_POST['range_3'];
$prod_width 	= (isset($_POST['width']) ? $_POST['width'] : array());
$prod_height 	= (isset($_POST['height']) ? $_POST['height'] : array());
$prod_depth 	= (isset($_POST['depth']) ? $_POST['depth'] : array());

$price_min  = 0;
$price_max  = 100000;

$price_range_arr = explode(";",$price_range);

if(count($price_range_arr)==2)
{
	$price_min = (int)$price_range_arr[0];
	$price_max = (int)$price_range_arr[1];

	if($price_max > $price_min)
	{
		$filters .= " AND (M.price >= $price_min AND M.price <= $price_max) ";

		$_SESSION['prods_filter'][$cat_id]['price'] = array('min'=>$price_min, 'max'=>$price_max);
	}
}

// FILTER PARAMS
  
	$f_pag_lim = 9; // Количество товаров на странице

	$f_pag_size = 5; // Максимальное количество отображаемых страниц в пагинации

	$f_page_num = 1; // Текущая страница пагинации

	$f_sort = (isset($_POST['sort']) ? strip_tags($_POST['sort']) : "id"); // Колонка, по которой делаем сортировку

	if(isset($_POST['desc']) && $_POST['desc']=="desc") $f_sort .= " DESC "; // Направление сортировки: убывающая/возрастающая


	$post_filter = (isset($_POST['filter']) ? $_POST['filter'] :  array());

	$filter_joins = "";

	if($prod_width)
	{
			$filters .= " AND (";
			$cnt = 0;
				foreach($prod_width as $width)
				{
					$cnt++;
					if($cnt > 1) $filters .= " OR ";
					$wvalues = str_replace("'","\'",$width);
					$filters .= " M.width='$wvalues'";
				}
			$filters .= ") ";

		
	}
	elseif($prod_height) 
	{
			$filters .= " AND (";
			$icnt = 0;
				foreach($prod_height as $height)
				{
					$icnt++;
					if($icnt > 1) $filters .= " OR ";
					$hvalues = str_replace("'","\'",$height);
					$filters .= " M.height='$hvalues'";
				}
			$filters .= ") ";
	}
	elseif($prod_depth) 
	{
			$filters .= " AND (";
			$iicnt = 0;
				foreach($prod_depth as $depth)
				{
					$iicnt++;
					if($iicnt > 1) $filters .= " OR ";
					$dvalues = str_replace("'","\'",$depth);
					$filters .= " M.depth='$dvalues'";
				}
			$filters .= ") ";
	}


	foreach($post_filter as $char_id => $char_values)
	{
		if($char_values)
		{
			$_SESSION['prods_filter'][$cat_id][$char_id] = $char_values;

			$filter_joins .= " LEFT JOIN [pre]shop_chars_prod_ref as CPR".$char_id." ON CPR".$char_id.".prod_id=M.id ";

			$filters .= " AND CPR".$char_id.".char_id=$char_id AND (";
				$v_cnt = 0;
				 foreach($char_values as $value)
				{
					$v_cnt++;
					if($v_cnt > 1) $filters .= " OR ";

					$_v = str_replace("'","\'",$value);
					$filters .= " CPR".$char_id.".value='$_v' ";
				} 
				$filters .= ") ";
		}
	}
	

	ob_start();

	//$filters = "";
	//$filter_joins = "";
	$prodList = $shopObj->getCategoryProductsById($cat_id, $f_page_num, $f_pag_lim, $filters, $filter_joins); // Список товаров на странице



	// COUNT CHARS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	$filter_group_id = (int)$_POST['filter_group_id'];

	$charsList = $shopObj->getCategoryFilterChars($filter_group_id);

	foreach($charsList as $i => $char)
	{
		$char_id = $char['id'];
		$charsList[$i]['values_count'] = $shopObj->countFilterValues($cat_id, $char_id, $filters, $filter_joins);  // Количество товаров в фильтрах
	}

	$data['filter_chars'] = $charsList;

	//echo "<pre>"; print_r($charsList); echo "</pre>";

	$rows = $db->exec_query('SELECT FOUND_ROWS() AS rows',1); // Запрос на глобальное количество товаров в категории
	  
	$f_total_rows = $rows['rows']; // сохраняем общее количество товаров в категории

	$f_pages_count = ceil($f_total_rows/$f_pag_lim); // определяем количество страниц в пагинации

	include("../templates/".TEMPLATE_NAME."/view/shop/shopCatProdList.php");
	include("../templates/".TEMPLATE_NAME."/view/shop/shopCatProdPagination.php");

	//echo "<pre>"; print_r($prodList); echo "</pre>";

	$data['resultHtml'] = ob_get_contents();

	ob_end_clean();

	

//====================================================================================================
// Closes the connection with database

$db->db_destroy();

// Return Json Array


echo json_encode($data);