<?php
	//==================================================
	// My Orders controller
	//==================================================
	
	// $currPage ini from switcher

	$myOrders = $shopObj->getMyOrdersById(ACCOUNT_ID);

	//echo "<pre>"; print_r($myOrders); echo "</pre>"; exit();
	