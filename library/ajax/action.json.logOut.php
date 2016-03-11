<?php session_start();

// Ajax handler for action LOGOUT

$_SESSION['account_id'] = NULL;

$data = array('status'=>'success', 'message'=>'LogOut is successful');

echo json_encode($data);