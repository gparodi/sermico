<?php
require('PHPMailer-master/class.phpmailer.php');
require('PHPMailer-master/class.smtp.php');
function enviarMail($listaMails,$asunto,$body){
	
	
	
	$mail = new PHPMailer();
	
	
	
	$mail->IsSMTP(); 
	
	// la dirección del servidor, p. ej.: smtp.servidor.com
	$mail->Host = "smtp.sermico.com.ar";
	
	// dirección remitente, p. ej.: no-responder@miempresa.com
	$mail->From = "bienesdeuso@sermico.com.ar";
	
	// nombre remitente, p. ej.: "Servicio de envío automático"
	$mail->FromName = "Servicio automatico de alertas";
	
	// asunto y cuerpo alternativo del mensaje
	$mail->Subject = $asunto;
	$mail->AltBody = "Si no puede ver este mensaje por favor comuniquese con el administrador: g.parodi@sermico.com.ar"; 
	
	// si el cuerpo del mensaje es HTML
	
	
	$mail->MsgHTML($body);
	
	// podemos hacer varios AddAdress
	for($i=0;$i<count($listaMails);$i++){
		
		$mail->AddAddress($listaMails[$i],"");		
	
	}
	
	// si el SMTP necesita autenticación
	$mail->SMTPAuth = true;
	
	// credenciales usuario
	$mail->Username = "bienesdeuso@sermico.com.ar";
	$mail->Password = "Sermico2015"; 
	
	if(!$mail->Send()) {
	echo "Error enviando:" . $mail->ErrorInfo;
	} else {
	echo "¡¡Enviado!!";
	}
}

?>