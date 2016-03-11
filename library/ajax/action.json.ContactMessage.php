<?php require_once("_ajax_boot.php");

include_once("../model/mod.helper.php");

$helper = new Helper($db);

	  
// end of require helpers	

$sendTo = "info@parquet-board.com";

$data = array('status'=>'failed','message'=>'error');

if(isset($_POST['message']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact_subject']))
{
	
	$name 				= strip_tags($_POST['name']);
	$contact_subject	= strip_tags($_POST['contact_subject']);
	$email 				= $_POST['email'];
	$message 			= strip_tags($_POST['message']);
	$from = $name;
	
	if(strlen($name) > 2)
	{
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			if(strlen($message) > 10)
			{				
				$sendMessage = "<p>Автор: $name</p>";
				$sendMessage .= "<p>Организация: $contact_subject</p>";
				$sendMessage .= "<p>Email: $email</p><hr>";
				$sendMessage .= "<p>Сообщение: $message</p>";
				
				$sendStatus = $helper->send_letter($sendTo,$from,"Обратная связь от $name",$sendMessage,"Parquet Board FeedBack");
					
				if($sendStatus)
				{
					$data['status'] = 'success';
					$data['message'] = "<br>
					<div id='_sent_ok_' class='alert alert-success fade in fsize18'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
						<span id='_msg_txt_'><strong>Сообщение успешно отправлено! </strong> Мы свяжемся с Вами в ближайшее время!</span>
					</div>
					<br>";
				}else{
					$data['message'] = "Ошибка при отправке данных!";
					}
					
			}else{
				$data['message'] = "Сообщение слишком короткое!";
				}
		}else{
			$data['message'] = "Укажите корректный E-mail!";
			}
	}else{
		$data['message'] = "Представьтесь пожалуйста!";
		}
}

echo json_encode($data);
	