<?php

///////////////////////////INICIO DE METODOS CREAR////////////////////////////////////
function crear_pedido($pedido, $nota){

	$conn = conectar();
	session_start();
	$userid = $_SESSION['u_id_a'];
	if($userid !== "0" && $userid !== 0)
	{
		$sql = "INSERT INTO pedido (usuarioid, fecha, armado, nota) VALUES ('$userid',now(),0,'$nota');";
		//return $sql;
		$resultado=mysqli_query($conn, $sql);
		$lastid = mysqli_insert_id($conn);

		for ($i=0; $i < count($pedido); $i++) {

			$pid = $pedido[$i]["productoid"];
			$cant = $pedido[$i]["cantidad"];
			$tamanio = $pedido[$i]["tamanio"];
			switch ($tamanio) {
				case 'chico':
				$sql2 = "INSERT INTO productopedido (pedidoid, productoid, chico) VALUES ('$lastid','$pid','$cant');";
				break;
				case 'mediano':
				$sql2 = "INSERT INTO productopedido (pedidoid, productoid, mediano) VALUES ('$lastid','$pid','$cant');";
				break;
				case 'grande':
				$sql2 = "INSERT INTO productopedido (pedidoid, productoid, grande) VALUES ('$lastid','$pid','$cant');";
				break;
				case 'unidad':
				$sql2 = "INSERT INTO productopedido (pedidoid, productoid, cantidad) VALUES ('$lastid','$pid','$cant');";
				break;

			}

			$resultado2=mysqli_query($conn,$sql2);
		}
		return true;
	}
	else{
		return false;
	}
}

function registrar()
{
	if(!empty($_POST))
	{
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$telefono = $_POST["telefono"];
		$celular = $_POST["celular"];
		$city = $_POST["city"];
		$address = $_POST["address"];
		$timetodeliver = $_POST["timetodeliver"];
		$preferences = $_POST["preferences"];
		$email = $_POST["email"];
		$pass = $_POST["password"];


		if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telefono']) || empty($_POST['city']) || empty($_POST['address']) || empty($_POST['email']) || empty($_POST['password'])|| empty($_POST['timetodeliver']))
		{
			echo "* Todos los campos son obligatorios <script>
			$(\"html, body\").animate({ scrollTop: $(document).height() }, 1000);
			</script>";
		}
		else
		{


			$conn = conectar();


			$sqlcheck = "SELECT * FROM usuario where Email = '" . $email . "';";
			$rescheck=mysqli_query($conn,$sqlcheck);
			$exist = (mysqli_num_rows($rescheck) > 0);

			if($exist)
			{
				echo "<p style='color:red;' >Ya existe un usuario registrado con este email.</p>";
			}
			else
			{

				$sql = "INSERT INTO usuario (Nombre, Apellido, Telefono, Celular, Direccion, Localidad, HorarioEntrega, Email, Contrasenia, Permiso, Recupero, Preferencias) VALUES ('$nombre','$apellido','$telefono','$celular','$address','$city','$timetodeliver','$email','$pass','usuario',0,'$preferences')";



				$resultado=mysqli_query($conn,$sql);
				$new_id= mysqli_insert_id($conn);
				if($new_id == 0)
				{

					return false;
				}
				else
				{

					$_SESSION['u_id_a'] = 0;

					session_start();
					$_SESSION['usuario_a']=$nombre;
					$_SESSION['rol_a']='usuario';
					$nombrecompleto =  $nombre . " " . $apellido;

					$_SESSION['nombrecompleto_a'] = $nombrecompleto;
					$_SESSION['u_id_a'] = mysqli_insert_id($conn);

					header("location: index.php");

				}
			}
		}
	}
}


function crear_cocinero()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$address = $_POST['address'];
		$city = $_POST['city'];

		if(empty($_POST['username']) || empty($_POST['password']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "INSERT INTO usuario (Nombre,Apellido, Direccion, Localidad, Email, Contrasenia, Permiso, Recupero) VALUES ('$name','$surname','$address','$city','$username','$password','cocinero',0)";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/insert_success_msg.php");
			}
		}

	}
}

