<?php
include_once("header.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Cocinero
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Cocinero</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php
    if(isset($_GET['usuarioid']))
    {
     $conn=conectar();    
     $cdquery="SELECT * from usuario where UsuarioId = " . $_GET["usuarioid"] . ";";

     $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

     $cdrow=mysqli_fetch_array($cdresult);
     $nombre = $cdrow["Nombre"];
     $apellido = $cdrow["Apellido"];
     $address = $cdrow["Direccion"];
     $city = $cdrow["Localidad"];
     $email = $cdrow["Email"];
     $pass = $cdrow["Contrasenia"];

     ?>
     <div class="box box-warning col-xs-12">
       <div class="box-body">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="usuarioid" value="<?php echo $_GET["usuarioid"]; ?>" />
          <div class="box-body">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Acceso</h3>
            </div><!-- /.box-header -->
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" name="username" class="form-control" value="<?php echo $email; ?>" id="exampleInputEmail1" placeholder="Ingresar un email...">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contrasenia</label>
              <input type="text" name="password" class="form-control" value="<?php echo $pass; ?>" id="exampleInputPassword1" placeholder="Ingresar una contrasenia...">
            </div>       

            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div><!-- /.box-header -->

            <div class="form-group">
              <label>Nombre</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $nombre; ?>" name="name" placeholder="Nombre...">
              </div>
            </div>   
            <div class="form-group">
              <label>Apellido</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $apellido; ?>" name="surname" placeholder="Apellido...">
              </div>
            </div>   
            <div class="form-group">
              <label>Direccion</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="address" value="<?php echo $address; ?>" placeholder="Direccion...">
              </div>
            </div>  
            <div class="form-group">
              <label>Localidad</label>
              <div>
                <input type="text" class="form-control" id="inputEmail3" name="city" value="<?php echo $city; ?>" placeholder="Localidad...">
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
  }
  editar_cocinero();
  include("footer.php");
  ?>