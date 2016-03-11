<?php
	// Authorization Validation for all Ajax Requests except for LogIn & LogOut
	
	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 08.08.2015		*/
	/*	***************************	*/
	
if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'])
{
	define("ADMIN_ID",(int)$_SESSION['admin_id']);
	
	$_SESSION['admin_id'] = ADMIN_ID;
}else
{
	echo json_encode(array('status'=>'Fatal error','message'=>'Permision denied!'));
	exit();
}