<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Zona de Envío
      <small>Crear</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Zona de Envío</a></li>
      <li class="active">Crear</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-warning col-xs-12">
      <div class="box-body">
        <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="control-label">Nombre</label>
              <div>
                <input type="text" class="form-control" name="nombre" id="inputEmail3" placeholder="Nombre...">
              </div>
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
                  echo "<option value=\"$grupo_id\">
                  $nombre - $$precio
                </option>";

                }
                ?>
              </select>
            </div> 
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">

            <input type="submit" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Zona de Envío" />
            <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Cancelar</a>
          </div><!-- /.box-footer -->
        </form>

      </div><!-- /.box -->
    </div><!-- /.box -->
    
    

    <?php 
    crear_zona_envio();
    include("footer.php");
    ?>
