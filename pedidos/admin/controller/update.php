<?php

///////////////////////////INCIIO DE METODOS EDITAR////////////////////////////////////
function actualizar_orden_producto($orden,$pid){
	$conn=conectar();

	$sql = "UPDATE producto
	set orden = '$orden'
	where productoid = $pid;";

	$resultado=mysqli_query($conn,$sql);

	return true;

}



function actualizar_estado_producto($pid){

	$conn=conectar();
	$sql = "SELECT activo FROM producto where productoid = " . $pid . ";";
	$resultado=mysqli_query($conn,$sql);
	$cdrow = mysqli_fetch_array($resultado);
	$newValue = ($cdrow["activo"] == 1 ? 0 : 1);
	$sql = "UPDATE producto
	set activo = '$newValue'
	where productoid = $pid;";

	$resultado=mysqli_query($conn,$sql);

	if(!$resultado)
	{
		echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
	}
	else
	{
		include("partials/update_success_msg.php");
	}

}

function actualizar_estado_proxima_producto($pid){

	$conn=conectar();
	$sql = "SELECT activo_proxima_semana as activo FROM producto where productoid = " . $pid . ";";
	echo $sql;
	$resultado=mysqli_query($conn,$sql);
	$cdrow = mysqli_fetch_array($resultado);
	$newValue = ($cdrow["activo"] == 1 ? 0 : 1);
	$sql = "UPDATE producto
	set activo_proxima_semana = '$newValue'
	where productoid = $pid;";

	$resultado=mysqli_query($conn,$sql);

	if(!$resultado)
	{
		echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
	}
	else
	{
		include("partials/update_success_msg.php");
	}

}


function actualizar_estado_pedido($pid){

	$conn=conectar();
	$sql = "SELECT armado FROM pedido where pedidoid = " . $pid . ";";
	$resultado=mysqli_query($conn,$sql);
	$cdrow = mysqli_fetch_array($resultado);
	$newValue = ($cdrow["armado"] == 1 ? 0 : 1);
	$sql = "UPDATE pedido
	set armado = '$newValue'
	where pedidoid = $pid;";

	$resultado=mysqli_query($conn,$sql);

	if(!$resultado)
	{
		echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
	}
	else
	{
		include("partials/update_success_msg.php");
	}

}

function editar_producto()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$pid = $_POST['productoid'];
		$nombre = $_POST['nombre'];
		$desc = $_POST['descripcion'];
		$categoria = $_POST['categoria'];
		$cocinero = $_POST['cocinero'];

		$precio = $_POST['precio'];

		if(isset($_POST['vegano']))
			$vegano = 1;
		else
			$vegano = 0;

		if(isset($_POST['singluten']))
			$singluten = 1;
		else
			$singluten = 0;

		if(isset($_POST['activo']))
			$activo = 1;
		else
			$activo = 0;


		$errorfile = false;
		//$pila = array();
		if(empty($_POST['nombre']) || empty($_POST['descripcion'])
			|| empty($_POST['productoid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$hasnew = false;
			$j = 0;
			$target_path = "uploads/";
			for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

				$validextensions = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");
				$ext = explode('.', basename($_FILES['file']['name'][$i]));
				$file_extension = end($ext);

				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];

				$j = $j + 1;
				if (($_FILES["file"]["size"][$i] < 100000000) && in_array($file_extension, $validextensions)) {
					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
						$hasnew = true;
						$path = $target_path;
						//array_push($pila, $namefile);
					}
					else {
						$errorfile = true;
					}
				}
				else {
					$errorfile = true;
				}

			}
			$conn=conectar();
			if(!$errorfile && $hasnew)
			{
				$sql = "UPDATE producto
				SET nombre = '$nombre',
				descripcion = '$desc',
				imagen = '$path',
				categoriaid = '$categoria',
				vegano = '$vegano',
				singluten = '$singluten',
				activo = '$activo',
				cocineroid = '$cocinero',
				precio = '$precio'
				WHERE productoid = '$pid'";
			}
			else
			{
				$sql = "UPDATE producto
				SET nombre = '$nombre',
				descripcion = '$desc',
				categoriaid = '$categoria',
				vegano = '$vegano',
				singluten = '$singluten',
				activo = '$activo',
				cocineroid = '$cocinero',
				precio = '$precio'
				WHERE productoid = '$pid'";
			}


			$resultado=mysqli_query($conn,$sql);


			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				echo "<p class='msge-funciones'>Datos ingresados correctamente!</p>";
			}

		}
	}
}



