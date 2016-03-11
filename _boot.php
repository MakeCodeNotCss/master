<?php // BOOT FILE

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/
	
	require_once("_defines.php"); 
	
	require_once("_config.php");
	require_once("library/db.php");
	//require_once "library/helper.php";
	require_once 'assets/extentions/Mobile_Detect/Mobile_Detect.php';
	
	
	$detect = new Mobile_Detect;
 
	if ( $detect->isMobile() ) {
 		define("IS_MOBILE",true);
	}else{
		define("IS_MOBILE",false);
		}
		
	//if(IS_MOBILE) echo "[Mobile Version]";
	
	$config_obj = new Config(); // GETS CONFIG PARAMS FOR DATABASE CONNECTION
	
	$db_user 	= $config_obj->configs['db']['user'];
	$db_pass 	= $config_obj->configs['db']['pass'];
	$db_host 	= $config_obj->configs['db']['host'];
	$db_name 	= $config_obj->configs['db']['name'];
	$db_encode 	= $config_obj->configs['db']['encode'];
	$db_pref 	= $config_obj->configs['db']['pref'];
		
	// Create Database class object
	
	$db = new Db($db_host, $db_name, $db_user, $db_pass, $db_encode, $db_pref);
	
	// Database connection
	
	$db->db_access();