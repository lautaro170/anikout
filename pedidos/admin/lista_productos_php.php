 <?php 

 include_once("header.php");

 ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Productos
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info">

    <div class="box-body">
      <div class="table-responsive">
       <table class="table table-striped" id="prodTable">
        <thead>
          <tr>
            <th>Imagen</th>      
            <th>Nombre</th>                
            <th>Categoria</th>      
            
            <th>Activo</th>      
            
            <th>Actualizar</th>           
           
          </tr>
        </thead>
        <tbody>
          <?php 
          $conn=conectar();   
          $cdquery="SELECT p.productoid, p.imagen, p.nombre as prod, c.nombre as cat, p.activo from producto p inner join categoria c on p.categoriaid = c.CategoriaId;";

          $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

          while ($cdrow=mysqli_fetch_array($cdresult)) {
            $imagen = $cdrow["imagen"];
            $prod = $cdrow["prod"];
            $cat = $cdrow["cat"];            
            $activo = ($cdrow["activo"] == 1) ? "checked" : "";            
            $pid = $cdrow["productoid"];
            ?>
            <tr>
              <td><img src="<?php echo $imagen; ?>" class="img-responsive" width="50px" height="50px" /></td>
              <td><?php echo $prod; ?></td>             
              <td><?php echo $cat; ?></td>
              <td><input type="checkbox" data-id="<?php echo $pid; ?>" class="chk-active" <?php echo $activo; ?>/></td>

              <td><a href="editar_producto.php?productoid=<?php echo $pid; ?>">Editar</a></td>
              
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_producto.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Producto</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>
