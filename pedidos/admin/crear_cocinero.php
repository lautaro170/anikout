<?php 
include_once("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Cocinero
      <small>Crear</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Cocinero</a></li>
      <li class="active">Crear</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="box box-warning col-xs-12">

      <div class="box-body">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

          <div class="box-body">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Acceso</h3>
            </div><!-- /.box-header -->
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" name="username" class="form-control" id="exampleInputEmail1" placeholder="Ingresar un email...">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contrasenia</label>
              <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresar una contrasenia...">
            </div>       

            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div><!-- /.box-header -->

            <div class="form-group">
              <label>Nombre</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Nombre...">
              </div>
            </div>   
            <div class="form-group">
              <label>Apellido</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="surname" placeholder="Apellido...">
              </div>
            </div>   
            <div class="form-group">
              <label>Direccion</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Direccion...">
              </div>
            </div>  
            <div class="form-group">
              <label>Localidad</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="city" placeholder="Localidad...">
              </div>
            </div>            
            <div class="box-footer clearfix">
              <input type="submit" class="btn btn-sm btn-info btn-flat pull-left" value="Save" />
              <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Cancel</a>
            </div><!-- /.box-footer -->
          </div><!-- /.box-footer -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.box -->
    <?php 
    crear_cocinero();
    include("footer.php");
    ?>