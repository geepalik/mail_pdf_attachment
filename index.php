<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 01/11/2018
 * Time: 7:40
 */
require_once 'VoucherFactory.php';
require_once 'ShowVoucher.php';
require_once 'ServiceVoucher.php';
require_once 'SendMail.php';
$params = $_REQUEST;
if(
	empty($params['voucher_data']) ||
	!$params['voucher_file_name'] ||
	!$params['user_data']['email'] ||
	!$params['booking_type']
){
	$response = array(
		"status" => "error",
		"result" => "no data set or file name is empty or user email is empty"
	);
	http_response_code(500);
	print json_encode($response);
	exit;
}

$data = $params['voucher_data'];
$filename = PdfWrite::EXPORT_FOLDER.$params['voucher_file_name'];


try{
	$pdfWrite = VoucherFactory::generateVoucher($params['booking_type'], $data, $filename);
	$writeFile = $pdfWrite->writeDataToPdf();

}catch (Exception $exception){
	$response = array(
		"status" => "error",
		"result" => "file ".$filename." could not be created",
		"details" => $exception->getMessage()
	);
	http_response_code(500);
	print json_encode($response);
	exit;
}

try{
	$sendMailObj = new SendMail($filename, $params['user_data']['email'], $data['client']['full_name']);
	$sendMailObj->sendEmail();
	unlink($filename);

	$response = array(
		"status" => "success",
		"result" => "file ".$filename." was sent to email ".$params['user_data']['email']
	);
	http_response_code(200);
	print json_encode($response);
	exit;

}catch (Exception $exception){
	$response = array(
		"status" => "error",
		"result" => "file ".$filename." could not be send to email ".$params['user_data']['email']." : ".$exception->getMessage()
	);
	http_response_code(500);
	print json_encode($response);
	exit;
}