<?php require_once("_ajax_boot.php");

// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error', 'errorID'=>'0', 'accountID'=>0, 'couponID'=>0, 'err1'=>0, 'err2'=>0, 'err3'=>0, 'err4'=>0, 'err5'=>0, 'err6'=>0);

	// FUNCTIONS 
	
	function strToHex($string){
    $hex = "";
    for ($i=0; $i<strlen($string); $i++){
	
	    $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .=  substr('0'.$hexCode, -2);
    }
    return $hex;
	}
	
	function check_ivrit($strArr)
	{
		if(count($strArr) < 2) return false;
		
		$result = true;
		$ivrit = array('d790','d791','d792','d793','d794','d795','d796','d797','d798','d799','d79a','d79b','d79c','d79d','d79e','d79f','d7a0','d7a1','d7a2','d7a3','d7a4','d7a5','d7a6','d7a7','d7a8','d7a9','d7aa', 'd7b0','d7b1','d7b2','d7b3','d7b4');
		
		$cnt = 0;
		foreach($strArr as $hexItem)
		{
			$cnt++;
			if($cnt==1) continue;
			if(!in_array('d7'.$hexItem,$ivrit)){
				$result = false;
				break;
				}
		}
		
		return $result;
	}

	// GET POST DATA
	
	$_firstname = $_POST['firstname'];
	$_lastname 	= $_POST['lastname'];
	$_phone 	= $_POST['phone'];
	$_email 	= $_POST['email'];
	$_id 		= $_POST['id'];
	
	$_agree 	= (isset($_POST['agree']) && ($_POST['agree']=='on' || $_POST['agree']==1) ? 1 : 0);
	
	$_company_alias = strip_tags($_POST['company']);
	$company 		= $companyObj->getCompanyByAlias($_company_alias);
	
	$query = "SELECT value FROM [pre]settings WHERE `code`='contact_email' LIMIT 1";
	$settingsEmail = $db->exec_query($query,1,0);
	
	$fromEmail = $settingsEmail['value'];
	
	if(!$company)
	{
		header('HTTP/1.0 403 Forbidden');
		exit();
	}
	
	// VALIDATE POST DATA
	
	$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{2}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
	
	$number_regrex = '/^\d+$/';
	
	$il_regrex = '/^[ת-א-]+$/';
	
	$test_fname = str_replace("'","",$_firstname);
	$test_fname = str_replace('"',"",$test_fname);
	$test_fname = str_replace('-',"",$test_fname);
	$test_fname = str_replace(' ',"",$test_fname);
	
	$test_lname = str_replace("'","",$_lastname);
	$test_lname = str_replace('"',"",$test_lname);
	$test_lname = str_replace('-',"",$test_lname);
	$test_lname = str_replace(' ',"",$test_lname);
	
	
	$name_hexString = strToHex($test_fname);
	$name_strArr = mb_split("d7",$name_hexString);
	
	$lname_hexString = strToHex($test_lname);
	$lname_strArr = mb_split("d7",$lname_hexString);

	//==================================================================================
	
	
	$data['message'] .= " ".$name_hexString;
	
	if(mb_strlen($_firstname) < 2 || !check_ivrit($name_strArr))
	{
		$data['err1'] = 1;
	}
	if(mb_strlen($_lastname) < 2  || !check_ivrit($lname_strArr))
	{
		$data['err2'] = 1;
	}
	//if(!preg_match( $regex, $_phone ))
	if(!preg_match( $number_regrex, $_phone))
	{
		$data['err3'] = 1;
	}
	if(!filter_var($_email,FILTER_VALIDATE_EMAIL))
	{
		$data['err4'] = 1;
	}
	if(strlen($_id)!=9 || !preg_match( $number_regrex, $_id))
	{
		$data['err5'] = 1;
	}
	if(!$_agree)
	{
		$data['err6'] = 1;
	}
	if($data['err1'] == 0 && $data['err2'] == 0 && $data['err3'] == 0 && $data['err4'] == 0 && $data['err5'] == 0 && $data['err6'] == 0){
		$coupon = $companyObj->getRandomCoupon($company['id']);
		
			if($coupon)
			{
				$data['status'] = 'success';
				$data['couponID'] = $coupon['id'];
			}else{
				$data['status'] = 'warning';
				$data['message'] = 'הכרטיסים אזלו מהמלאי';
				}
		}
	
	if($data['status']=='success')
	{
		// create new Account
		
		$account = $usersObj->findAccountByPassportId($_id);
		
		if(!$account)
		{
			$account_id = $usersObj->createNewAccount(array(
				'firstName' 			=> str_replace("'","\'",$_firstname),
				'lastName' 				=> str_replace("'","\'",$_lastname),
				'passportNumber' 		=> str_replace("'","\'",$_id),
				'mobilePhoneNumber' 	=> str_replace("'","\'",$_phone),
				'email' 				=> str_replace("'","\'",$_email),
				'coupon_id'				=> $coupon['id'],
				'agree'					=> $_agree
			));
		}else{
			$account_id = $account['id'];
			}
		
		if($account_id)
		{
			$companyObj->updateCouponQuantityById( ($coupon['quantity']-1), $coupon['id'] );
			
			$discount = $companyObj->getDiscountById($coupon['discount_id']);
			
			if($discount)
			{	
				$letterMessage = "<p style='direction:rtl; text-align:right;'>ההטבה שלכם הגיעה, מהרו לממש!</p>";
				$letterMessage .= "<p style='direction:rtl; text-align:right;'>מייל זה נועד לשליחה בלבד, נא לא לשלוח תגובות. תודה</p>";
				$letterSubject = "ההטבה שלכם הגיעה, מהרו לממש!";
				
				$attachments = "";
				$att_path= "";
				
				$att_path = "../uploads/coupons/";
				
				//$exLib->send_letter_with_file($_email,$fromEmail,"GameCarters: Congratulations!",$letterMessage,"GameCarters",false);
				
				$send_letter_vs_att = $exLib->sendLetterVsAttachment(array(
				 		'to'=>$_email,
				 		'from'=>$fromEmail,
				 		'subject'=>$letterSubject,
				 		'message'=>$letterMessage,
				 		'attachment'=>$coupon['image'],
				 		'att_path'=>$att_path
				 	));
				
			}
			
			$data['message'] = 'Success';
			$data['accountID'] = $account_id;
			
			$_SESSION['account_id'] = $account_id;
		}
	}


$db->db_destroy();

echo json_encode($data);