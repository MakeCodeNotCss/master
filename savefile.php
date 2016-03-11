<?php
if(!isset($_POST['id']) || !intval($_POST['id'])){
	header('HTTP/1.0 403 Forbidden');
	exit();
}

require_once("_boot.php");

$_id = (int)$_POST['id'];

$coupon = $companiesObj->getCouponById($_id);

if(!$coupon){
	header('HTTP/1.0 403 Forbidden');
	exit();
	}

function file_force_download($file) {
  if (file_exists($file)) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
      ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
	header ("Accept-Ranges: bytes");
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // читаем файл и отправляем его пользователю
    if ($fd = fopen($file, 'rb')) {
      while (!feof($fd)) {
        print fread($fd, 1024);
      }
      fclose($fd);
    }
    exit;
  }
}

$file_path = "uploads/coupons/";
$filename = $coupon['image'];

if(!file_exists($file_path.$filename)){
	header('HTTP/1.0 403 Forbidden');
	exit();
}

file_force_download($file_path.$filename);