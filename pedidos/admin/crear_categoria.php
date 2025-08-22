<?php 

include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Categoria
      <small>Crear</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Categoria</a></li>
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
              <label for="inputEmail3" class="control-label">Aclaracion</label>
              <div>
                <input type="text" class="form-control" name="aclaracion" id="inputEmail3" placeholder="Aclaracion...">
              </div>
            </div>
            <div class="form-group">
              <label>Precio:</label>
              <input class="form-control" type="text" name="precio" id="version" placeholder="Ingrese el precio..." />
            </div>   
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">

            <input type="submit" class="btn btn-sm btn-info btn-flat pull-left" value="Crear Categoria" />
            <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Cancelar</a>
          </div><!-- /.box-footer -->
        </form>

      </div><!-- /.box -->
    </div><!-- /.box -->
    
    

    <?php 
    crear_categoria();
    include("footer.php");
    ?>
