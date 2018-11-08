<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 08/11/2018
 * Time: 6:43
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

class SendMail
{

	private $attachmentFile;
	private $mailerObj;

	public function __construct($attachmentFile)
	{
		$this->attachmentFile = $attachmentFile;
		$this->mailerObj = new PHPMailer(true);
	}

	public function sendEmail()
	{
		try{
			$this->mailerObj->isSMTP();
			$this->mailerObj->Host = 'mail.all-toner.gr';
			$this->mailerObj->Port = 587;
			$this->mailerObj->SMTPAuth = true;
			$this->mailerObj->Username = 'gil@all-toner.gr';
			$this->mailerObj->Password = 'd3v3l0p3R';
			$this->mailerObj->SMTPSecure = '';
			$this->mailerObj->From = 'info@weblesson.info';
			$this->mailerObj->FromName = 'Ahahahaha';
			$this->mailerObj->addAddress('gil.palikaras@gmail.com');
			$this->mailerObj->isHTML(true);
			$this->mailerObj->addAttachment($this->attachmentFile);
			$this->mailerObj->Subject = 'Your order voucher';
			$this->mailerObj->Body = 'Sample text here';
			$this->mailerObj->send();

			echo "email was sent successfully!";

		}catch (Exception $exception){
			var_dump($exception->errorMessage());
			die("----");
		}
	}
}