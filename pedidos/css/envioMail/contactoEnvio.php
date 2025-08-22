<?php session_start();?>
<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
/*if ( !isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["subject"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}*/
$nombre = $_POST["name"];
$email = $_POST["email"];
$titulo = $_POST["subject"];
$mensaje = $_POST["message"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "localhost";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "artesana@anikout.com";  // Mi cuenta de correo
$smtpClave = "ptR@g9l3pP";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "ruizgerezr@gmail.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 25; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $smtpUsuario; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
$mail->AddReplyTo($email); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del visitante. 
$mail->Subject = $titulo; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "{$mensajeHtml} <br /><br />Formulario enviado desde el Sitio de Carlos Fiotto e Hijos<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario enviado desde el Sitio de Carlos Fiotto e Hijos"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    $_SESSION["mensajeEnvio"] = "El correo fue enviado correctamente.";
    header('Location: contacto.php');
} else {
     $_SESSION["mensajeEnvio"] = "Ocurrió un error inesperado.";
    header('Location: contacto.php');
}
