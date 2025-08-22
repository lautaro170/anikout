<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Grupo Zonas de Envío
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Grupo Zonas de Envío</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET["id"]))
    {
      $conn =conectar();   
      $cdquery="SELECT * from grupo_zonas_envio where id = " . $_GET["id"] . ";";

      $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

      $cdrow=mysqli_fetch_array($cdresult);
      $nombre = $cdrow["nombre"];
      $precio = $cdrow["precio"];
      $id = $cdrow["id"];


      
      ?>
      <div class="box box-warning col-xs-12">
        <div class="box-body">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="version" placeholder="Ingrese el nombre..." />
            </div>        
            <div class="form-group">
              <label>Precio</label><br />
              <input class="form-control" type="textarea" value="<?php echo $precio; ?>" name="precio" id="descripcion" placeholder="Ingrese el precio..." />
            </div> 

            <input type="submit" name="submit" value="Editar Zona de Envío" class="btn btn-default" />
          </form>

        </div><!-- /.box -->
      </div><!-- /.box -->


      <?php 
    }
editar_grupo_zonas_envio();
include("footer.php");
    ?>
