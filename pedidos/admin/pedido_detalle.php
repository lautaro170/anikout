 <?php 

 include_once("header.php");

 ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pedido Detalle
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Pedido Detalle</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info">
    <?php 
    if(isset($_GET["pedidoid"])){


      ?>
      <div class="box-body">
        <div class="table-responsive">
         <table class="table table-striped">
          <thead>
            <tr>
              <th>Imagen</th>      
              <th>Nombre</th>                
              <th>Categoria</th>      
              <th>Vegano</th>      
              <th>Sin Gluten</th>      

              <th>Chico</th>           
              <th>Mediano</th>           
              <th>Grande</th>           
            </tr>
          </thead>
          <tbody>
            <?php 
            $cdresult = getPedidoDetalle($_GET["pedidoid"]);

            $cdrow=mysqli_fetch_array($cdresult);           

            while ($cdrow=mysqli_fetch_array($cdresult)) {
              $imagen = $cdrow["imagen"];
              $prod = $cdrow["prod"];
              $cat = $cdrow["cat"];            
              $vegano = $cdrow["vegano"];            
              $singluten = $cdrow["singluten"];            
              $chico = $cdrow["chico"];            
              $mediano = $cdrow["mediano"];            
              $grande = $cdrow["grande"];            

              
              ?>
              <tr>
                <td><img src="<?php echo $imagen; ?>" class="img-responsive" width="50px" height="50px" /></td>
                <td><?php echo $prod; ?></td>             
                <td><?php echo $cat; ?></td>
                <td><?php if($vegano == 1) echo "Si"; else echo "No"; ?></td>
                <td><?php if($singluten == 1) echo "Si"; else echo "No"; ?></td>
                <td><?php echo $chico; ?></td>
                <td><?php echo $mediano; ?></td>
                <td><?php echo $grande; ?></td>
                
              </tr>
              <?php 
            }
            ?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <?php
  }
  ?>
  <div class="box-footer clearfix">
    <a href="lista_pedidos_cliente.php" class="btn btn-sm btn-info btn-flat pull-left">Volver al listado</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>
