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
		$this->Init();
	}

	private function Init()
	{
		$this->cfg['from_to'] = 'hola@bancodetiempo.com';
		$this->InitDev();
	}

	private function InitDev()
	{
		if(!isset($_ENV['smtp.host'])) die("Configurar variables .env para SMTP");
		$this->cfg['SMTP_HOST'] = $_ENV['smtp.host'];
		$this->cfg['SMTP_PORT'] = $_ENV['smtp.port'];
		$this->cfg['SMTP_USER'] = $_ENV['smtp.user'];
		$this->cfg['SMTP_PASS'] = $_ENV['smtp.pass'];
		$this->cfg['SMTP_AUTH'] = $_ENV['smtp.auth'];
	}
	
	public function EnviarEmail(string $from = '', string $to = '', string $asunto = '', string $body_text = '', string $body_html = '')
	{		
		try {
			//Server settings
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$this->mailer->isSMTP();                                            //Send using SMTP
			$this->mailer->Host       = $this->cfg['SMTP_HOST'];                     //Set the SMTP server to send through
			$this->mailer->SMTPAuth   = $this->cfg['SMTP_AUTH'];                                   //Enable SMTP authentication
			$this->mailer->Username   = $this->cfg['SMTP_USER'];                     //SMTP username
			$this->mailer->Password   = $this->cfg['SMTP_PASS'];                               //SMTP password
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$this->mailer->Port       = $this->cfg['SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			if($this->cfg['SMTP_USER']=='SMTP_Injection') $this->mailer->SMTPSecure = 'tls';
			
			$this->mailer->CharSet = 'UTF-8';

			//Recipients
			$this->mailer->setFrom($this->cfg['from_to']);
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
