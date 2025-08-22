<?php
header('Access-Control-Allow-Origin: *');
//header("Content-Type:application/json");
include("admin/controller/funciones.php");

/*
include("envioMail/class.phpmailer.php");
include("envioMail/class.smtp.php");
include("envioMail/auto.php");
*/

session_start();

if(isset($_POST["pedidoArray"]))
{
	$pedido = $_POST["pedidoArray"];
	$nota = $_POST["nota"];
    $zonaEnvio = $_POST["zonaEnvio"];
    
	$emailUser = $_SESSION['usuario_mail_a'];
	$nameUser = $_SESSION['nombrecompleto_a'];
    $userid = $_SESSION['u_id_a'];
    
    if($zonaEnvio != ""){
        $conn = conectar();
    
        $sql = "Update usuario u SET
                u.ZonaEnvio = '".$zonaEnvio."' 
                WHERE u.UsuarioId = '".$userid."';";
                
        $cdresult=mysqli_query($conn,$sql) or die ("Query to get data from firsttable failed: ".mysqli_error());
}

	$ret = crear_pedido($pedido, $nota);
	if($ret)
	{
	    
		$resultadoMail = "";
		if(!mailPedidosUsuario($emailUser, $nameUser)){
			$resultadoMail = 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$resultadoMail = 'Message sent!';
		}
		
		$resultadoMail = "";
		if(!mailPedidosAdmin($nameUser)){
			$resultadoMail = 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$resultadoMail = 'Message sent!';
		}
		
		
		
		delivery_response(200, "event created", $ret);
	}
	else {
		echo "Hubo un error. Intentelo nuevamente.";
	}
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
