<?php
include_once("header.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Cierre De Sistema
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Cierre De Sistema</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php
    editar_cierre_sistema();

     $conn=conectar();
     $cdquery="SELECT * from web_cierre_sistema;";

     $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

     $cdrow=mysqli_fetch_array($cdresult);

     $texto = $cdrow["texto"];
     $desactivar =$cdrow["desactivar"];

     ?>
     <div class="box box-warning col-xs-12">
       <div class="box-body">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="box-body">
              <div class="form-group">
                  <input type="checkbox" id="desactivar" name="desactivar" <?php if($desactivar == 1){ echo 'checked';} ?> >
                  <label for="scales">Desactivar Sistema</label>
              </div>  
              <div class="form-group">
              <label for="exampleInputPassword1">Texto</label>
              <textarea class="form-control textareaAdmin"  name="texto"  id="texto"  title="Debe completar el texto de la seccion" required>
               <?php echo $texto; ?>
              </textarea>
            </div>


            <div class="box-footer clearfix">
              <input type="submit" class="btn btn-sm btn-info btn-flat pull-left" value="Editar" />
              <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Cancel</a>
            </div><!-- /.box-footer -->
          </div><!-- /.box-footer -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.box -->
          <script type="text/javascript"> $(document).ready(function(){
        $('textarea').froalaEditor({
          heightMin: 400,
          imageUploadURL: '/upload_image.php/'
        });


      });
    </script>
    <?php

  include("footer.php");
  ?>
