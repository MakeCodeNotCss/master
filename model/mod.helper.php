<?php // Users class

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

// exec_query ( query , once , update )

class Helper
{
	protected $db;
	function __construct($db_obj)
	{
		$this->db = $db_obj;
	}

	public function send_letter($to_mail,$from,$subject_mail,$message_mail,$system="SUPPORT")
	{
		try
		{
			$date = date("d.m.y H:i");
			$message_date = "<p> </p><p>Date of send: ".$date."</p>";
			
			$to  = "<".$to_mail.">" ;

			$subject = $subject_mail; 

			$message = ' 
			<html> 
    			<head> 
        			<title>'.$system.'</title> 
    			</head> 
    			<body> 
        			'.$message_mail.'
    			</body> 
			</html>'; 

			$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
			$headers .= "From: ".$system." <".$from.">\r\n"; 
			//$headers .= "Bcc: ".$from."\r\n"; 

			if(mail($to, $subject, $message, $headers))
			{
				return true;
			}else{
				return false;
			} 
			
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	public function deformat_long_date($val,$plus_time=false)
		{
			$result = "";
			$monthes = array('','января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
			
			if(strtotime($val) > strtotime(date("d.m.Y",time())." 00:00:00"))
								{
									if(strtotime($val) > strtotime(date("d.m.Y",time()+86000)." 00:00:00"))
									{
										if(strtotime($val) < strtotime(date("d.m.Y",time()+(2*86000))." 00:00:00"))
										{
											$result = "Завтра, ".date("H:i",strtotime($val));
										}else{
																	$result = date("d",strtotime($val))." ".
																	$monthes[(int)date("m",strtotime($val))]." ".
																	date("Y",strtotime($val)).", ".
																	date("H:i",strtotime($val));
											}
									}else
									{
										$result = "Сегодня, ".date("H:i",strtotime($val));
									}
		
								}elseif(strtotime($val) < strtotime(date("d.m.Y",time())." 00:00:00") &&
										strtotime($val) > (strtotime(date("d.m.Y",time())." 00:00:00")-86400))
									{
										$result = "Вчера, ".date("H:i",strtotime($val));
									}
								else
									{
										$result = date("d",strtotime($val))." <small>".
																	$monthes[(int)date("m",strtotime($val))]."</small> ".
																	date("Y",strtotime($val));
										if($plus_time) $result .= ", ".date("H:i",strtotime($val));
									}
			
			return $result;
		}
	
	// Корректная подрезка строки
	function next_sub_str($str,$len)
	{
		return implode(array_slice(explode('<br>',wordwrap($str,$len,'<br>',false)),0,1));
	}
	
	// Функция правильной урезки строки по количеству символов
	public function cropStr($str, $size)
	{ 
  		return mb_substr($str,0,mb_strrpos(mb_substr($str,2,$size,'utf-8'),' ','utf-8'),'utf-8');
	}
	
	public function convertUrlToUtf($urlStr)
	{
		$utfStr	= utf8_decode(utf8_encode($urlStr));
		
		$utfStr = str_replace("%D1%91","ё",$utfStr);
		$utfStr = str_replace("%D1%94","є",$utfStr);
		$utfStr = str_replace("%D1%97","ї",$utfStr);
		$utfStr = str_replace("%D0%90","А",$utfStr);
		$utfStr = str_replace("%D0%91","Б",$utfStr);
		$utfStr = str_replace("%D0%92","В",$utfStr);
		$utfStr = str_replace("%D0%93","Г",$utfStr);
		$utfStr = str_replace("%D0%94","Д",$utfStr);
		$utfStr = str_replace("%D0%95","Е",$utfStr);
		$utfStr = str_replace("%D0%96","Ж",$utfStr);
		$utfStr = str_replace("%D0%97","З",$utfStr);
		$utfStr = str_replace("%D0%98","И",$utfStr);
		$utfStr = str_replace("%D0%99","Й",$utfStr);
		$utfStr = str_replace("%D0%9A","К",$utfStr);
		$utfStr = str_replace("%D0%9B","Л",$utfStr);
		$utfStr = str_replace("%D0%9C","М",$utfStr);
		$utfStr = str_replace("%D0%9D","Н",$utfStr);
		$utfStr = str_replace("%D0%9E","О",$utfStr);
		$utfStr = str_replace("%D0%9F","П",$utfStr);
		$utfStr = str_replace("%D0%A0","Р",$utfStr);
		
		$utfStr = str_replace("%D0%A1","С",$utfStr);
		$utfStr = str_replace("%D0%A2","Т",$utfStr);
		$utfStr = str_replace("%D0%A3","У",$utfStr);
		$utfStr = str_replace("%D0%A4","Ф",$utfStr);
		$utfStr = str_replace("%D0%A5","Х",$utfStr);
		$utfStr = str_replace("%D0%A6","Ц",$utfStr);
		$utfStr = str_replace("%D0%A7","Ч",$utfStr);
		$utfStr = str_replace("%D0%A8","Ш",$utfStr);
		$utfStr = str_replace("%D0%A9","Щ",$utfStr);
		$utfStr = str_replace("%D0%AA","Ъ",$utfStr);
		$utfStr = str_replace("%D0%AB","Ы",$utfStr);
		$utfStr = str_replace("%D0%AC","Ь",$utfStr);
		$utfStr = str_replace("%D0%AD","Є",$utfStr);
		$utfStr = str_replace("%D0%AE","Ю",$utfStr);
		$utfStr = str_replace("%D0%AF","Я",$utfStr);
		
		$utfStr = str_replace("%D0%B0","а",$utfStr);
		$utfStr = str_replace("%D0%B1","б",$utfStr);
		$utfStr = str_replace("%D0%B2","в",$utfStr);
		$utfStr = str_replace("%D0%B3","г",$utfStr);
		$utfStr = str_replace("%D0%B4","д",$utfStr);
		$utfStr = str_replace("%D0%B5","е",$utfStr);
		$utfStr = str_replace("%D0%B6","ж",$utfStr);
		$utfStr = str_replace("%D0%B7","з",$utfStr);
		$utfStr = str_replace("%D0%B8","и",$utfStr);
		$utfStr = str_replace("%D0%B9","й",$utfStr);
		$utfStr = str_replace("%D0%BA","к",$utfStr);
		$utfStr = str_replace("%D0%BB","л",$utfStr);
		$utfStr = str_replace("%D0%BC","м",$utfStr);
		$utfStr = str_replace("%D0%BD","н",$utfStr);
		$utfStr = str_replace("%D0%BE","о",$utfStr);
		$utfStr = str_replace("%D0%BF","п",$utfStr);
		$utfStr = str_replace("%D1%80","р",$utfStr);
		
		$utfStr = str_replace("%D1%81","с",$utfStr);
		$utfStr = str_replace("%D1%82","т",$utfStr);
		$utfStr = str_replace("%D1%83","у",$utfStr);
		$utfStr = str_replace("%D1%84","ф",$utfStr);
		$utfStr = str_replace("%D1%85","х",$utfStr);
		$utfStr = str_replace("%D1%86","ц",$utfStr);
		$utfStr = str_replace("%D1%87","ч",$utfStr);
		$utfStr = str_replace("%D1%88","ш",$utfStr);
		$utfStr = str_replace("%D1%89","щ",$utfStr);
		$utfStr = str_replace("%D1%8A","ъ",$utfStr);
		$utfStr = str_replace("%D1%8B","ы",$utfStr);
		$utfStr = str_replace("%D1%8C","ь",$utfStr);
		$utfStr = str_replace("%D1%8D","э",$utfStr);
		$utfStr = str_replace("%D1%8E","ю",$utfStr);
		$utfStr = str_replace("%D1%8F","я",$utfStr);
		
		$utfStr = str_replace("%20"," ",$utfStr);
		
		return $utfStr;
	}

	function __destruct(){}
}