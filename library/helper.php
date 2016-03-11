<?php
/* Author: Sivkovich Maxim */
class Helper
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
	
	public function test(){return "Hello World!";}
	
	
	public function send_letter($to_mail,$from,$subject_mail,$message_mail,$system="OUTSOURCE-CODER")
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
			$headers .= "Bcc: ".$from."\r\n"; 

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
	
	public function send_letter_with_file($to_mail,$from,$subject_mail,$message_mail,$system="OUTSOURCE-CODER",$file=false)
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
			$headers .= "Bcc: ".$from."\r\n"; 

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
	
	// VS File
	
	public function sendLetterVsAttachment($options = array('to'=>'','from'=>'','subject'=>'','message'=>'','attachment'=>'','att_path'=>''))
	{
		$user_email = $options['from'];
		$to = $options['to'];

		$subject = $options['subject']; 

		$message = $options['message']; 

		$filename = $options['attachment'];
		
		$boundary = "--".md5(uniqid(time())); 
		// генерируем разделитель

		$mailheaders = "MIME-Version: 1.0;\r\n"; 
		$mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
		// разделитель указывается в заголовке в параметре boundary 

		$mailheaders .= "From: $user_email <$user_email>\r\n"; 
		$mailheaders .= "Reply-To: $user_email\r\n"; 

		$multipart = "--$boundary\r\n"; 
		$multipart .= "Content-Type: text/html; charset=utf-8\r\n"; // windows-1251
		$multipart .= "Content-Transfer-Encoding: base64\r\n";    
		$multipart .= "\r\n";
		$multipart .=  chunk_split(base64_encode(iconv("utf8", "utf-8", $message))); // windows-1251
 
 		if(is_array($filename))
		{
			foreach($filename as $ffname)
			{
				$filepath = $options['att_path'].$ffname;
				
				// Закачиваем файл 
    			$fp = fopen($filepath,"r"); 
        		if (!$fp) 
        		{ 
        		    print "Can't open file."; 
        		    exit(); 
        		} 
				$file = fread($fp, filesize($filepath)); 
				fclose($fp); 
				// чтение файла
				
				$message_part = "\r\n--$boundary\r\n"; 
				$message_part .= "Content-Type: application/octet-stream; name=\"$ffname\"\r\n";  
				$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
				$message_part .= "Content-Disposition: attachment; filename=\"$ffname\"\r\n"; 
				$message_part .= "\r\n";
				$message_part .= chunk_split(base64_encode($file))."\n";
				//$message_part .= "\r\n--$boundary--\r\n";
				// второй частью прикрепляем файл, можно прикрепить два и более файла

				$multipart .= $message_part;
			}
		}else
		{
			$filepath = $options['att_path'].$filename;
 
			// Закачиваем файл 
    		$fp = fopen($filepath,"r"); 
        	if (!$fp) 
        	{ 
        	    print "Не удается открыть файл."; 
        	    exit(); 
        	} 
			$file = fread($fp, filesize($filepath)); 
			fclose($fp); 
			// чтение файла
	
			$message_part = "\r\n--$boundary\r\n"; 
			$message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";  
			$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
			$message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n"; 
			$message_part .= "\r\n";
			$message_part .= chunk_split(base64_encode($file));
			$message_part .= "\r\n--$boundary--\r\n";
			// второй частью прикрепляем файл, можно прикрепить два и более файла

			$multipart .= $message_part;
		}

		if(mail($to,$subject,$multipart,$mailheaders))
		{
			return true;
		}else
		{
			return false;
		}
		// отправляем письмо 

		echo "</span>";

		return false;
	} // end of send letter vs attachment
	
	// Resize img
	public function mtvc_ChangeImageSize($filename, $savepath, $ext, $neww, $newh)
  	{
		try{
	 		$idata=getimagesize($filename);
     		$oldw=$idata[0];
     		$oldh=$idata[1];
     		$ext = strtolower($ext);
     		if($ext=='jpg' or $ext=='jpeg')
    		{ 
				$im=@imagecreatefromjpeg($filename);
      			if($im)
      			{
					if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
        			else(double)$ratio=(double)$oldh/ (double)$newh;
        			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
        			$white = ImageColorAllocate($dest, 255,255,255);
        			imagefill($dest, 1, 1, $white);
        			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
					imageJPeG($dest,$savepath);
        			imageDestroy($im);
        			imageDestroy($dest);
        			return true;
      			}
			}elseif($ext=='gif')
    		{
				$im=imagecreatefromgif($filename);
      			if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
      			else(double)$ratio=(double)$oldh/ (double)$newh;
      			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
      			$white = ImageColorAllocate($dest, 255,255,255);
      			imagefill($dest, 1, 1, $white);
      			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
      			imagegif($dest,$savepath);
      			imageDestroy($im);
      			imageDestroy($dest);
      			return true;
			}elseif($ext=='png')
    		{
				$im=imagecreatefrompng($filename);
      			if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
      			else (double)$ratio=(double)$oldh/ (double)$newh;
      			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
      			$white = ImageColorAllocate($dest, 255,255,255);
      			imagefill($dest, 1, 1, $white);
      			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
      			imagepng($dest,$savepath);
      			imageDestroy($im);
      			imageDestroy($dest);
      			return true;
			}
			return false;
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
  	}

	// get file extention
	public function mtvc_get_file_ext($filename)
	{
		try{
			$test = $filename;
			$result = "";
			$cnt = 0;
			while($cnt < strlen($test))
			{
				if($test[strlen($test)-$cnt] == '.'){break;}
				$result .= $test[strlen($test)-$cnt];
				$cnt++;
			}
			$result = strrev($result);
			return $result;
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	// Save $_FILES file
	public function mtvc_add_files_file($arr,$multi = false)
	{
	/*	array(
				'path'			=>"Путь к каталогу",
				'name'			=>"имя картинки [1-5]",
				'pre'			=>"приставка к имени файла",
				'size'			=>"допустимый размер в Мб",
				'rule'			=>"тип правила проверки размерности [0-4]",
				'max_w'			=>"максимальная ширина",
				'max_h'			=>"максимальная высота",
				'files'			=>"имя $_FILES",
				'resize_path'	=>"путь к папке превью mid | 0",
				'resize_w'		=>"ширина mid фалйа | 0",
				'resize_h'		=>"высота mid фалйа | 0",
				'resize_path_2'	=>"путь к папке превью min | 0",
				'resize_w_2'	=>"ширина min фалйа | 0",
				'resize_h_2'	=>"высота mid фалйа | 0"
			  ) */
		/* 1  */ $path			= $arr['path'];				// путь к каталогу
		/* 2  */ $name			= $arr['name'];				// имя картинки: ->
									// 1 - оставить
									// 2 - сгенерировать используя текущую дату и время + то что было
									// 3 - сгенерировать используя текущую дату и время
									// 4 - использовать приставку (пункт 4)
									// 5 - приставка из п.4 + сгенерированное имя из даты и времени
								
		/* 3  */ $pre			= $arr['pre'];				// приставка имени файла
		/* 4  */ $size			= $arr['size'];				// допустимый размер файла в Mb
		/* 5  */ $rule			= (int)$arr['rule'];				// Тип правила проверки на правильность расзмерности файла: ->
									// 0 - без проверки
									// 1 - учитывать пункт 6 и 7
									// 2 - строго квадрат
									// 3 - строго учитывать равность пункта 6 и 7
									// 4 - учтение пропорции [W:H] между пунктами 6 и 7
								
		/* 6  */ $max_w				= (int)$arr['max_w'];			// максимальная ширина
		/* 7  */ $max_h				= (int)$arr['max_h'];			// максимальная высота
		/* 8  */ $files				= $arr['files'];			// имя $_FILES
		/* 9  */ $resize_path 		= $arr['resize_path'];		// путь к папке превью mid | 0
		/* 10 */ $resize_w			= $arr['resize_w'];			// ширина mid фалйа | 0
		/* 11 */ $resize_h			= $arr['resize_h'];			// высота mid фалйа | 0
		/* 12 */ $resize_path_2		= $arr['resize_path_2'];	// путь к папке превью min | 0
		/* 13 */ $resize_w_2		= $arr['resize_w_2'];		// ширина min фалйа | 0
		/* 14 */ $resize_h_2		= $arr['resize_h_2'];		// высота mid фалйа | 0
		
	if($name < 1 || $name > 5){$name = 1;}
	if($rule < 0 || $rule > 4){$rule = 0;}
	
	$filepath = $path;
	if(!$multi)$filename = $_FILES[$files]['name'];else $filename = $_FILES[$files]['name'][$multi];
	
	$buf_filename = $filename;
	
	$file_extension = $this->mtvc_get_file_ext($filename);
	
	if($name == 1){$filename = $buf_filename;}
	if($name == 2){$filename = date('YmdHis').rand(100,1000)."_".$buf_filename;}
	if($name == 3){$filename = date('YmdHis').rand(100,1000).'.'.$file_extension;}
	if($name == 4){$filename = $pre.'.'.$file_extension;}
	if($name == 5){$filename = $pre.date('YmdHis').rand(100,1000).'.'.$file_extension;}
	
	$filepath .= $filename;
	
	if($resize_path != "0"){$resize_path .= $resize_w."x".$resize_h."_".$filename;}
	if($resize_path_2 != "0"){$resize_path_2 .= $resize_w_2."x".$resize_h_2."_".$filename;}
	
	if(!$multi)$buf_size = $_FILES[$files]['size']; else $buf_size = $_FILES[$files]['size'][$multi];
	if(!$multi)$buf_tmp_name = $_FILES[$files]['tmp_name']; else $buf_tmp_name = $_FILES[$files]['tmp_name'][$multi];
	
	if($buf_size != 0 && $buf_size<=1024000*$size)
	{
		if(move_uploaded_file($buf_tmp_name, $filepath))
		{
			$size = getimagesize($filepath);
			if($rule == 0)
			{
				if($resize_path != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
				if($resize_path_2 != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
				return $filename;
			}
			if($rule == 1)
			{
				if($size[0] <= $max_w && $size[1] <= $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>File is too large: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 2)
			{
				if($size[0] == $size[1])
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>File width must equal file height.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 3)
			{
				if($size[0] == $max_w && $size[1] == $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>File must be: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 4)
			{
				if( ($size[0]/$max_w) == ($size[1]/$max_h) )
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $size[0], $size[1]);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $size[0], $size[1]);}
					return $filename;
				}elseif($resize_h_2 == 1)
				{
					if( ($size[1]/$max_w) == ($size[0]/$max_h) )
					{
						if($resize_path != "0"){
							$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $size[0], $size[1]);}
						if($resize_path_2 != "0"){
							$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $size[0], $size[1]);}
						return $filename;
					}
				}else
				{
					echo("<p class='fail'>File must be: ".$max_w.":".$max_h.".</p>");
					unlink($filepath);
					return false;
				}
			}
		}else
		{
			echo("<p class='fail'>File can't be save by path: ".$filepath.". Please choose another path.</p>");
			return false;
		}
	}else
	{
		echo("<p class='fail'>File size more than: ".$size." Mb.</p>");
		return false;
	}
	}
	
	// Save MULTI $_FILES[multiple] files
	public function mtvc_add_files_file_miltiple($arr)
	{
		$result_arr = array();
		foreach($_FILES[$arr['files']]['name'] as $multi_cnt => $multi_cur_name)
		{
		/* 1  */ $path			= $arr['path'];				// путь к каталогу
		/* 2  */ $name			= $arr['name'];				// имя картинки: ->
									// 1 - оставить
									// 2 - сгенерировать используя текущую дату и время + то что было
									// 3 - сгенерировать используя текущую дату и время
									// 4 - использовать приставку (пункт 4)
									// 5 - приставка из п.4 + сгенерированное имя из даты и времени
								
		/* 3  */ $pre			= $arr['pre'];				// приставка имени файла
		/* 4  */ $size			= $arr['size'];				// допустимый размер файла в Mb
		/* 5  */ $rule			= $arr['rule'];				// Тип правила проверки на правильность расзмерности файла: ->
									// 0 - без проверки
									// 1 - учитывать пункт 6 и 7
									// 2 - строго квадрат
									// 3 - строго учитывать равность пункта 6 и 7
								
		/* 6  */ $max_w				= $arr['max_w'];			// максимальная ширина
		/* 7  */ $max_h				= $arr['max_h'];			// максимальная высота
		/* 8  */ $files				= $arr['files'];			// имя $_FILES
		/* 9  */ $resize_path 		= $arr['resize_path'];		// путь к папке превью mid | 0
		/* 10 */ $resize_w			= $arr['resize_w'];			// ширина mid фалйа | 0
		/* 11 */ $resize_h			= $arr['resize_h'];			// высота mid фалйа | 0
		/* 12 */ $resize_path_2		= $arr['resize_path_2'];	// путь к папке превью min | 0
		/* 13 */ $resize_w_2		= $arr['resize_w_2'];		// ширина min фалйа | 0
		/* 14 */ $resize_h_2		= $arr['resize_h_2'];		// высота mid фалйа | 0
		
	if($name < 1 || $name > 5){$name = 1;}
	if($rule < 0 || $rule > 3){$rule = 0;}
	
	$filepath = $path;
	
	//echo '<pre>files == '; print_r($_FILES[$files]); echo '</pre>';
	
	$filename = $_FILES[$files]['name'][$multi_cnt];
	
	$file_extension = $this->mtvc_get_file_ext($filename);
	
	if($name == 1){$filename = $_FILES[$files]['name'][$multi_cnt];}
	if($name == 2){$filename = date('YmdHis').rand(100,1000)."_".$_FILES[$files]['name'][$multi_cnt];}
	if($name == 3){$filename = date('YmdHis').rand(100,1000).'.'.$file_extension;}
	if($name == 4){$filename = $pre.'-'.rand(1,1000).'.'.$file_extension;}
	if($name == 5){$filename = $pre.date('YmdHis').rand(100,1000).'.'.$file_extension;}
	
	$filepath =  $path.$filename;
	
	//echo '<br>MULTI PATH: '.$filepath.'<br>';
	
	if($resize_path != "0"){$resize_path .= $resize_w."x".$resize_h."_".$filename;}
	if($resize_path_2 != "0"){$resize_path_2 .= $resize_w_2."x".$resize_h_2."_".$filename;}
	
	if($_FILES[$files]['size'][$multi_cnt] != 0 && $_FILES[$files]['size'][$multi_cnt]<=1024000*$size)
	{
		if(move_uploaded_file($_FILES[$files]['tmp_name'][$multi_cnt], $filepath))
		{
			$size = getimagesize($filepath);
			if($rule == 0)
			{
				if($resize_path != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
				if($resize_path_2 != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
				array_push($result_arr,$filename);
			}
			if($rule == 1)
			{
				if($size[0] <= $max_w && $size[1] <= $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл превышает допустимый размер: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
			if($rule == 2)
			{
				if($size[0] == $size[1])
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет правилу: ширина должна быть ровна высоте.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
			if($rule == 3)
			{
				if($size[0] == $max_w && $size[1] == $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет заданым параметрам: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
		}else
		{
			echo("<p class='fail'>Файл не может быть сохранён по пути: ".$filepath.". Укажите другой путь или проверьте права доступа директории на запись.</p>");
			array_push($result_arr,'fail');
		}
	}else
	{
		echo("<p class='fail'>Файл превышает допустимый размер: ".$size." Mb.</p>");
		array_push($result_arr,'fail');
	}
	
	} // end foreach multi name
	return $result_arr;
	}
	
	// remove directory
	public function mtvc_RemoveDir($path)
	{
		if(file_exists($path) && is_dir($path))
	{
		$dirHandle = opendir($path);
		while (false !== ($file = readdir($dirHandle))) 
		{
			if ($file!='.' && $file!='..') // исключаем папки с названием '.' и '..' 
			{
				$tmpPath=$path.'/'.$file;
				//chmod($tmpPath, 0777);
				
				if (is_dir($tmpPath))
	  			{  // если папка
					$this->mtvc_RemoveDir($tmpPath);
			   	} 
	  			else 
	  			{ 
	  				if(file_exists($tmpPath))
					{
						// удаляем файл 
	  					unlink($tmpPath);
					}
	  			}
			}
		}
		closedir($dirHandle);
		
		// удаляем текущую папку
		if(file_exists($path))
		{
			rmdir($path);
		}
	}
	else
	{
		//echo "Удаляемой папки не существует или это файл!";
	}
	}
	
	// Метод рекурсивно считывает содержимое каталога и копирует его по указанному пути
	public function mtvc_Read_and_Copy_data_from_dir($path2dir,$copypath)
	{
		try
		{
			$d = dir ($path2dir); 
 
    		while (false !== ($entry = $d->read()))
			{ 
 				//echo '<br>ENTRY = '.$entry.'<br>';
        		if ($entry!='.' && $entry!='..' && $entry!='' )
				{
            		$all_path = $path2dir.$entry;
					$all_copypath = $copypath.$entry;
					if(!is_file($all_path)){
											mkdir($all_copypath,0777);
											}
            		$new_path_arr = $this->mtvc_Read_and_Copy_data_helper($all_path, $all_copypath, is_file($all_path));
			
					$new_path = $new_path_arr[0];
					$new_copypath = $new_path_arr[1];
 
            		if (!is_file($all_path))
					{
                		//echo "<br>NEW path = ".$new_path."<br>";
						if (!$this->mtvc_Read_and_Copy_data_from_dir($new_path,$new_copypath))
						{
                    		return false;
                		}
            		}
        		}
    		} // end while 
 
    		return true;
			
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	// Метод являеться вспомагательным для метода mtvc_Read_and_Copy_data_from_dir (копирует файлы и обновляет пути)
	public function mtvc_Read_and_Copy_data_helper($path2file, $copypath, $is_file = true)
	{
		try
		{
			if ($is_file)
			{ 
        		# выполняем операцию над файлом
        		//echo "FILE = ".$path2file."<br>"; 
				//chmod($path2file,0777);
				copy($path2file,$copypath);
				}else{ 
        				# выполняем операцию над папкой
        				$path2file = $path2file.'/';
						$copypath = $copypath."/"; 
						
        				//echo "<br>FOLDER = ".$path2file."<br>"; 
        				//chmod($path2dir,0777);
						}
				
				return array($path2file,$copypath);
		
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}

		public function deformat_long_date($val,$plus_time=false)
		{
			$result = "";
			$monthes = array('','января','февряля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
			
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

			function next_sub_str($str,$len)
	{
		return implode(array_slice(explode('<br>',wordwrap($str,$len,'<br>',false)),0,1));
	}
	
	function __destruct(){}
}