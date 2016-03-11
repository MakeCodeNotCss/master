<?php require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

	// Login check

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');


	$uid    	  = ACCOUNT_ID;
	$new_id       = $_POST['art_id'];
	$user_name    = $_POST['name'];
	$user_last    = $_POST['l_name'];
	$user_comment = $_POST['comment'];
	$date         = date("Y-m-d H:i:s",time());

	if(strlen($user_name)>=2)
	{
		if(strlen($user_last)>=2)
		{
			 if(strlen($user_comment)>=1)
			 {
						$query = "INSERT INTO [pre]article_comments (art_id, user_id, comment, name, fname, dateCreate, dateModify, block)
						VALUES ('$new_id', '$uid', '$user_comment', '$user_name', '$user_last', '$date', '$date', '1')
						";
						$insert_success = $db->exec_query($query,0,1);

						$data['message']='Ваш комментарий отправлен на модерацию';
						$data['status']='success';
			}else{
				$data['message'] = 'Ваш комментарий не должен быть пустым';
			}
		}else{
			$data['message'] = 'Ваша фамилия слишком короткая (мин. 2 символа)';
		}

	}else{
		$data['message'] = 'Ваша имя слишком короткое (мин. 2 символа)';
	}
		



	ob_start();
	?>

			<div class="comment">
					
			<span class="user-avatar">
			<img class="media-object" src="/assets/images/avatar.png" width="64" height="64" alt="">
			</span>

				<div class="media-body">
					<a href="#commentForm" class="scrollTo replyBtn">Ответить</a>
					<h4 class="media-heading bold"><?php echo $user_name?>&nbsp;<?php echo $user_last?></h4>
					<small class="block"><?php echo $date ?></small>
					<?php echo $user_comment ?>
					<br>
					<center>(Ваш комментарий будет опубликован после проверки модератором)</center>
				</div>
				
			</div>

	<?php

	$data['comment'] = ob_get_contents();

	ob_end_clean(); 




$db->db_destroy();

echo json_encode($data);

	