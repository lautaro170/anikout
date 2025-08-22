<?php
header('Access-Control-Allow-Origin: *'); 
header("Content-Type:application/json");
include("admin/controller/funciones.php");
include("envioMail/class.phpmailer.php");
include("envioMail/class.smtp.php");
include("envioMail/auto.php");

require("class.phpmailer.php");
require("class.smtp.php");
require("auto.php");

if(!empty($_GET["pedidoArray"]))
{
	$pedido = $_GET["pedidoArray"];
	$nota = $_GET["nota"];

	$emailUser = $_SESSION['usuario_a'];
	$nameUser = $_SESSION['usuario'];

	$ret = crear_pedido($pedido, $nota);	

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'localhost';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->isHTML(true);
	$mail->CharSet = "utf-8";
	// Datos de la cuenta de correo utilizada para enviar mail
	$smtpUsuario = "envios@anikout.com.ar";
	$smtpClave = "SsqdUk)#;]&X";
	//Email donde se enviaran los datos
	$emailDestino = $emailUser;
	// ---------------
	$mail->Username = $smtpUsuario;
	$mail->Password = $smtpClave;
	$mail->From = $smtpUsuario;
	$mail->FromName = "ArteSana";
	$mail->addReplyTo($smtpUsuario, 'ArteSana');
	$mail->Subject = "Pedido Confirmado";
	$mail->Body = "{$mensajeHtml} <br />Recibido tu pedido ok.<br /><br /> 
										Muchas gracias. El jueves te estaremos confirmando la entrega.<br />
										Un beso, Ani";
	$mail->AddAddress($emailDestino, $nameUser);
	//-------------------------
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
        	'verify_peer_name' => false,
        	'allow_self_signed' => true
		)
	);

	if(!$mail->send()){
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message sent!';
	}

	delivery_response(200, "event created", $ret);	
}
else
{
	delivery_response(400, "Invalid request", NULL);
}


function delivery_response($status, $status_message, $data)
{
	header("HTTP/1.1 $status $status_message");

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}


?>