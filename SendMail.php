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
	private $userEmail;
	private $userName;
	private $mailerObj;
	private $messageContent;

	/**
	 * SendMail constructor.
	 *
	 * @param $attachmentFile
	 * @param $userEMail
	 * @param $userName
	 * @param $messageContent
	 */
	public function __construct($attachmentFile, $userEMail, $userName, $messageContent)
	{
		$this->userEmail = $userEMail;
		$this->userName = $userName;
		$this->attachmentFile = $attachmentFile;
		$this->messageContent = $messageContent;
		$this->mailerObj = new PHPMailer(true);
	}

	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function sendEmail()
	{
		try{
			$body = file_get_contents($this->messageContent);
			$this->mailerObj->isSMTP();
			$this->mailerObj->Host = '************';
			$this->mailerObj->SMTPSecure = 'ssl';
			$this->mailerObj->Port = 465;
			$this->mailerObj->SMTPAuth = true;
			$this->mailerObj->Username = '***********';
			$this->mailerObj->Password = '************';
			$this->mailerObj->setFrom('****email***','Name');
			$this->mailerObj->addAddress($this->userEmail);
			$this->mailerObj->addBCC('********');
			$this->mailerObj->CharSet = 'UTF-8';
			$this->mailerObj->isHTML(true);
			$this->mailerObj->addAttachment($this->attachmentFile);
			$this->mailerObj->Subject = 'אישור הזמנה - Reservation Confirmation';
			$this->mailerObj->MsgHTML($body);
			$this->mailerObj->AltBody = "To view this message please use an HTML compatible email viewer";
			$this->mailerObj->send();

			return true;

		}catch (Exception $exception){
			throw new \Exception($exception->errorMessage());
		}
	}
}