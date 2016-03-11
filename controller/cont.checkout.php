<?php
	//==================================================
	// Checkout Page controller
	//==================================================
	
	// $currPage ini from switcher

	$prodsInCart = $shopObj->getInCartProducts(ACCOUNT_ID);
	
	$payment = $menuObj->getPayMethods();

	$delivery = $menuObj->getDeliveryMethods();

	$np_cities = $shopObj->getCitiesList();

	$info = $menuObj->getCompanyInformation();

	//echo "<pre>"; print_r($info); echo "</pre>"; exit();
