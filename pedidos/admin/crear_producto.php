<?php 
include_once("header.php");
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Producto
        <small>Nuevo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
        <li class="active">Crear Producto</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info col-xs-12">

        <!-- /.box-header -->
        <div class="box-body">

          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" name="nombre" id="version" placeholder="Ingrese el nombre..." />
            </div>        
            <div class="form-group">
              <label>Descripcion:</label><br />
              <input class="form-control" type="textarea" name="descripcion" id="descripcion" placeholder="Ingrese una breve descripcion..." />
            </div> 
            <div class="form-group">  
              <label>Categoria:</label> 
              <select class="form-control" name="categoria" id="categoria_id" required>
                <option value="0">Seleccione una categoria...</option>
                <?php

                $conn =conectar();     
                $cdquery="SELECT * FROM categoria";
                $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());

                while ($cdrow=mysqli_fetch_array($cdresult)) {
                  $cdTitle=$cdrow["Nombre"];
                  $cdValue=$cdrow["CategoriaId"];
                  echo "<option value=\"$cdValue\">
                  $cdTitle
                </option>";

              }
              ?>
            </select>
          </div>
          <div class="form-group">  
              <label>Cocinero:</label> 
              <select class="form-control" name="cocinero" id="categoria_id" required>
                <option value="0">Seleccione una cocinero...</option>
                <?php

                $conn =conectar();     
                $cdquery="SELECT * FROM usuario where Permiso = 'cocinero';";
                $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

                while ($cdrow=mysqli_fetch_array($cdresult)) {
                  $cdTitle=$cdrow["Nombre"] . " " . $cdrow["Apellido"];                  
                  $cdValue=$cdrow["UsuarioId"];
                  echo "<option value=\"$cdValue\">
                  $cdTitle
                </option>";

              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Precio:</label>
            <input class="form-control" type="text" name="precio" id="version" placeholder="Ingrese el precio..." />
          </div>        
          <div class="form-group">
          <label>Vegano:</label>
            <input name="vegano" type="checkbox" id="destacado" value="si" />
          </div>
          <div class="form-group">
            <label>Sin Gluten:</label>
            <input name="singluten" type="checkbox" id="destacado" value="si" />
          </div>      
          <div class="form-group">
            <p>S&oacute;lo pueden cargarse im&aacute;genes en formato JPEG,PNG o JPG. Es recomendable que pesen menos de 100KB.</p>
            <div id="filediv"><input name="file[]" type="file" id="file" class="btn btn-default" /></div>
            <br />
            <!--<input type="button" id="add_more" class="upload btn btn-default" value="Agregar mas imagenes" class="btn btn-default"/>-->
          </div>
          <input type="submit" name="submit" value="Crear Producto" class="btn btn-default" />
        </form>
        <a href="index.php">Volver a Página Principal</a><br />
      </div><!--end box info--> 
    </div><!--end col 12-->
    <?php
    crear_producto();

  ?>

  <script type='text/javascript'>
    $(document).ready(function(){
      $('#categoria_id').change(function(){

        $("#subcategoria_id").html("");
        $.ajax({
          url:"GetSubCategoriaByCategoria.php",
          data: { categoria_id: $('#categoria_id').val() },
          type: "POST",
        }).success(function(data){          
          $("#subcategoria_id").append(data);
        });
      });
    });
  </script>
  <script src="js/uploadimages.js"></script>
  <?php 
  include("footer.php");
  ?>
