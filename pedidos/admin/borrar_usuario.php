<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Borrar Usuario
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Usuario</a></li>
      <li class="active">Borrar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET['usuarioid']))
    {
     $conn = conectar();    
     $cdquery="SELECT * from usuario where UsuarioId = " . $_GET["usuarioid"] . ";";

     $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());

     $cdrow=mysqli_fetch_array($cdresult);
     $nombre = $cdrow["Nombre"];
     $apellido = $cdrow["Apellido"];

     $email = $cdrow["Email"];
     $pass = $cdrow["Contrasenia"];

     ?>
     <div class="box box-warning col-xs-12">
      <div class="box-body">
        <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <input value="<?php echo $_GET["usuarioid"]; ?>" type="hidden" name="usuarioid" />

          <div class="box-body">

            <div class="form-group">
              <label for="inputEmail3" class="control-label">Nombre</label>
              <div>
                <input type="text" class="form-control"  value="<?php echo  $nombre; ?>" name="nombre" disabled/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="control-label">Apellido</label>
              <div>
                <input type="text" class="form-control"  value="<?php echo  $apellido; ?>" name="apellido" disabled/>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="control-label">Email</label>
              <div>
                <input type="text" class="form-control"  value="<?php echo  $email; ?>" name="email" disabled/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="control-label">Contrasenia</label>
              <div>
                <input type="text" class="form-control"  value="<?php echo  $pass; ?>" name="pass" disabled/>
              </div>
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
          if (confirm("El usuario sera borrado definitivamente. Esta de acuerdo?")) {
            $("#btnSubmit").click();
          }
        }
      </script>
      <script type="text/javascript"> $(document).ready(function(){
        $('textarea').froalaEditor({
          heightMin: 400,
          imageUploadURL: '/admin/upload_image.php/'
        });
      });
    </script>

    <?php 
  }
  borrar_usuario();
  include("footer.php");
  ?>
