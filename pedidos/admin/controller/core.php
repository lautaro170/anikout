<?php

/////////////////////////////INICIO FUNCIONES DE SISTEMA//////////////////////////////////
date_default_timezone_set('America/Argentina/Buenos_Aires');


if(isset($_GET['fcn']))
{
	$fcn = $_GET['fcn'];



	switch($fcn) {
		case '1':
		validar_usuario();
		break;
		case '2':
		validar_admin();
		break;
		case '3':
		validar_cook();
		break;
	}
}

function addURLParameter($url, $paramName, $paramValue) {
	$url_data = parse_url($url);
	if(!isset($url_data["query"]))
		$url_data["query"]="";

	$params = array();
	parse_str($url_data['query'], $params);
	$params[$paramName] = $paramValue;
	$url_data['query'] = http_build_query($params);

	return build_url($url_data);
}

function build_url($url_data) {
	$url="";
	if(isset($url_data['host']))
	{
		$url .= $url_data['scheme'] . '://';
		if (isset($url_data['user'])) {
			$url .= $url_data['user'];
			if (isset($url_data['pass'])) {
				$url .= ':' . $url_data['pass'];
			}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if (isset($url_data['port'])) {
			$url .= ':' . $url_data['port'];
		}
	}
	$url .= $url_data['path'];
	if (isset($url_data['query'])) {
		$url .= '?' . $url_data['query'];
	}
	if (isset($url_data['fragment'])) {
		$url .= '#' . $url_data['fragment'];
	}
	return $url;
}


/*function conectar(){

	//$conexion = mysql_connect("localhost", "c0710367_arte", "Artesana123");
	//$conexion = mysql_connect("localhost", "admintst_arte", "Artesana123");
	$conexion = mysql_connect("localhost", "root", "");

	if(!$conexion)
	{
		echo "La Conexion no se pudo realizar " . mysql_error();
	}


	//$base_de_datos=mysql_select_db("c0710367_arte", $conexion);
	//$base_de_datos=mysql_select_db("admintst_artesanadb", $conexion);
	$base_de_datos=mysql_select_db("cocina2db", $conexion);


	if(!$base_de_datos)
	{
		echo "<p class='msge-funciones'>No se puede seleccionar la base de datos " . mysql_error() . "</p>";
	}

	mysql_set_charset('utf8');
}*/

function conectar(){
	//$mysqli = new mysqli("localhost", "root", "", "anidb");
	$mysqli = new mysqli("localhost", "anikout_sistema_pedidos", "3SPgEv**9bYz", "anikout_sistema_pedidos_nuevo");
	mysqli_set_charset($mysqli,"utf8");
	if($mysqli->connect_error)
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

	return $mysqli;
}

function validar_admin()
{
	if(isset($_POST['usuario']) && isset($_POST['clave']))
	{
		$conn=conectar();
		session_start();
		$nombre_usuario=$_POST['usuario'];
		$clave=$_POST['clave'];

		$sql_usuario="SELECT * from usuario WHERE Email='$nombre_usuario' AND Contrasenia='$clave' AND Recupero=0 AND Permiso = 'administrador';";


		$usuario=mysqli_query($conn,$sql_usuario);
		$cant=mysqli_num_rows($usuario);

		$fila=mysqli_fetch_array($usuario);

		if($cant>0)
		{

			$_SESSION['usuario_ad']=$nombre_usuario;
			$_SESSION['rol_ad']=$fila["Permiso"];
			$nombrecompleto =  $fila["Nombre"] . " " . $fila["Apellido"];

			$_SESSION['nombrecompleto_ad'] = $nombrecompleto;
			$_SESSION['u_id_ad'] = $fila["UsuarioId"];

			header('Location: ../index.php');
		}
		else
		{
        	header('Location: ../login.php?error=1');
		}

	}
	else
	{
        header('Location: ../login.php?error=1');
	}

}


function validar_cook()
{

	if(isset($_POST['usuario']) && isset($_POST['clave']))
	{
		$conn=conectar();
		session_start();
		$nombre_usuario=$_POST['usuario'];
		$clave=$_POST['clave'];

		$sql_usuario="SELECT * from usuario WHERE Email='$nombre_usuario' AND Contrasenia='$clave' AND Recupero=0 AND Permiso = 'cocinero';";


		$usuario=mysqli_query($conn,$sql_usuario);
		$cant=mysqli_num_rows($usuario);

		$fila=mysqli_fetch_array($usuario);

		if($cant>0)
		{
			$_SESSION['usuario_ac']=$nombre_usuario;
			$_SESSION['rol_ac']=$fila["Permiso"];
			$nombrecompleto =  $fila["Nombre"] . " " . $fila["Apellido"];

			$_SESSION['nombrecompleto_ac'] = $nombrecompleto;
			$_SESSION['u_id_ac'] = $fila["UsuarioId"];

			header('Location: ../cocinero/index.php');
		}
		else
		{
        	header('Location: ../cocinero/login.php?error=1');
		}

	}
	else
	{
    	header('Location: ../cocinero/login.php?error=1');
	}

}

function validar_usuario()
{
	if(isset($_POST['usuario']) && isset($_POST['clave']))
	{
		$conn = conectar();
		session_start();

		$nombre_usuario=$_POST['usuario'];
		$clave=$_POST['clave'];

		$sql_usuario="SELECT * from usuario WHERE Email='$nombre_usuario' AND Contrasenia='$clave' AND Recupero=0";

		$usuario=mysqli_query($conn ,$sql_usuario);
		$cant=mysqli_num_rows($usuario);

		$fila=mysqli_fetch_array($usuario);

		if($cant == 1)
		{

			$_SESSION['usuario_a']=$nombre_usuario;
			$_SESSION['usuario_mail_a']=$fila["Email"];

			$_SESSION['rol_a']=$fila["Permiso"];
			$nombrecompleto =  $fila["Nombre"] . " " . $fila["Apellido"];

			$_SESSION['nombrecompleto_a'] = $nombrecompleto;
			$_SESSION['u_id_a'] = $fila["UsuarioId"];

			header('Location: ../../index.php');
		}
		else
		{
        	header('Location: ../../realizar-pedido.php?error=1');
		}

	}
	else
	{
    	header('Location: ../../realizar-pedido.php?error=1');
	}

}

function enviar_mail_recupero($mail_recupero, $hash_recupero, $nombre_recupero)
{

	include("envioMail/class.phpmailer.php");
	include("envioMail/class.smtp.php");
	include("envioMail/auto.php");
	if(true)
	{
	  $postdata = file_get_contents("php://input");

	  $request = json_decode($postdata);
	  $email = $request->usuario;
	  //  echo $email;

	  $conn = conectar();

	  $sql = "SELECT * FROM usuario where email = '" . $email . "';";

	  $resultado=mysqli_query($conn,$sql);

	  if(mysqli_num_rows($resultado) > 0)
	  {

	    $row = mysqli_fetch_array($resultado);
	    $emailUser = $row["email"];
	    $mipassword = $row["password"];
	    $mail = new PHPMailer();
	    $mail->isSMTP();

	    $smtpHost = "localhost";
	    $mail->Host = $smtpHost;
	    $mail->Port = 587;
	    $mail->SMTPAuth = true;
	    $mail->isHTML(true);
	    $mail->CharSet = "utf-8";

	    $smtpUsuario = "test@ctrlztest.com.ar";
	    $smtpClave = "Skorpio123";

	    $emailDestino = $emailUser;

	    $mail->Username = $smtpUsuario;
	    $mail->Password = $smtpClave;
	    $mail->From = $smtpUsuario;
	    $mail->FromName = "Goopzer";
	    $mail->addReplyTo($smtpUsuario, 'Goopzer');
	    $mail->Subject = "Recupero acceso - Mascotas Ya!";
	    $mail->Body = "Hola, recibimos tu pedido de recupero.<br/>
	    Tu contrasenia es: " . $mipassword . "<br/><br/>

	    Muchas gracias por utilizar nuestros servicios!<br/>
	    Mascotas YA!.";
	    $mail->AddAddress($emailDestino, $nameUser);

	    $mail->SMTPOptions = array(
	      'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	      )
	    );
	    $resultadoMail = "";
	    if(!$mail->send()){
	      $resultadoMail = 'Mailer Error: ' . $mail->ErrorInfo;
	    } else {
	      $resultadoMail = 'Message sent!';
	    }

	    delivery_response(200, "event created", $resultadoMail);

	  }
	}
	else
	{
	  delivery_response(400, "Invalid request", NULL);

	}
}

function update_contasenia()
{
	if(!empty($_POST))
	{
		$conn=conectar();
		$nombre_usuario=$_POST['usuario'];
		$hash=$_POST['hash'];
		$new_pass=$_POST['new_pass'];

		$sql_nueva_pass="UPDATE usuarios SET contrasenia='$new_pass', recupero=0, hash_recupero='' WHERE nombre_usuario='$nombre_usuario' AND hash_recupero='$hash'";
		$res=mysqli_query($conn,$sql_nueva_pass);

		if(!$res)
		{
			echo "Error en el recupero de clave, intente nuevamente. Ingrese correctamente los datos";
		}
		else
		{
			echo "Su Clave se ha actualizado con exito";
			loguearse($nombre_usuario, $new_pass);
		}

		//header('Location: index.php');
	}
}

function loguearse($nombre_usuario, $new_pass)
{
	$conn=conectar();
	$sql_usuario="SELECT * from usuario WHERE Email='$nombre_usuario' AND Contrasenia='$new_pass' AND recupero=0";
	$usuario=mysqli_query($conn,$sql_usuario);
	$cant=mysqli_num_rows($usuario);

	if($cant>0)
	{
		session_start();
		$fila=mysqli_fetch_array($usuario);

		if($cant>0)
		{
			session_start();
			$_SESSION['usuario'] = $nombre_usuario;
			$_SESSION['nombrecompleto'] = $fila[1] + " " + $fila[2];
			header('Location: index.php');
		}
		$_SESSION['usuario']=$nombre_usuario;

		header('Location: index.php');
	}

}
/////////////////////////////FIN FUNCIONES DE SISTEMA//////////////////////////////////


?>
