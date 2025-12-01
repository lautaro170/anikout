<?php 
include(__DIR__ ."/../../envioMail/class.phpmailer.php");
include(__DIR__ ."/../../envioMail/class.smtp.php");
include(__DIR__ ."/../../envioMail/auto.php");

function sendMail($subject, $body, $emailDestino, $nameUser ){

    $smtpUsuario = "envios@anikout.com.ar";  // Mi cuenta de correo
	$smtpClave = "SsqdUk)#;]&X";  // Mi contraseña

    $mail = new PHPMailer();
	$mail->isSMTP();

	$smtpHost = "localhost";  // Dominio alternativo brindado en el email de alta
	$mail->Host = $smtpHost;
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->isHTML(true);
	$mail->CharSet = "utf-8";

	$mail->Username = $smtpUsuario;
	$mail->Password = $smtpClave;
	$mail->From = $smtpUsuario;
	$mail->FromName = "ArteSana";
	$mail->addReplyTo($smtpUsuario, 'ArteSana');
	
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($emailDestino, $nameUser);
	
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	
	$status =  $mail->send();
	echo $mail->ErrorInfo;
	return $status;

}

#mock send mail
function sendMail($subject, $body, $emailDestino, $nameUser ){
    return true;
}
function mailPedidosUsuario($emailDestino, $nameUser){
    
    
    $today = new DateTime();
    $today->sub(new DateInterval('P1D'));

    $today_format =  $today->format('Y-m-d H:i:s');
    $fecha_entrega_str = getFechaEntrega($today_format);
    $fecha_entrega_dt = new DateTime($fecha_entrega_str, new DateTimeZone('America/Argentina/Buenos_Aires'));
    
    $fecha_entrega = 
    IntlDateFormatter::formatObject( 
      $fecha_entrega_dt, 
      "eeee d 'de' MMMM", 
      'es' 
    );
    
    $fecha_anterior_entrega_dt = $fecha_entrega_dt->sub(new DateInterval('P1D'));
    
    $fecha_anterior_entrega = 
    IntlDateFormatter::formatObject( 
      $fecha_entrega_dt, 
      "eeee d 'de' MMMM", 
      'es' 
    );
    
    $subject = "Pedido confirmado -  Viandas ArteSana";
    
    $body = "
		Hola, recibimos tu pedido ok.<br/>
		El ".$fecha_anterior_entrega." te estaremos confirmando por whatsapp la entrega  con el importe, y el horario más aproximado del delivery, para la entrega a realizar el día ".$fecha_entrega.".<br/><br/>

		Muchas gracias!!! 💚 <br/>
		Salud y saludos, Ani.
		";
	
	return sendMail($subject, $body, $emailDestino, $nameUser);
}


function mailPedidosAdmin($nameUser){
    
    $subject = "Nuevo Pedido Recibido";
	$body = "
	    Hola! Se recibió un nuevo pedido de ".$nameUser." en ArteSana.<br/>
	";
	$emailDestino = "anakout@gmail.com";
	$nameUser = "anikout";
	return sendMail($subject, $body, $emailDestino, $nameUser);
	
}

function mailNuevoUsuarioRegistradoAdmin($nombrecompleto, $telefono, $celular, $address, $email, $localidad, $horario_entrega){
    
    $subject = "Nuevo Usuario Registrado - ArteSana";
	$body = "
	    Hola! Se registró un nuevo usuario en Artesana.<br/><br/>
	    <h3>Datos del nuevo usuario:</h3>
	    Nombre: ".$nombrecompleto."<br/>
	    Telefono: ".$telefono."<br/>
	    Celular: ".$celular."<br/>
	    Dirección: ".$address."<br/>
	    Localidad: ".$localidad."<br/>";
	if($horario_entrega != null){
	    $body .= "	    Horario de Entrega: ".$horario_entrega."<br/>";
	    
	} 
	  $body .= "Email: <a href='mailto:".$email."'>".$email."<br/>";
	$emailDestino = "anakout@gmail.com";
	$nameUser = "anikout";
	return sendMail($subject, $body, $emailDestino, $nameUser);
	
}




?>