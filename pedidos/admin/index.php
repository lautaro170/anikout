<?php 
include_once("header.php");
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Administrador
			<small>Listados</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrador</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<?php 
				$conn=conectar();		
				$cdquery="SELECT * from producto;";
				$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
				$prodcount = mysqli_num_rows($cdresult);

				$cdquery="SELECT * from usuario where Permiso = 'usuario';";
				$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
				$clientecount = mysqli_num_rows($cdresult);

				$cdquery="SELECT * from usuario where Permiso = 'cocinero';";
				$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
				$cocinerocount = mysqli_num_rows($cdresult);	

				$cdquery="SELECT * from pedido;";
				$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
				$pedidocount = mysqli_num_rows($cdresult);					

				?>
				<div class="small-box artesana-color-1">
					<div class="inner">
						<h3><?php echo $prodcount; ?></h3>
						<p>Productos</p>
					</div>
					<div class="icon">
						<i class="ion ion-ios-nutrition-outline"></i>
					</div>
					<a href="lista_pedidos.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box artesana-color-2">
					<div class="inner">
						<h3><?php echo $clientecount; ?></h3>
						<p>Clientes</p>
					</div>
					<div class="icon">
						<i class="ion ion-ios-person-outline"></i>
					</div>
					<a href="lista_clientes.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box artesana-color-3">
					<div class="inner">
						<h3><?php echo $cocinerocount; ?></h3>
						<p>Cocineros</p>
					</div>
					<div class="icon">
						<i class="ion ion-ios-flask-outline"></i>
					</div>
					<a href="lista_cocineros.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box artesana-color-4">
					<div class="inner">
						<h3><?php echo $pedidocount; ?></h3>
						<p>Pedidos</p>
					</div>
					<div class="icon">
						<i class="ion ion-ios-cart-outline"></i>
					</div>
					<a href="lista_pedidos.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div><!-- ./col -->
		</div><!-- /.row -->

		<div class="box">
			<div class="box-header">
				<h3 class="box-title">5 productos mas pedidos</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table table-striped">
					<tr>
						<th style="width: 10px">#</th>
						<th>Plato</th>
						<th style="width: 100px">Porcentaje</th>
						<th style="width: 570px"></th>
					</tr>
					<?php
					$cdresult = getTop5();
					$count = 0;
					$totalPedidos = getTotalProductosPedidos();
					while ($cdrow=mysqli_fetch_array($cdresult)) {
						$nombre = $cdrow["nombre"];
						$suma = $cdrow["suma"];
						$count++;
						$porcentaje = round((($suma * 100) / $totalPedidos),2);
						$classColor = "";
						$barColor = "";
						switch ($count) {
							case '1':
							$classColor = "artesana-color-1";
							$barColor = "progress-bar-danger";
								break;
								case '2':
							$classColor = "artesana-color-2";
							$barColor = "progress-bar-yellow";
								break;
								case '3':
							$classColor = "artesana-color-3";
							$barColor = "progress-bar-primary";
								break;
								case '4':
							$classColor = "artesana-color-4";
							$barColor = "progress-bar-success";
								break;
								case '5':
							$classColor = "artesana-color-1";
							$barColor = "progress-bar-yellow";
								break;
							
						}
						?>
						<tr>
							<td><?php echo $count; ?>.</td>
							<td><?php echo $nombre; ?></td>
							<td><span class="badge <?php echo $classColor; ?>"><?php echo $porcentaje; ?>%</span></td>
							<td>
								<div class="progress progress-xs">
									<div class="progress-bar <?php echo $barColor; ?>" style="width: <?php echo $porcentaje; ?>%"></div>
								</div>
							</td>
						</tr>
						<?php
					}
					?>				
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>

<?php
include("footer.php");
?>