<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 01/11/2018
 * Time: 7:40
 */
require_once 'Voucher.php';
require_once 'SendMail.php';
$string = file_get_contents("data.json");
$data = json_decode($string, true);
//strtolower full name + random hash
$pdfsFolder = 'pdfs/';
$template = "voucher_template.pdf";
$filename = $pdfsFolder."gil_palikaras_14.pdf";
$pdfWrite = new Voucher($data,$template,$filename);
$writeFile = $pdfWrite->writeDataToPdf();

if($writeFile){
	echo "pdf file ".$filename." created!";
	$sendMailObj = new SendMail($filename);
	$sendMailObj->sendEmail();
}else{
	echo "error! file not found!";
}