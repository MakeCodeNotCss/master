<?php
	//==================================================
	// Shop Item controller
	//==================================================
	
	// $currPage ini from switcher

	$product_id = $product['id'];

	$cat_id = $product['cat_id'];

	$category=$shopObj->getCategoryById($cat_id);

	$categoryBreadcrumbs = $menuObj->rec_cat_tree( array(), $cat_id );

	$images = $shopObj->getProductImages($product_id);

	$inCartItem = $shopObj->getInCartItem(ACCOUNT_ID, $product_id);


	