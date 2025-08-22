<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Grupos Zonas De Envío
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Grupos Zonas De Envío</a></li>
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
            <th>Actualizar</th>           
            <th>Borrar</th>           
          </tr>
        </thead>
        <tbody>
          <?php 
          $conn=conectar();   
          $cdquery="SELECT * from grupo_zonas_envio;";

          $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

          while ($cdrow=mysqli_fetch_array($cdresult, MYSQLI_ASSOC)) {
            $nombre = $cdrow["nombre"];
            $precio = $cdrow["precio"];
           
            $id = $cdrow["id"];
            ?>
            <tr>
              <td><?php echo $nombre; ?></td>
              <td>$<?php echo $precio; ?></td>


              <td><a href="editar_grupo_zonas_envio.php?id=<?php echo $id; ?>">Editar</a></td>
              <td><a href="borrar_grupo_zonas_envio.php?id=<?php echo $id; ?>">Borrar</a></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_grupo_zonas_envio.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Grupo Zonas de Envíos</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>