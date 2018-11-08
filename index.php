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
$template = "voucher_template.pdf";
$filename = "gil_palikaraas_14.pdf";
$pdfWrite = new Voucher($data,$template,$filename);
$writeFile = $pdfWrite->writeDataToPdf();
if($writeFile){
	$sendMailObj = new SendMail($filename);
	$sendMailObj->sendEmail();
}

