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


	function filters_calc_query($post_filter, $group_char_id=0, $cat_id=0)
	{
		$r = array('filter_joins'=>"",'filters'=>"");

		foreach($post_filter as $char_id => $char_values)
		{
			if($char_id == $group_char_id) continue;

			if($char_values)
			{
				if(!$group_char_id) $_SESSION['prods_filter'][$cat_id][$char_id] = $char_values;

				$r['filter_joins'] .= " LEFT JOIN [pre]shop_chars_prod_ref as CPR".$char_id." ON CPR".$char_id.".prod_id=M.id ";

				$r['filters'] .= " AND CPR".$char_id.".char_id=$char_id AND (";

					$v_cnt = 0;

					 foreach($char_values as $value)
					{
						$v_cnt++;
						if($v_cnt > 1) 
							{
								$r['filters'] .= " OR ";
							}

						$_v = str_replace("'","\'",$value);
						$r['filters'] .= " CPR".$char_id.".value='$_v' ";
					} 
					$r['filters'] .= ") ";
			}
		}

		return $r;
	}

	$filter_result = filters_calc_query($post_filter, 0, $cat_id);
	$filter_joins_1 = $filter_joins	. $filter_result['filter_joins'];
	$filters_1 		= $filters 		. $filter_result['filters'];
	

	ob_start();

	//$filters = "";
	//$filter_joins = "";
	$prodList = $shopObj->getCategoryProductsById($cat_id, $f_page_num, $f_pag_lim, $filters_1, $filter_joins_1); // Список товаров на странице



	$rows = $db->exec_query('SELECT FOUND_ROWS() AS rows',1); // Запрос на глобальное количество товаров в категории
	  
	$f_total_rows = $rows['rows']; // сохраняем общее количество товаров в категории

	$f_pages_count = ceil($f_total_rows/$f_pag_lim); // определяем количество страниц в пагинации

	//=========================================================================================================================

	// COUNT CHARS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	$filter_group_id = (int)$_POST['filter_group_id'];

	$charsList = $shopObj->getCategoryFilterChars($filter_group_id);

	foreach($charsList as $i => $char)
	{
		$char_id = $char['id'];

		$filter_result = filters_calc_query($post_filter, $char_id, $cat_id);

		$filters_2 		= $filters 			. $filter_result['filters'];
		$filter_joins_2 = $filter_joins		. $filter_result['filter_joins'];

		$charsList[$i]['values_count'] = $shopObj->countFilterValues($cat_id, $char_id, $filters_2, $filter_joins_2);  // Количество товаров в фильтрах

		foreach($charsList[$i]['values_count'] as $j => $j_item)
		{
			$charsList[$i]['values_count'][$j]['ref_md5'] = md5( $char_id . trim(mb_strtolower($j_item['value'])) );
		}
	}

	$data['filter_chars'] = $charsList;

	//echo "<pre>"; print_r($data['filter_chars']); echo "</pre>";

	include("../templates/".TEMPLATE_NAME."/view/shop/shopCatProdList.php");
	include("../templates/".TEMPLATE_NAME."/view/shop/shopCatProdPagination.php");

	//echo "<pre>"; print_r($prodList); echo "</pre>";

	//echo "<pre>"; print_r($_SESSION); echo "</pre>";

	$data['resultHtml'] = ob_get_contents();

	ob_end_clean();

	

//====================================================================================================
// Closes the connection with database

$db->db_destroy();

// Return Json Array


echo json_encode($data);