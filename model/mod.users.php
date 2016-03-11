<?php // Users class

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

// exec_query ( query , once , update )

class Users
{
	protected $db;
	function __construct($db_obj)
	{
		$this->db = $db_obj;
	}

	public function getUserById($_user_id)
	{
		try{
			$query = "SELECT * FROM [pre]users WHERE `id`='$_user_id' LIMIT 1";
			return $this->db->exec_query($query,1,0);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}
	
	public function getAllUsers()
	{
		try{
			$query = "SELECT * FROM [pre]users WHERE 1 ORDER BY id LIMIT 1000";
			return $this->db->exec_query($query);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	function __destruct(){}
}