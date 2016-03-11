<?php
	//==================================================
	// News Item controller
	//==================================================
	
	// $currPage ini from switcher
	
	

	$currentNew = $menuObj->getNewByAlias(LA);

	$currNewId = $currentNew['id'];

	$currComment = $menuObj->getArticleComments(LA);

	//echo "<pre>"; print_r($currComment); echo "</pre>"; exit();

	$rows = $db->exec_query('SELECT FOUND_ROWS() AS rows',1); 
	  
	$comm_count = $rows['rows']; // сохраняем общее количество товаров в категории




