<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Core
{
	protected $helpers = [];
	protected $db;
	protected $cfg = [];
	protected $request;
	private $mailer;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->request = \Config\Services::request();
		$this->mailer = new PHPMailer();
	}
	
	public function EnviarEmail(string $from = '', string $to = '', string $asunto = '', string $body_text = '', string $body_html = '')
	{		
		try {
			//Server settings
			//$this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$this->mailer->isSMTP();                                            //Send using SMTP
			$this->mailer->Host       = "smtp-bancodetiempo.alwaysdata.net";                     //Set the SMTP server to send through
			$this->mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
			$this->mailer->Username   = "bancodetiempo@alwaysdata.net";                     //SMTP username
			$this->mailer->Password   = "Birt2022*";                               //SMTP password
			$this->mailer->SMTPSecure = "tls";
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$this->mailer->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`			
			$this->mailer->CharSet = 'UTF-8';

			//Recipients
			$this->mailer->setFrom("bancodetiempo@alwaysdata.net", "Banco de tiempo");
			$this->mailer->addAddress($to);

			//Content
			$this->mailer->isHTML(true);                                  //Set email format to HTML
			$this->mailer->Subject = $asunto;
			$this->mailer->Body    = $body_html;

			return $this->mailer->send();
			
		} catch (Exception $e) {
			// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			// TODO: Log error
		}
	}
}
