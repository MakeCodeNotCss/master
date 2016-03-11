<?php require_once("_ajax_boot.php");

	// Database connection

	$db->db_access();

	// Login check

	include_once("../_auth.php");

	// Ajax handler for action ADMIN LOGIN

	$data = array('status'=>'failed', 'message'=>'Error');


	$np_city = $_POST['np_city'];

	if($np_city)
	{	

				$query = "SELECT P.DescriptionRu, P.id
							FROM next_np_parts as P
							LEFT JOIN next_np_cities as C ON C.Ref=P.CityRef
							WHERE C.DescriptionRu='$np_city'
							ORDER BY C.DescriptionRu 
							";
				$partsList = $db->exec_query($query);

		if($partsList)
		{
			$data['message']='success';
			$data['status']='success';
				ob_start();

						foreach ($partsList as $item)
						{
						?>	
							<option value="<?php echo $item['DescriptionRu'] ?>"><?php echo $item['DescriptionRu'] ?></option>
						<?php	
						}
						
				$data['partsList'] = ob_get_contents();
				ob_end_clean(); 
		}else{
			$data['message']='SQL Error';
		}		

	}else{
		$data['message']='POST Error';
	}


	






$db->db_destroy();

echo json_encode($data);

	