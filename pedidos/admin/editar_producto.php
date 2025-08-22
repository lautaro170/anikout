<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Producto
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Producto</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET["productoid"]))
    {
      $conn=conectar();   
      $cdquery="SELECT * from producto p inner join categoria c on p.categoriaid = c.CategoriaId where p.productoid = " . $_GET["productoid"] . ";";

      $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

      $cdrow=mysqli_fetch_array($cdresult);
      $nombre = $cdrow["nombre"];
      $descripcion = $cdrow["descripcion"];
      $imagen = $cdrow["imagen"];
      $categoriaid = $cdrow["categoriaid"];
      $vegano = $cdrow["vegano"];
      $singluten = $cdrow["singluten"];
      $precio = $cdrow["precio"];
      $pid = $cdrow["productoid"];
      $cocineroid = $cdrow["cocineroid"];
      $activo = "";
      if($cdrow["activo"] == 1){
        $activo = "checked";
      }
     
      if($vegano == 0)
      {
        $veg = "";
      }
      else
      {
        $veg = "checked";

      }
      if($singluten == 0)
      {
        $sg = "";
      }
      else
      {
        $sg = "checked";

      }

      
      ?>
      <div class="box box-warning col-xs-12">
        <div class="box-body">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <input type="hidden" name="productoid" value="<?php echo $pid; ?>" />
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="version" placeholder="Ingrese el nombre..." />
            </div>        
            <div class="form-group">
              <label>Descripcion:</label><br />

              <input class="form-control" type="textarea" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" placeholder="Ingrese una breve descripcion..." />
            </div> 
            <div class="form-group">  
              <label>Categoria:</label> 
              <select class="form-control" name="categoria" id="categoria_id" required>
                <option value="0">Seleccione una categoria...</option>
                <?php

                $conn=conectar();     
                $cdquery="SELECT * FROM categoria";
                $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

                while ($cdrow=mysqli_fetch_array($cdresult)) {
                  $cdTitle=$cdrow["Nombre"];
                  $cdValue=$cdrow["CategoriaId"];
                  if($cdValue == $categoriaid)
                  {
                    echo "<option value=\"$cdValue\" selected>
                    $cdTitle
                  </option>";
                }else{
                 echo "<option value=\"$cdValue\" >
                 $cdTitle
               </option>";
             }

           }
           ?>
         </select>
       </div>
        <div class="form-group">  
              <label>Cocinero:</label> 
              <select class="form-control" name="cocinero" required>
                <option value="0">Seleccione una cocinero...</option>
                <?php

                $conn=conectar();     
                $cdquery="SELECT * FROM usuario where Permiso = 'cocinero';";
                $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

                while ($cdrow=mysqli_fetch_array($cdresult)) {
                  $cdTitle=$cdrow["Nombre"] . " " . $cdrow["Apellido"];                  
                  $cdValue=$cdrow["UsuarioId"];
                 if($cdValue == $cocineroid)
                  {
                    echo "<option value=\"$cdValue\" selected>
                    $cdTitle
                  </option>";
                }else{
                 echo "<option value=\"$cdValue\">
                 $cdTitle
               </option>";
             }

              }
              ?>
            </select>
          </div>
       <div class="form-group">
        <label>Precio:</label>
        <input class="form-control" type="text" value="<?php echo $precio; ?>" name="precio" id="version" placeholder="Ingrese el precio..." />
      </div>        
      <div class="form-group">
        <label>Vegano:</label>
        <input name="vegano" type="checkbox" id="destacado" value="si" <?php echo $veg; ?>/>
      </div>
      <div class="form-group">
        <label>Sin Gluten:</label>
        <input name="singluten" type="checkbox" id="destacado" value="si"  <?php echo $sg; ?>/>
      </div> 
      <div class="form-group" style="background-color: #ccc">
        <label>Activo:</label>
        <input name="activo" type="checkbox" value="si"  <?php echo $activo; ?>/>
      </div> 
      <div class="form-group">
        <p>S&oacute;lo pueden cargarse im&aacute;genes en formato JPEG,PNG o JPG. Es recomendable que pesen menos de 100KB.</p>
        <div id="filediv">
          <img id="previewimg<?php echo $fotoid; ?>" src="<?php echo $imagen; ?>">
          <input name="file[]" type="file" id="file" class="btn btn-default" /></div>
          <br />
          <!--<input type="button" id="add_more" class="upload btn btn-default" value="Agregar mas imagenes" class="btn btn-default"/>-->
        </div>
        <input type="submit" name="submit" value="Editar Producto" class="btn btn-default" />
      </form>

    </div><!-- /.box -->
  </div><!-- /.box -->
  <script type="text/javascript"> $(document).ready(function(){
    $('textarea').froalaEditor({
      heightMin: 400,
      imageUploadURL: '/admin/upload_image.php/'
    });

    $('textarea .frases-medium').froalaEditor({
      heightMin: 200,
      imageUploadURL: '/admin/upload_image.php/'
    });
  });
</script>

<?php 
}
editar_producto();
include("footer.php");
?>
