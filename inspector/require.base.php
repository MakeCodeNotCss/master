<?php 
	//********************
	//** WEB INSPECTOR
	//********************
	
	error_reporting(E_ALL);
	ini_set('display_errors', 0);

	
	require_once "core/DB_Mysql.class.php";
	require_once "core/DB_MysqlStatement.class.php";
	require_once "core/DB_Result.class.php";
	
	require_once "objects/ObjectInterface.interface.php";
	
	//require_once "objects/Tmp.class.php";
	
	$db_user = "u_parquetb";
	$db_pass = "b9rQJryZ";
	$db_host = "localhost";
	$db_name = "parquetb";
	$db_code = "utf8";
	$db_pref = "osc_";
	
	$dbh = new DB_Mysql($db_user,$db_pass,$db_host,$db_name,$db_code,$db_pref);
	
	