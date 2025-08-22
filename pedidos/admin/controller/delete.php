<?php

///////////////////////////INCIIO DE METODOS BORRAR////////////////////////////////////
function borrar_pedido($pid)
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');





	if(empty($pid))
	{
		echo "Debe completar todos los datos";
	}
	else
	{

		$conn=conectar();

		$sql = "DELETE FROM productopedido
		where productopedidoid = " . $pid . ";";

		$resultado=mysqli_query($conn,$sql);

		$sql = "DELETE FROM pedido
		where pedidoid = " . $pid . ";";

		$resultado=mysqli_query($conn,$sql);

		if(!$resultado)
		{
			echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
		}
		else
		{
			include("partials/delete_success_msg.php");
		}
	}

	
}

function borrar_producto()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{

		$productoid = $_POST['productoid'];
		

		if(empty($_POST['productoid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			
			$conn=conectar();

			$sql = "DELETE FROM producto
			where productoid = " . $productoid . ";";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/delete_success_msg.php");
			}
		}
		
	}
}


function borrar_usuario()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{

		$usuarioid = $_POST['usuarioid'];
		

		if(empty($_POST['usuarioid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			
			$conn=conectar();

			$sql = "DELETE FROM productopedido where pedidoid in (select pedidoid from pedido where usuarioid in (select usuarioid from usuario
			where UsuarioId = " . $usuarioid . "));";

			$resultado=mysqli_query($conn,$sql);

			$sql1 = "DELETE from pedido where usuarioid in (select usuarioid from usuario
			where UsuarioId = " . $usuarioid . ");";

			$resultado1=mysqli_query($conn,$sql1);


			$sql2 = "DELETE FROM usuario
			where UsuarioId = " . $usuarioid . ";";

			$resultado2=mysqli_query($conn,$sql2);

			if(!$resultado2)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysqli_error() . "</p>";
			}
			else
			{
				include("partials/delete_success_msg.php");
			}
		}
		
	}
}

function borrar_categoria()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{

		$categoriaid = $_POST['categoriaid'];
		

		if(empty($_POST['categoriaid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			
			$conn=conectar();

			$sql = "DELETE FROM categoria
			where CategoriaId = " . $categoriaid . ";";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/delete_success_msg.php");
			}
		}
		
	}
}


function borrar_zona_envio()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{

		$zona_id = $_POST['zonaid'];
		

		if(empty($_POST['zonaid']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			
			$conn=conectar();

			$sql = "DELETE FROM zonas_envio
			where ZonaId = ". $zona_id . ";";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/delete_success_msg.php");
			}
		}
		
	}
}


function borrar_grupo_zona_envio()
{
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');

	if(!empty($_POST))
	{

		$id = $_POST['id'];
		

		if(empty($_POST['id']))
		{
			echo "Debe completar todos los datos";
		}
		else
		{
			
			$conn=conectar();

			$sql = "DELETE FROM grupo_zonas_envio
			where id = ". $id . ";";

			$resultado=mysqli_query($conn,$sql);

			if(!$resultado)
			{
				echo "<p class='msge-funciones'>Error en el ingreso de datos " . mysql_error() . "</p>";
			}
			else
			{
				include("partials/delete_success_msg.php");
			}
		}
		
	}
}

function borrar_imagen_categoria($imagen_id){
	$a_reemplazar=array('ñ', ' ');
	$reemplaza_x=array('n', '_');


	$image = getImagenCategoria($imagen_id);

	if (empty($image)){
		echo "No se encontró la imagen";
		return false;
	}


	$conn=conectar();

	$sql = "DELETE FROM categoria_imagen
	where id = " . $imagen_id . ";";

	$resultado=mysqli_query($conn,$sql);

	if(!$resultado)
	{
		echo "Error en el ingreso de datos " . mysql_error() ;
		return;
	}

	//delete image at images/categoria/{catid}/{filename}

	$catid = $image["categoria_id"];
	$filename = $image["filename"];

	$fullpath = "../images/categoria/" . $catid . "/" . $filename;
	unlink($fullpath);
	
	return true;
}




///////////////////////////FIN DE METODOS BORRAR////////////////////////////////////

?>
