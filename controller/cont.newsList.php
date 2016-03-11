<?php
	//==================================================
	// Newslist controller
	//==================================================



	$f_pag_lim = 5; // Количество новостей на странице

	$f_pag_size = 3; // Максимальное количество отображаемых страниц в пагинации

	$f_page_num = (isset($_GET['page']) ? (int)$_GET['page'] : 1); // Текущая страница пагинации

	$f_sort = (isset($_GET['sort']) ? strip_tags($_GET['sort']) : "id"); // Колонка, по которой делаем сортировку

	if(isset($_GET['desc']) && $_GET['desc']=="desc") $f_sort .= " DESC "; // Направление сортировки: убывающая/возрастающая

	
	$newsList = $menuObj->getAllNewsPag($cat_id, $f_page_num, $f_pag_lim); // Список товаров на странице

	//print_r($newsList);

	
	$rows = $db->exec_query('SELECT FOUND_ROWS() AS rows',1); // Запрос на глобальное количество новостей в категории
	  
	$f_total_rows = $rows['rows']; // сохраняем общее количество новостей в категории

	$f_pages_count = ceil($f_total_rows/$f_pag_lim); // определяем количество страниц в пагинации
