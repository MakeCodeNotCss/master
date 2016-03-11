<?php
	//==================================================
	// Search Page controller
	//==================================================
	
	// $currPage ini from switcher


		$searchQ = $_POST['search'];
		$searchQ = strip_tags($searchQ);
		$searchQ = trim($searchQ);
		//$searchQ = substr($searchQ,0,20);
		$searchQ = preg_replace("/[^\w\x7F-\xFF\s]/", "", $searchQ);
		$searchQuery = $menuObj->getSearchResults($searchQ);

		$numResults = mysql_num_rows($searchQuery);

		//echo "<pre>"; print_r($searchQuery); echo "</pre>"; exit();

	