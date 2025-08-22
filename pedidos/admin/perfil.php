<?php 
include_once("header.php");
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Perfil
			<small>Administrador</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Perfil</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<?php 

		$cdrow = traer_usuario($_SESSION['u_id']);
		
		
		$usuarioid = $cdrow["UsuarioId"];
		$nombre = $cdrow["Nombre"];
		$apellido = $cdrow["Apellido"];
		$nombrecompleto = $nombre . " " . $apellido;
		$email = $cdrow["Email"];
		$pass = $cdrow["Contrasenia"];

		$puesto = $cdrow["Puesto"];
		$path = $cdrow["profilepic"];
		?>

		<!-- Widget: user widget style 1 -->

		<div class="box box-info col-xs-12">
			<div class="box-body">
				<div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
						<h3 class="widget-user-username"><?php echo $nombrecompleto; ?></h3>
						<h5 class="widget-user-desc"><?php echo $puesto; ?></h5>
					</div>
					<div class="widget-user-image">
						<?php
						if($path != "")
						{
							?>
							<img class="img-circle" src="<?php echo $path; ?>" alt="User Avatar">
							<?php
						}
						else
						{
							?>
							<img class="img-circle" src="dist/img/user8-128x128.jpg" alt="User Avatar">
							<?php	
						}
						?>
						<div class="profile-pic-hover" id="dvCambiar" ><a id="linkpic">Cambiar</a></div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header">3,200</h5>
									<span class="description-text">SALES</span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header">13,000</h5>
									<span class="description-text">FOLLOWERS</span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<div class="col-sm-4">
								<div class="description-block">
									<h5 class="description-header">35</h5>
									<span class="description-text">PRODUCTS</span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>
				</div><!-- /.widget-user -->
				<form enctype="multipart/form-data" class="form-horizontal" action="perfil.php" method="post">
					<div class="box-body">
						

						<input type="hidden" name="usuarioid" value="<?php echo $usuarioid; ?>" name="movimientoid" />
						<div class="form-group">
							<label>Nombre</label>
							<div>
								<input type="text" class="form-control" id="inputEmail3" value="<?php echo $nombre; ?>" name="nombre" placeholder="Nombre">
							</div>
						</div>
						<div class="form-group">
							<label>Apellido</label>
							<div>
								<input type="text" class="form-control" id="inputEmail3" value="<?php echo $apellido; ?>" name="apellido" placeholder="Apellido">
							</div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<div>
								<input type="text" class="form-control" id="inputEmail3" value="<?php echo $email; ?>" name="email" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<div>
								<input type="text" class="form-control" value="<?php echo $pass; ?>" id="inputEmail3" name="pass" placeholder="Contraseña">
							</div>
						</div>
						<div class="form-group">
							<label>Puesto</label>
							<div>
								<input type="text" class="form-control" value="<?php echo $puesto; ?>" id="inputEmail3" name="puesto" placeholder="Puesto">
							</div>
						</div>
						<input name="file" type="file" id="file" class="btn btn-default" style="display: none;" >
					</div><!-- /.box-body -->
					<div class="box-footer clearfix">
						<input type="submit" class="btn btn-sm btn-info btn-flat pull-left" value="Guardar" />
						<a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Ir al Inicio</a>
					</div><!-- /.box-footer -->
				</form>

			</div><!-- /.box -->
		</div><!-- /.box -->
		<script>
			$(document).ready(function(){
				$(".widget-user-image").hover(function() {
					$("#dvCambiar").show();
				},
				function() {
					$("#dvCambiar").hide();
				});

				$("#linkpic").click(function(){
					$("#file").click();
				});

			});
		</script>

		<?php	
		editar_perfil();
		include("footer.php");
		?>