<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Zonas De Envío
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Zonas De Envío</a></li>
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
            <th>Precio</th>   
            <th>Grupo</th>      

            <th>Actualizar</th>           
            <th>Borrar</th>           
          </tr>
        </thead>
        <tbody>
          <?php 
          //$conn=conectar();   
          //$cdquery="SELECT * from zonas_envio;";

          //$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());
            $cdresult= getZonasEnvioAdmin();
          while ($cdrow=mysqli_fetch_array($cdresult, MYSQLI_ASSOC)) {
            $nombre = $cdrow["Nombre"];
            $precio = $cdrow["precio"];
            $grupo_nombre = $cdrow["nombre_grupo"];

            $zona_id = $cdrow["ZonaId"];
            ?>
            <tr>
              <td><?php echo $nombre; ?></td>
              <td>$<?php echo $precio; ?></td>
              <td><?php echo $grupo_nombre; ?></td>


              <td><a href="editar_zona_envio.php?zonaid=<?php echo $zona_id; ?>">Editar</a></td>
              <td><a href="borrar_zona_envio.php?zonaid=<?php echo $zona_id; ?>">Borrar</a></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_zona_envio.php" class="btn btn-sm btn-info btn-flat pull-left">Nueva Zona de Envíos</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>