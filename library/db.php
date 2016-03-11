<?php	// DB CLASS

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/
class Db
{
	protected $db_connect;
	protected $host;
	protected $db_name;
	protected $user;
	protected $pass;
	protected $encode;
	protected $db_pref; // TABLES PREFIX 
	
    function __construct($_host,$_db_name,$_user,$_pass,$_encode,$_pref){
		$this->host = $_host;
		$this->db_name = $_db_name;
		$this->user = $_user;
		$this->pass = $_pass;
		$this->encode = $_encode;
		$this->db_pref = $_pref;
    }
	
	// MySQL CONNECTION
	
	public function db_access()
	{
		try{
			$this->db_connect = mysql_connect($this->host,$this->user,$this->pass);
			if($this->db_connect)
			{
				mysql_select_db($this->db_name,$this->db_connect);
				mysql_set_charset($this->encode,$this->db_connect);	
			}else{
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: info.php");
				exit();
			}
		}
		catch (Exception $e) {
			echo "Error!!! (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	// CLOSE MySQL CONNECTION
	
	public function db_destroy()
	{
		try
		{
			mysql_close($this->db_connect);
		}
		catch(Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	// THE FUNCTION RECEIVES AND EXECUTES QUERY
	
	/*	PARAMS:
		-	$once: if parameter is true, only one row of query is selected
		-   $update: if parameter is true, it is any query except for select
	*/
	
	public function exec_query($query,$once=false,$update=false)
	{
		try
		{
			$query = str_replace("[pre]",$this->db_pref,$query);
			
			$res = mysql_query($query,$this->db_connect);
			
			if($once)
			{
				return mysql_fetch_assoc($res);
			}
			elseif(!$update)
			{
				$result = array();
				
				while($row = mysql_fetch_assoc($res))
				{
					array_push($result,$row);
				}
				
				return $result;
			}
			else return $res;
		}
		catch(Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
			
		return FALSE;
	}
	
    function __destruct(){}
}