function editar_precios()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$precio_chico = $_POST['precio_chico'];
		$precio_mediano = $_POST['precio_mediano'];
		$precio_grande = $_POST['precio_grande'];
		$precio_premium_chico = $_POST['precio_premium_chico'];
		$precio_premium_mediano = $_POST['precio_premium_mediano'];
		$precio_premium_grande = $_POST['precio_premium_grande'];

		if(
			$precio_chico == null ||
			$precio_mediano == null ||
			$precio_grande == null ||
			$precio_premium_chico == null ||
			$precio_premium_mediano == null ||
			$precio_premium_grande == null
		)
		{
			echo "Debe completar todos los datos";
			return;
		}

		if(
			!updatePrecioTamanio($precio_chico, 1, 1) ||
			!updatePrecioTamanio($precio_mediano, 2, 1)||
			!updatePrecioTamanio($precio_grande, 3, 1)||
			!updatePrecioTamanio($precio_premium_chico, 1, 2)||
			!updatePrecioTamanio($precio_premium_mediano, 2, 2)||
			!updatePrecioTamanio($precio_premium_grande, 3, 2)
		){
			echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			return;
		}
		include("partials/update_success_msg.php");

	}
}

function updatePrecioTamanio($precio, $tamanio, $categoriaId): bool{
	$conn= conectar();
	$sql = "UPDATE preciotamanio
		set Precio = '$precio'
		where Tamanio = $tamanio and CategoriaId = $categoriaId;";

	$resultado=mysqli_query($conn,$sql);

	return (bool)$resultado;
}

