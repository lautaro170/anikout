<?php
include_once("header.php");

$pedidos = getPedidosByUser($_SESSION['u_id_a']);
$cantPedidos = getCantidadPedidos($_SESSION['u_id_a']);


?>
<div class="container" style="background: #f7f7f7;">
	<div class="row">
		<div class="col-sm-4 hidden-xs-down text-center">
			<div class="recuadro">
				<img src="images/logo-login.png" class="img-fluid">
				<p><?php echo $_SESSION['nombrecompleto_a']; ?></p>
			</div>

		</div>
		<div class="col-12 col-sm-8">
			<h2 class="titulo-pedidos">Mis Pedidos (<?php echo $cantPedidos; ?>)</h2>
			<div class="row">

				<?php

				$pedidoOld = "";
				$pedidooldid = 0;
				foreach ($pedidos as $pedidoId => $pedido) {

					$fechaEntrega = getPedidoNombre($pedido["fecha"], $pedidoId)[1];

				?>

					<div class="col-sm-4 old-pedido">
						<h3><?php echo $fechaEntrega; ?></h3>
						<?php
						foreach ($pedido["products"] as $producto) {

							$nombre = $producto["nombre"];
							$chico = $producto["chico"];
							$mediano = $producto["mediano"];
							$grande = $producto["grande"];
							$cantidad = $producto["cantidad"];
							$totalPedido = getPedidoPrecioTotal($pedidoId);

						?>
							<div class="platos">
								<?php
								if ($chico > 0) {
								?>
									<div>
										<p><?php echo $chico . " " .  $nombre; ?> chico </p>
									</div>
								<?php
								}
								if ($mediano > 0) {
								?>
									<div>
										<p> <?php echo $mediano . " " .  $nombre; ?> mediano</p>
									</div>
								<?php
								}
								if ($grande > 0) {
								?>
									<div>
										<p><?php echo $grande . " " .  $nombre; ?> grande</p>
									</div>
								<?php
								}
								if ($cantidad > 0) {
								?>
									<div>
										<p><?php echo $cantidad . " unidad/es de " .  $nombre; ?></p>
									</div>
								<?php
								} ?>
							</div>
						<?php } ?>
						<div>
							<p> Total: <?php echo $totalPedido; ?></p>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


</body>

</html>