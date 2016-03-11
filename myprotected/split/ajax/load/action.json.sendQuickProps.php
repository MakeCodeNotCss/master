<?php // ajax json action

	require_once "../../../require.base.php";
	
	require_once "../../library/settings.class.php";
	
	$data = array();
	
	$orderId = $_POST['orderId'];

	$aa = new settingsHelp($dbh);

	$acc_nums = $aa->getAllMyAccounts();


	$result = "";					

	$result .= 	"<button class='close-modal' onclick='close_modal();'>Закрыть окно</button>
	    			<div class='modalW' id='modalW-1'>
						<div class='confirmWrapper'>
							<h2 align='center'>Вы уверенны что хотите отправить реквизиты для быстрого заказа №".($orderId)." ?</h2>
							<div>
								<select id='sendPropsSelect' type='select' name='accNum' placeholder='Список счетов'>";

									foreach ($acc_nums as $i => $acc)
										{
											
											$result .= '<option value = '.$acc['acc_number'].'>'. $acc['acc_number'].' - '.$acc['props'] .'</option>';
										
										}	


	$result .= 					"</select>
							<table>
								<tr>
									<td><a href='javascript:void();' class='cancel' onclick=\"close_modal();\">Нет</a></td>
									<td><a href='javascript:void();' class='confirm' onclick=\"send_quick_props_to_client($orderId); close_modal(); \">Да</a></td>
								</tr>
							</table>
						</div>
					</div>
					";


	$data['message'] = $result;
	
	$data['status'] = "success";
	
	
echo json_encode($data);
