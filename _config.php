<?php	// CONFIG CLASS
	
	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

class Config
{
    public $configs;
    function __construct(){
    	$this->configs = array(
            "sitename" => "PARQUET BOARD | STORE",
			"db" => array(
            	"host" 		=> "localhost",
				"name" 		=> "parquetb",
            	"user" 		=> "u_parquetb",
				"pass" 		=> "b9rQJryZ",
				"encode"	=> "utf8",
				"pref" 		=> "osc_",
				"secret_key"=> "nf6238*&^#$&f,swekf" // SECRET KEY FOR PASSWORD GENERATION
				),
			"copyright" => "&copy; 2015 Developed by outsource-coder.com"
        );
    }
    function __destruct(){}
}