<?php
	session_start();
		
	if(isset($_SESSION['usuario_ac']))
	{
		$_SESSION['usuario_ac'] = array();
		session_destroy();
		header('Location: login.php');
	}
	else
	{
		echo "Debe estar logueado para acceder a esta pagina";
		header('Location: login.php');
	}
?>
