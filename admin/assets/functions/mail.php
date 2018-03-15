<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function sendMail($emailto,$firstname,$lastname,$subject,$message, $emailfrom, $json) {
	 try {
		$mail = new PHPMailer(true);   
		
		//Server settings
		$configmail = parse_ini_file(dirname($_SERVER['DOCUMENT_ROOT']) . '/cfg/config_mail.ini'); 
		$mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $configmail['host'];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $configmail['username'];                 // SMTP username
		$mail->Password = $configmail['password'];                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom($emailfrom, 'Scissors 2 You');
		$mail->addAddress($emailto, $firstname . ' ' . $lastname);     // Add a recipient

		//Content
		// Set email format to HTML
		$mail->Subject = $subject;
		$bd = $message;

		$mail->Body = $bd;

		$mail->isHTML(true);
		
		$mail->send();
		 if ($json == true) {
			 return json_encode(array('fname' => $firstname, 'code' => '1'));
		 } else {
			 return true;
		 }
	} catch (Exception $e) {
		 if ($json == true) {
			 return json_encode(array('fname' => '', 'code' => '2'));
		 } else {
			 return false;
		 }
	}	
}
	
?>