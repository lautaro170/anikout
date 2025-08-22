<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Borrar Categoria
      <small>Borrar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Categoria</a></li>
      <li class="active">Borrar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET["categoriaid"]))
    {
      $conn = conectar();   
      $cdquery="SELECT * from categoria where CategoriaId = " . $_GET["categoriaid"] . ";";

      $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());

      $cdrow=mysqli_fetch_array($cdresult);
      $nombre = $cdrow["Nombre"];
      $aclaracion = $cdrow["Aclaracion"];
      $cid = $cdrow["CategoriaId"];
      //$precio = $cdrow["Precio"];


      
      ?>
      <div class="box box-warning col-xs-12">
        <div class="box-body">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <input type="hidden" name="categoriaid" value="<?php echo $cid; ?>" />
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="version" placeholder="Ingrese el nombre..." disabled/>
            </div>        
            <div class="form-group">
              <label>Aclaraci&oacute;n:</label><br />

              <input class="form-control" type="textarea" value="<?php echo $aclaracion; ?>" name="aclaracion" id="descripcion" placeholder="Ingrese una aclracion..."  disabled/>
            </div>            

            <div class="box-footer clearfix">
              <input type="submit" style="display:none;" id="btnSubmit" name="submit" value="Borrar Usuario" />
              <input type="button" class="btn btn-sm btn-info btn-flat pull-left" id="btnBorrar" value="Borrar Usuario" onclick="confirmDelete();" /> 
              <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Cancelar</a>
            </div><!-- /.box-footer -->
          </form>

        </div><!-- /.box -->
      </div><!-- /.box -->
      <script>
        function confirmDelete() {
          if (confirm("La categoria sera borrado definitivamente. Esta de acuerdo?")) {
            $("#btnSubmit").click();
          }
        }
      </script>

      <?php 
    }
    borrar_categoria();
    include("footer.php");
    ?>
