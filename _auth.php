<?php // AUTHORIZATION

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/
	
	function gen_rand_id()
	{
		return ( time() + rand( rand(10000,50000), rand(50000,99000) ) );
	}
	
	//=====================================================================================================
	
	$userData = array();
	
	//=====================================================================================================
	// Authorization check
	
	if(isset($_SESSION['account_id']) && $_SESSION['account_id'])
	{
		$query = "SELECT * FROM [pre]users WHERE id = ".((int)$_SESSION['account_id'])." LIMIT 1";
		
		$userData = $db->exec_query($query,1);
		
		if($userData)
		{
			define("ACCOUNT_ID",(int)$userData['id']);
		}else
		{
			define("ACCOUNT_ID",$_SESSION['account_id']);
		}
	}else
	{
		define("ACCOUNT_ID",gen_rand_id());
	}
	
	//=====================================================================================================

	$old_session_id = $_SESSION['account_id'];

	$_SESSION['account_id'] = $userData['id'];
	
	$_SESSION['account_id'] = ACCOUNT_ID;
	
	//=====================================================================================================
	
	if($userData)
	{
		define("ONLINE",TRUE);
	}else
	{
		define("ONLINE",FALSE);
	}