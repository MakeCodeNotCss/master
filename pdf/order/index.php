<?php session_start();
	/*	MIRACLE WEB TECHNOLOGIES	*/
	/*	--------------------------	*/
	
	// INCLUDE DATABASE AND CREATE OBJECT BY MAIN LIBRARY
	
	require_once("../../_db_lib.php");
	
	$obj = new Library($dbh);

// Проверяем user_id для зарегистрированных пользователей.
	
	$user_exist = false;
	if(isset($_SESSION['uid']))
	{
		$curr_sess_id = (int)$_SESSION['uid'];
		if($curr_sess_id)
		{
			$user_data = $obj->rs("SELECT * FROM [pre]users WHERE `id`='".$curr_sess_id."' AND `block`=0 LIMIT 1");
			if($user_data)
			{
				$user_exist = true;
				$profile = $user_data[0];
				define("UID",$profile['id']);
			}
		}
	}
	if(!$user_exist)
	{
		$uid = time()+rand(111,9999);
		define("UID",$uid);
		define("ONLINE",false);
	}else
	{
		define("ONLINE",true);
	}
	
if(ONLINE)
{

$orderId = (isset($_POST['orderId']) ? $_POST['orderId'] : 0);

$orderNum = ($orderId ? ($orderId+5000) : 0);

$query = "SELECT * FROM [pre]shop_orders WHERE `id`=$orderId LIMIT 1";

$order_data = $obj->rs($query);

if($order_data)
{
	
	$order = $order_data[0];

	if($order['author_id'] != UID && $order['user_id'] != UID) die("Violations of user rights.");
	
	$products = unserialize($order['products']);
	
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ZEN WP');
$pdf->SetTitle('ORDER PDF');
$pdf->SetSubject('ZEN WP ORDER');
$pdf->SetKeywords('PDF, Order');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
//$pdf->SetHeaderData("logo.png", PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true); // 

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = "

<table style=\"width:150%;\">
	<tr>
		<td style=\"width:15%;\">
			<span style=\"text-decoration: underline;\" ><b>Постачальник</b></span>
		</td>
		<td>
			Інтернет Магазин \"MyStore\" <br />
			тел. 044 000-00-00 <br />
		</td>
	</tr>
	<tr>
		<td style=\"width:15%;\"><br /><br />
			<span style=\"text-decoration: underline;\" ><b>Одержувач</b></span>
		</td>
		<td><br /><br />
			".$order['client_name']." ".$order['client_fname']."
			<hr />
			<p>тел. ".$order['client_phone']."</p>
		</td>
	</tr>
	<tr>
		<td style=\"width:15%;\"><br /><br />
			<span style=\"text-decoration: underline;\" ><b>Платник</b></span>
		</td>
		<td><br /><br />
			Той самий
		</td>
	</tr>
	<tr>
		<td style=\"width:15%;\"><br /><br />
			<span style=\"text-decoration: underline;\" ><b>Замовлення</b></span>
		</td>
		<td><br /><br />
			№ $orderNum
			<hr />
		</td>
	</tr>
</table>

<h4 align=\"center\">Рахунок-фактура № _____________</h4>
<h4 align=\"center\">від _____________________ 201__ р.</h4>

<table border=\"1\">
	<tr>
		<th width=\"5%\" align=\"center\"  style=\"background-color:#CCC;\">№</th>
		<th width=\"40%\" align=\"center\" style=\"background-color:#CCC;\">Назва</th>
		<th width=\"5%\" align=\"center\"  style=\"background-color:#CCC;\">Од.</th>
		<th width=\"20%\" align=\"center\" style=\"background-color:#CCC;\">Кількість</th>
		<th width=\"15%\" align=\"center\" style=\"background-color:#CCC;\">Ціна без ПДВ</th>
		<th width=\"15%\" align=\"center\" style=\"background-color:#CCC;\">Сума без ПДВ</th>
	</tr>";
	
	$icnt = 0;
	foreach($products as $product)
	{
		$query = "SELECT sku,name,price FROM [pre]shop_products WHERE `id`='".$product['prod_id']."' LIMIT 1";
		$prodData = $obj->rs($query);
		
		if($prodData)
		{
			$icnt++;
			
			$prod = $prodData[0];
			$html .=
				"<tr>
					<td align=\"center\">$icnt</td>
					<td>
						<table border=\"1\">
							<tr>
								<td width=\"70%\"> ".$prod['name']."</td>
								<td width=\"30%\" align=\"center\">".$prod['sku']."</td>
							</tr>
						</table>
					</td>
					<td align=\"center\">шт.</td>
					<td align=\"center\">".$product['quant']."</td>
					<td align=\"center\">".$prod['price']." грн.</td>
					<td align=\"center\">".($prod['price']*$product['quant'])." грн.</td>
				</tr>";
		}
	}
	
$html .= "
</table>

<br />
<br />

<table>
	<tr>
		<td width=\"40%\">
			<b>Всього на суму:</b> ".$order['sum']." грн.
			<br />
			<br />
			Без ПДВ
		</td>
		<td width=\"10%\"></td>
		<td width=\"60%\">
			<br />
			<br />
			<p>Виписав(ла):    _____________________________________
			</p>
			<p><b>Рахунок дійсний до сплати до</b> _______________
			</p>
		</td>
	</tr>
<table>

";


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output("zencosmetics_order_$orderNum.pdf", "I");

//============================================================+
// END OF FILE
//============================================================+

	
	}else
		{
			die("Undefined order.");
		}
}else
	{
		die("Undefined user.");
	}
