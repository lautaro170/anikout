<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Zona de Envío
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Zona de Envío</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET["zonaid"]))
    {
      $conn =conectar();   
      $cdquery="SELECT * from zonas_envio where ZonaId = " . $_GET["zonaid"] . ";";

      $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

      $cdrow=mysqli_fetch_array($cdresult);
      $nombre = $cdrow["Nombre"];
      $zona_envio_grupo_id = $cdrow["grupo_zona_envio_id"];
      $zona_id = $cdrow["ZonaId"];


      
      ?>
      <div class="box box-warning col-xs-12">
        <div class="box-body">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <input type="hidden" name="zonaid" value="<?php echo $zona_id; ?>" />
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="version" placeholder="Ingrese el nombre..." />
            </div>      
             <div class="form-group">  
              <label>Grupo:</label> 
              <select class="form-control" name="grupo_zona_envio_id" id="grupo_zona_envio_id" required>
                <option value="0" disabled>Seleccione un grupo...</option>
                <?php

                $all_grupos_query = getGruposZonasEnvio();
                while ($cdrow=mysqli_fetch_array($all_grupos_query)) {
                  $nombre =$cdrow["nombre"];
                  $grupo_id =$cdrow["id"];
                  $precio = $cdrow["precio"];
                  $is_selected = ($zona_envio_grupo_id == $grupo_id) ? "selected" : "";
                  echo "<option value=\"$grupo_id\" $is_selected >
                  $nombre - $$precio
                </option>";

              }
              ?>
            </select>
          </div>
            <input type="submit" name="submit" value="Editar Zona de Envío" class="btn btn-default" />
          </form>

        </div><!-- /.box -->
      </div><!-- /.box -->


      <?php 
    }
editar_zona_envio();
include("footer.php");
    ?>
