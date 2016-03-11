<?php 

	// CONTROLLER

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

	
	$meta_title	= $config_obj->configs['sitename'];
	$meta_keys	= $config_obj->configs['sitename'];
	$meta_desc	= $config_obj->configs['sitename'];
	
	$styleLink	= CSS_PATH.(IS_MOBILE ? "mobile.css" : "style.css");
	
	//==================================================
	// Request URI
	//==================================================
	
	$ri_trim = trim($_SERVER['REQUEST_URI'],'/\\');
	
	$ri	= explode("/",$ri_trim);

	if(!$ri){
		die("sfddfde");
		header("Location: ".RS."404/");
		exit();
	}else{
		
		if(count($ri) > 1)
		{
			if($ri[0]==PROJECT_NAME) array_shift($ri);
		}
		
		if(	strpos($ri[0]	, "index.php") 	|| 
			trim($ri[0])	== "" 			|| 
			$ri[0]			==PROJECT_NAME
		)
		{ 
			$ri[0] = "home";
		}
		
		define("FA",$ri[0]);
			
		define("LA",(!$_GET ? ($ri[count($ri)-1]) : ($ri[count($ri)-2])));
	}

	// Default actions

	$self_link = RS;

	foreach($ri as $ri_item)
	{
		if($ri_item[0]=='?') break;

		$self_link .= $ri_item."/";
	}

	define("SELF_LINK",$self_link);

	

	require_once("model/mod.menu.php");


	$menuObj = new Menu($db); // Create Class Object

	$info = $menuObj->getCompanyInformation();

	//echo "<pre>"; print_r($info); echo "</pre>"; exit();
	
	$topMenu = $menuObj->getAllMenu(); // run function getAllMenu | return array of items from Table osc_menu


	$ac_tree = $menuObj->getCatalogParents();

	//echo "<pre>"; print_r($ac_tree); echo "</pre>"; exit();

	$curr_cat_id = 0;

	$megaMenuHTML = $menuObj->convTreeToHTML($ac_tree, 0, $curr_cat_id);


	require_once("model/mod.shop.php");

	$shopObj = new Shop($db);

	$novelties = $shopObj->getNewProducts();

	$cartProdList = $shopObj->getInCartProducts(ACCOUNT_ID);

	$cartTotals = $shopObj->countCartSumm(ACCOUNT_ID);


	//echo "<pre>"; print_r($cartProdList); echo "</pre>"; exit();


	require_once("model/mod.helper.php");

	$helpObj = new Helper($db);

	
	//==================================================
	// Switcher
	//==================================================
	
	require_once("_switcher.php");
	
	//==================================================
	// Controller
	//==================================================
	
	if(file_exists("controller/cont.".PAGE_VIEW.".php")) {
		require_once("controller/cont.".PAGE_VIEW.".php");
	}else{
		die("Controller <b>".PAGE_VIEW."</b> NOT found");
	}

