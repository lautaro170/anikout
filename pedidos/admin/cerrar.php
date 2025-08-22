<?php
	session_start();
		
	if(isset($_SESSION['usuario_ad']))
	{
		$_SESSION['usuario_ad'] = array();
		session_destroy();
		header('Location: index.php');
	}
	else
	{
		echo "Debe estar logueado para acceder a esta pagina";
		header('Location: index.php');
	}
?>
