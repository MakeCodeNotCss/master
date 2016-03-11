<?php
	//==================================================
	// Home controller
	//==================================================
	
	// Helper
	
	require_once "library/helper.php";
	$helper = new Helper($db);
	
	$user = $helper->getUserById(1);
	
	//==================================================
	
	// Users
	
	require_once("model/mod.users.php");
	$usersObj = new Users($db);
	
	$allUsers = $usersObj->getAllUsers();