function editar_cocinero()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$uid = $_POST['usuarioid'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$address = $_POST['address'];
		$city = $_POST['city'];

		if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['usuarioid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE usuario
			set Nombre = '$name',
			Apellido = '$surname',
			Direccion = '$address',
			Localidad = '$city',
			Contrasenia = '$password',
			Email = '$username'
			where UsuarioId = $uid;";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}

function editar_categoria()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$cid = $_POST['categoriaid'];
		$nombre = $_POST['nombre'];
		$aclaracion = $_POST['aclaracion'];
		$precio = $_POST['precio'];


		if(empty($_POST['nombre']) )
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE categoria
			set Nombre = '$nombre',
			Precio = '$precio',
			Aclaracion = '$aclaracion'
			where CategoriaId = '$cid';";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}

function editar_cliente()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$uid = $_POST['usuarioid'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$zona_envio = $_POST['zonaenvio'];
		$telephone = $_POST['telephone'];
		$cellphone = $_POST['cellphone'];
		$horario = $_POST['horario'];
		$delivery = ($_POST['delivery'] == null )? 0 :  $_POST['delivery'];

		if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['usuarioid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE usuario
			set Nombre = '$name',
			Apellido = '$surname',
			Direccion = '$address',
			Localidad = '$city',
			ZonaEnvio = '$zona_envio',
			Contrasenia = '$password',
			HorarioEntrega = '$horario',
			PrecioDelivery = '$delivery',
			Telefono = '$telephone',
			Celular = '$cellphone',
			Email = '$username'
			where UsuarioId = $uid;";
            
			$resultado= mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysqli_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}

function editar_usuario()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$usuarioid = $_POST['usuarioid'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$edad = $_POST['edad'];
		$localidad = $_POST['localidad'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];



		if(empty($_POST['usuarioid']) || empty($_POST['nombre']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE usuario
			set Nombre = '$nombre',
			Apellido = '$apellido',
			Edad = '$edad',
			LugarResidencia = '$localidad',
			Contrasenia = '$pass',
			Email = '$email'
			where UsuarioId = $usuarioid;";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}

function editar_solapa()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$solapaid = $_POST['solapaid'];
		$descripcion = $_POST['descripcion'];
		$tab = $_POST['tab'];



		if(empty($_POST['solapaid']) || empty($_POST['descripcion']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE campo
			set Descripcion = '$descripcion',
			TituloTab = '$tab'
			where CampoId = " . $solapaid . ";";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				echo "<p class='msge-funciones'>Datos actualizados correctamente!</p>";
			}
		}

	}
}

function actualizar_seccion()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST['seccion_id']))
	{
		$seccionid = $_POST['seccion_id'];

		$conn=conectar();

		$cdquery = "SELECT * FROM campo
		WHERE SeccionId = '$seccionid'";


		$cdresult=mysqli_query($conn,$cdquery);


		while ($cdrow=mysqli_fetch_array($cdresult)) {
			$campoid = $cdrow["CampoId"];
			$tipo = $cdrow["TipoId"];
			$value = "";

			if($tipo == 10)
			{
				if(isset($_POST["text" . $campoid]))
				{
					$value = $_POST["text" . $campoid];
					if(!empty($value))
					{
						$sql = "UPDATE campo
						SEt Descripcion = '$value'
						WHERE CampoId = '$campoid'";

						$resultado=mysqli_query($conn,$sql);
					}
				}
			}
			else
			{
				if($tipo == 1)
				{
					echo "<pre>";
					echo "asifsafnfs";
					exit;
					if(isset($_POST["text" . $campoid]))
					{
						$value = $_POST["text" . $campoid];
						if(!empty($value))
						{
							$sql = "UPDATE campo
							SEt Descripcion = '$value'
							WHERE CampoId = '$campoid'";

							$resultado=mysqli_query($conn,$sql);
						}
					}
				}
				else
				{
					echo "<pre>";
					echo "asifsafnfs";
					exit;
					$uploaddir = '../images/';
					if(isset($_FILES))
					{
						$filename = basename($_FILES['imag'.$campoid]['name']);

						if(!empty($filename))
						{
							$uploadfile = $uploaddir . $filename ;


							if (move_uploaded_file($_FILES['imag'.$campoid]['tmp_name'], $uploadfile)) {
								$value = $filename;
								$sql = "UPDATE campo
								SEt Descripcion = '$value'
								WHERE CampoId = '$campoid'";

								$resultado=mysql_query($sql);
							} else {
								echo "Upload failed";
							}
						}
					}

				}

			}

		}

		//header("Location: index.php");


	}
}

function actualizar_galeria()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST['seccion_id']))
	{
		$seccionid = $_POST['seccion_id'];

		$conn=conectar();

		$cdquery = "SELECT * FROM campo
		WHERE SeccionId = '$seccionid'";


		$cdresult=mysqli_query($conn,$cdquery);


		while ($cdrow=mysqli_fetch_array($cdresult)) {
			$campoid = $cdrow["CampoId"];
			$tipo = $cdrow["TipoId"];
			$value = "";


			if($tipo == 1)
			{

				if(isset($_POST["text" . $campoid]))
				{
					$value = $_POST["text" . $campoid];
					if(!empty($value))
					{
						$sql = "UPDATE campo
						SEt Descripcion = '$value'
						WHERE CampoId = '$campoid'";

						$resultado=mysqli_query($sql);
					}
				}
			}
			else
			{

				$uploaddir = '../images/';
				if(isset($_FILES))
				{
					$filename = basename($_FILES['imag'.$campoid]['name']);

					if(!empty($filename))
					{
						$uploadfile = $uploaddir . $filename ;


						if (move_uploaded_file($_FILES['imag'.$campoid]['tmp_name'], $uploadfile)) {
							$value = $filename;
							$sql = "UPDATE campo
							SEt Descripcion = '$value'
							WHERE CampoId = '$campoid'";

							$resultado=mysqli_query($conn,$sql);
						} else {
							echo "Upload failed";
						}
					}
				}

			}



		}

		//header("Location: index.php");


	}
}


