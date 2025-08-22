<?php session_start();
setlocale(LC_ALL,"es_ES");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css?v=4">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,800" rel="stylesheet">

	<link rel="icon" href="../favicon.png" type="image/x-icon" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" >
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-lightbox/dist/css/splide-extension-lightbox.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

	<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-lightbox"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    
    <!-- Meta Pixel Code -->
    <meta name="facebook-domain-verification" content="v7lem35jeksxtp3yxcajdqd6dzfppy" />
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1576308412985562');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1576308412985562&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<?php

include_once("admin/controller/funciones.php");
?>
<body id="body-pedido">
    <a href="https://wa.me/541145586179" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
	<div style="margin-bottom:120px" class="container-fluid">
		<nav class="navbar navbar-toggleable-md navbar-light bg-faded container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#"><img src="images/logo-login.png" class="img-fluid"></a>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<ul class="navbar-nav ml-auto">
				    <li class="nav-item">
						<a class="nav-link" href="https://www.anikout.com.ar">Ir a la Web</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="index.php">Hacer Pedido</a>
					</li>
					<?php
					if(isset($_SESSION['u_id_a']))
					{
						?>
                    	<li class="nav-item">
        					<a class="nav-link" href="mispedidos.php">Mis Pedidos</a>					
        				</li>

						<li class="nav-item">
							<a class="nav-link" href="cerrar.php">Cerrar Sesi&oacute;n</a>					
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#"><?php echo $_SESSION['nombrecompleto_a']; ?></a>
						</li>	
						<?php				
					}else { ?>
                        <li class="nav-item">
							<a class="nav-link" href="login.php">Mi Cuenta</a>
						</li>
					<?php }
					?>
				</ul>
			</div>
		</nav>