<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type:application/json");
include("admin/controller/funciones.php");

session_start();
if(isset($_GET["usuario"]))
{
  $email = $_GET["usuario"];

  $conn = conectar();

  $sql = "SELECT * FROM usuario where Email = '" . $email . "';";
  //echo $sql;
  $resultado=mysqli_query($conn,$sql);
  if(mysqli_num_rows($resultado) > 0)
  {
    $row = mysqli_fetch_array($resultado);
    $clave = $row["Contrasenia"];
    $nombre = $row["Nombre"];

    $mail = new PHPMailer();
    $mail->isSMTP();
    
    $smtpHost = "localhost";  // Dominio alternativo brindado en el email de alta
    $mail->Host = $smtpHost;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->isHTML(true);
    $mail->CharSet = "utf-8";
    //$mail->SMTPDebug  = 2; 
    // Datos de la cuenta de correo utilizada para enviar mail
    $smtpUsuario = "envios@anikout.com.ar";  // Mi cuenta de correo
    $smtpClave = "SsqdUk)#;]&X";  // Mi contraseña
    //Email donde se enviaran los datos
    $emailDestino = $email;
    // ---------------
    $mail->Username = $smtpUsuario;
    $mail->Password = $smtpClave;
    $mail->From = $smtpUsuario;
    $mail->FromName = "ArteSana";
    $mail->addReplyTo($smtpUsuario, 'ArteSana');
    $mail->Subject = "Recuperar Clave -  Viandas ArteSana";
    $mail->Body = "
    Hola, recibimos tu pedido para recuperar tu clave de acceso al sistema de pedidos.<br/><br/>
    Tu clave es: " . $clave . "<br/><br/>
    Con esta clave y tu email podras volver a ingresar a hacer pedidos.<br/>
    Haciendo <a href='https://anikout.com.ar/pedidos/login.php'>click aca</a> te llevamos a la pagina de ingreso<br/><br/>

    Muchas gracias!!! 💚 <br/>
    Salud y saludos, Ani.";
    $mail->AddAddress($emailDestino, '$nameUser');
    //-------------------------
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    $resultadoMail = "";
    if(!$mail->send()){
      $resultadoMail = 'Hubo un error en el envio';
    } else {
      $resultadoMail = 'Recupero enviado, revisa tu email.';
    }

    delivery_response(200, "event created", $resultadoMail);

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