function editar_perfil()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$usuarioid = $_POST['usuarioid'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$puesto = $_POST['puesto'];

		if(empty($_POST['usuarioid']) || empty($_POST['nombre']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			$errorfile = false;
			$path = "";
			$hasnew = false;
			$j = 0;     // Variable for indexing uploaded image.

			if($_FILES['file']['name'] != "")
			{
				$target_path = "uploads/";     // Declaring Path for uploaded images.

				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");      // Extensions which are allowed.

				$ext = explode('.', basename($_FILES['file']['name']));   // Explode file name from dot(.)
				$file_extension = end($ext); // Store extensions in the variable.

				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.


				if (($_FILES["file"]["size"][0] < 100000000) && in_array($file_extension, $validextensions))
				{
					if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
					{
						$hasnew = true;
						$path = $target_path;

					}
					else
					{     //  If File Was Not Moved.
						$errorfile = true;
					}
				}
				else
				{     //   If File Size And File Type Was Incorrect.
					$errorfile = true;
				}
			}
			if(!$errorfile)
			{

				$conn=conectar();
				if($hasnew)
				{
					$sql = "UPDATE usuario
					SEt Nombre = '$nombre',
					Apellido = '$apellido',
					Email = '$email',
					Contrasenia = '$pass',
					Puesto = '$puesto',
					profilepic = '$path'
					WHERE UsuarioId = '$usuarioid';";
				}
				else
				{
					$sql = "UPDATE usuario
					SEt Nombre = '$nombre',
					Apellido = '$apellido',
					Email = '$email',
					Puesto = '$puesto',
					Contrasenia = '$pass'
					WHERE UsuarioId = '$usuarioid';";
				}
				$resultado=mysqli_query($conn,$sql);

				if(!$resultado)
				{
					echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
				}
				else
				{
					include("partials/update_success_msg.php");
				}
			}
			else
			{
				echo "<p class='msge-funciones'>Error con los tamaños o tipo de archivo</p>";
			}
		}
	}
}


function editar_zona_envio()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$nombre = $_POST["nombre"];
        $grupo_zona_envio_id = $_POST["grupo_zona_envio_id"];
        $zona_id = $_POST["zonaid"];

		if(empty($_POST['nombre']) )
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE zonas_envio
			set Nombre = '$nombre',
			grupo_zona_envio_id = '$grupo_zona_envio_id'
			where ZonaId = '$zona_id';";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysqli_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}


function editar_cierre_sistema()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$texto = $_POST['texto'];
		$desactivar = ($_POST['desactivar'] == 'on') ? 1 : 0;
        echo $desactivar;

		if(empty($_POST['texto']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE web_cierre_sistema
			set texto = '$texto', desactivar ='$desactivar';";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");

			}
		}

	}
}

function editar_grupo_zonas_envio()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$nombre = $_POST["nombre"];
          $precio = $_POST["precio"];
          $id = $_POST["id"];

		if(empty($_POST['nombre']) )
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "UPDATE grupo_zonas_envio
			set nombre = '$nombre',
			precio = '$precio'
			where id = '$id';";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysqli_error() . "</p>";
			}
			else
			{
				include("partials/update_success_msg.php");
			}
		}

	}
}



function actualizar_estado_categoria($cid){

	$conn=conectar();
	$sql = "SELECT Activo FROM categoria where CategoriaId = " . $cid . ";";
	$resultado = mysqli_query($conn,$sql);
	$cdrow = mysqli_fetch_array($resultado);
	$newValue = ($cdrow["Activo"] == 1 ? 0 : 1);
	$sql = "UPDATE categoria
	set Activo = '$newValue'
	where CategoriaId = $cid;";

	$resultado=mysqli_query($conn,$sql);

	if(!$resultado)
	{
		echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
		return false;
	}
	else
	{
		return true;
	}

}
///////////////////////////FIN DE METODOS EDITAR////////////////////////////////////

?>
