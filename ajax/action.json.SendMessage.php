<?php require_once("_ajax_boot.php");

include_once("../model/mod.helper.php");

$helper = new Helper($db);

	  
// end of require helpers	

$sendTo = "info@parquet-board.com";

$data = array('status'=>'failed','message'=>'error');

if(isset($_POST['name']) && isset($_POST['phone']))
{
	$name 		= strip_tags($_POST['name']);
	$phone 		= $_POST['phone'];
	$from = $name;
	
	if(strlen($name) > 2)
	{
		if(strlen($phone) > 10)
			{
				$sendMessage = "<p>Автор: $name</p>";
				$sendMessage .= "<p>Phone: $phone</p><hr>";
				
				$sendStatus = $helper->send_letter($sendTo,$from,"Перезвоните мне, от $name",$sendMessage,"Dveri Prestige FeedBack");
					
				if($sendStatus)
				{
					$data['status'] = 'success';
					$data['message'] = "<br><center><strong>Сообщение успешно отправлено!</strong><br> Мы свяжемся с Вами в ближайшее время.</center><br>";
				}else{
					$data['message'] = "Ошибка при отправке данных!";
					}
					
			}else{
				$data['message'] = "Номер слишком короткий!";
				}
	}else{
		$data['message'] = "Представьтесь пожалуйста!";
		}
}

echo json_encode($data);
	