<?php session_start();

	/*	***************************	*/
	/*	OUTSOURCE-CODER				*/
	/*	--------------------------	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

	error_reporting(E_ALL);
	ini_set('display_errors', 0);

	require_once("../_defines.php"); 
	
	require_once("../_config.php");
	require_once("../library/db.php");

	$config_obj = new Config(); // GETS CONFIG PARAMS FOR DATABASE CONNECTION
	
	$db_user 	= $config_obj->configs['db']['user'];
	$db_pass 	= $config_obj->configs['db']['pass'];
	$db_host 	= $config_obj->configs['db']['host'];
	$db_name 	= $config_obj->configs['db']['name'];
	$db_encode 	= $config_obj->configs['db']['encode'];
	$db_pref 	= $config_obj->configs['db']['pref'];
	$secret_key  = $config_obj->configs['db']['secret_key'];	
	// Create Database class object
	
	$db = new Db($db_host, $db_name, $db_user, $db_pass, $db_encode, $db_pref);