<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Email_class{

	private $email;
	private $password;

	function __construct(){	
		$this->email = '';
		$this->password = '';
	}	
	
	function send_email($data){
		$CI =& get_instance();
		$CI->load->library('phpmailer');
		extract($data);	
	
		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('America/Tijuana');

		//Create a new PHPMailer instance
		//$mail = new PHPMailer();
		//Tell PHPMailer to use SMTP
		$CI->phpmailer->IsSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$CI->phpmailer->SMTPDebug  = 0;
		//Ask for HTML-friendly debug output
		$CI->phpmailer->Debugoutput = 'html';
		//Set the hostname of the mail server
		$CI->phpmailer->Host       = 'smtp.gmail.com';
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$CI->phpmailer->Port       = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$CI->phpmailer->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$CI->phpmailer->SMTPAuth   = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$CI->phpmailer->Username   = $this->email;
		//Password to use for SMTP authentication
		$CI->phpmailer->Password   = $this->password;
		//Set who the message is to be sent from		
		$CI->phpmailer->SetFrom($CI->phpmailer->Username, $from['name']);
		//Set who the message is to be sent to
		$CI->phpmailer->AddAddress($to['email'], $to['name']);
		//Set the subject line
		$CI->phpmailer->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
		$CI->phpmailer->MsgHTML($message);
		//CI->phpmailer the plain text body with one created manually
		$CI->phpmailer->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->AddAttachment('images/phpmailer_mini.gif');

		//Send the message, check for errors
		if(!$CI->phpmailer->Send()) {
		  //echo "Mailer Error: " . $CI->phpmailer->ErrorInfo;
		  echo "Error";
		} else {
		  return true;
		}		


	}


}