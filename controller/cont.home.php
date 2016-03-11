<?php
	//==================================================
	// Home controller
	//==================================================
	
	// Helper
	
	$novelties = $shopObj->getNewProducts();

	$popular_prods = $shopObj->getPopularProducts();

	//echo "<pre>"; print_r($novelties); echo "</pre>"; exit();
	
	//==================================================
	
	