function crear_categoria()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$nombre = $_POST['nombre'];
		$aclaracion = $_POST['aclaracion'];
		$precio = $_POST['precio'];

		if(empty($_POST['nombre']) || empty($_POST['aclaracion']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn=conectar();

			$sql = "INSERT INTO categoria (Nombre,Aclaracion, Precio) VALUES ('$nombre','$aclaracion','$precio')";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/insert_success_msg.php");
			}
		}

	}
}

function crear_producto()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$nombre = $_POST['nombre'];
		$desc = $_POST['descripcion'];
		$catid = $_POST['categoria'];
		$cocinero = $_POST['cocinero'];
		$precio = $_POST['precio'];


		$vegano = 0;
		if(isset($_POST['vegano']))
		{
			$vegano = 1;
		}

		$singluten = 0;
		if(isset($_POST['singluten']))
		{
			$singluten = 1;
		}

		$errorfile = false;
		$hasFiles = true;
		$pila = array();

		if(empty($_POST['nombre']) || empty($_POST['descripcion'])
		|| empty($_POST['categoria']) || empty($_POST['precio']))
		{

			echo "Debe completar todos los datos";
		}
		else
		{

			$path = '';

			if(count($_FILES['file']['name']) >= 1 && $_FILES['file']['name'][0] != "")
			{

				$target_path_root = "uploads/";

				for ($i = 0; $i < count($_FILES['file']['name']); $i++)
				{

					$validextensions = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");
					$ext = explode('.', basename($_FILES['file']['name'][$i]));
					$file_extension = end($ext);

					$target_path = $target_path_root . md5(uniqid()) . "." . $ext[count($ext) - 1];


					if (($_FILES["file"]["size"][$i] < 100000000) && in_array($file_extension, $validextensions))
					{
						if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path))
						{
							$namefile = $target_path;
							$path = $namefile;
							//array_push($pila, $namefile);

						}
						else
						{
							$errorfile = true;

						}
					}
					else
					{
						$errorfile = true;

					}
				}
			}
			else
			{
				$hasFiles = false;
			}

			if(!$errorfile)
			{

				$conn=conectar();

				$sql = "INSERT INTO producto (nombre, descripcion, categoriaid, vegano, singluten, cocineroid) VALUES ('$nombre','$desc','$catid','$vegano','$singluten','$cocinero');";

				$resultado=mysqli_query($conn,$sql);
				//$lastid = mysqli_insert_id($conn);
				/*
				if($hasFiles)
				{
				foreach ($pila as &$valor) {

				$sql2 = "INSERT INTO fotoproducto (PathFoto, ProductoId) VALUES ('$valor','$lastid');";
				$resultado2 = mysql_query($sql2);
			}
		}
		*/
		if(!$resultado)
		{
			echo "<p class='msge-funciones'>Error en el ingreso de datos</p>";
		}
		else
		{
			echo "<p class='msge-funciones'>Datos ingresados correctamente!</p>";
		}
	}
	else
	{
		echo "<p class='msge-funciones'>Error con los tamaños o tipo de archivo</p>";
	}
}
}
}

function crear_solapa()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{
		$tab = $_POST['tab'];
		$descripcion = $_POST['descripcion'];



		if(empty($_POST['tab']) || empty($_POST['descripcion']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{

			$conn = conectar();

			$sql = "INSERT INTO campo (Descripcion,TipoId,SeccionId,TituloTab) VALUES ('$descripcion','10','3','$tab')";

			$resultado=mysqli_query($conn, $sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/insert_success_msg.php");
			}
		}

	}
}

///////////////////////////FIN DE METODOS CREAR////////////////////////////////////

?>
