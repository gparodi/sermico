<?php
require('PHPMailer-master/class.phpmailer.php');
require('PHPMailer-master/class.smtp.php');

$mail = new PHPMailer();

$body = "Cuerpo del mensaje";

$mail->IsSMTP(); 

// la dirección del servidor, p. ej.: smtp.servidor.com
$mail->Host = "smtp.sermico.com.ar";

// dirección remitente, p. ej.: no-responder@miempresa.com
$mail->From = "bienesdeuso@sermico.com.ar";

// nombre remitente, p. ej.: "Servicio de envío automático"
$mail->FromName = "Servicio automatico de alertas";

// asunto y cuerpo alternativo del mensaje
$mail->Subject = "Asunto";
$mail->AltBody = "Cuerpo alternativo 
    para cuando el visor no puede leer HTML en el cuerpo"; 

// si el cuerpo del mensaje es HTML
$mail->MsgHTML($body);

// podemos hacer varios AddAdress
$mail->AddAddress("g.parodi@sermico.com.ar", "Gabriel");

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

?>