<?php 

include 'dbconnect.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';	


if ($_POST['akcija'] == 'menjanjeSifre') {
	$mail = $_POST['mail'];
	$sql = "SELECT `radnik_id`, `username`, `password`, `e_mail`, `admin`, `hash` FROM `radnici` WHERE e_mail = '$mail'";
	$results = $conn->query($sql);
	$row = $results->fetch_assoc();
	$_SESSION['hash'] = $row['hash'];
	if (!$results -> num_rows) {
		echo "nema...";
		die();
	}

	include 'phpMailer.php';					
	
	$mail->setFrom('abbahoteltest@gmail.com', 'Abba Hotel');
	$mail->addAddress('abbahoteltest@gmail.com', 'Abba Hotel');
	$mail->addBCC($row['e_mail']);	
	
	$body = "<p>Kliknite na link kako biste promenili svoju šifru!</p>
                <a href='localhost/hotel/menjanjesifre.php?h=" . $row['hash'] . "'><i>LINK</i></a>";
	// Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Hvala';
	$mail->Body    = "$body";
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->send();				
}		
	


?>