<?php session_start();

	/*	***************************	*/
	/*	OUTSOURCE-CODER				*/
	/*	--------------------------	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

	error_reporting(E_ALL);
	ini_set('display_errors', 0);

	require_once("_boot.php");
	require_once("_auth.php");

	include("_controller.php");
	// Closes the connection with database
	$db->db_destroy();
	
	require_once("_view.php");