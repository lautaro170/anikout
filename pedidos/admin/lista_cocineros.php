<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cocineros
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Cocineros</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info">

    <div class="box-body">
      <div class="table-responsive">
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>      
            <th>Apellido</th>      
            
            <th>Lugar de Residencia</th>      
            
            <th>Actualizar</th>           
            <th>Borrar</th>           
          </tr>
        </thead>
        <tbody>
          <?php 
          $conn=conectar();   
          $cdquery="SELECT * from usuario where Permiso = 'cocinero';";

          $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

          while ($cdrow=mysqli_fetch_array($cdresult)) {
            $nombre = $cdrow["Nombre"];
            $apellido = $cdrow["Apellido"];
            $localidad = $cdrow["Localidad"];            
           
            $uid = $cdrow["UsuarioId"];
            ?>
            <tr>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $apellido; ?></td>
            
              <td><?php echo $localidad; ?></td>

              <td><a href="editar_cocinero.php?usuarioid=<?php echo $uid; ?>">Editar</a></td>
              <td><a href="borrar_usuario.php?usuarioid=<?php echo $uid; ?>">Borrar</a></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_cocinero.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Cocinero</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>