<?php 
include_once("header.php");
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Lista Productos activos
			<small>Listados</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrador</li>
		</ol>
	</section>
	<!-- Main content
  $date = date("Y-m-d H:i:s");
     $nameOfDay = date('D', strtotime($date));
     echo $nameOfDay;

   -->
   <section class="content">
     <div class="box">

       <div class="box-header">
        <h3 class="box-title">Pedido - <?php echo getPedidoActualNombre(); ?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">

          <tr>
            <th>Categoria</th>
            <th>Imagen</th>
            <th>Nombre</th>
          </tr>
          <?php

          $categorias = getAllCategorias();

          while ($cat=mysqli_fetch_array($categorias)) {
            $catid = $cat["CategoriaId"];
            $nom = $cat["Nombre"];
            $acl = $cat["Aclaracion"];    
            ?>

            <tr id="<?php echo $catid; ?>" >     
              <td>
              <h3><?php echo $nom; ?></h3>  
              </td>
              <td>

              </td>
               <td>

              </td>
            </tr>

            <?php
            $productos = getProductsByCategory($catid);
            foreach( $productos as $prod ) {
              $prodid = $prod["productoid"];
              $nombre = $prod["nombre"];
              $desc = $prod["descripcion"];
              $imagen = "../" . $prod["imagen"];
              $vegano = $prod["vegano"];
              $singluten = $prod["singluten"];      
              $precio = $prod["precio"];      
              ?>
              <tr>
              <td></td>
               <td><img src="<?php echo $imagen; ?>" class="img-responsive" width="50px" height="50px" /></td>
               <td><?php echo $nombre; ?></td>
             </tr>  
             <?php
           }
           ?>
         </div>
       </div>
     </section>
     <?php
   }
   ?>          
 </table>
</div>
<!-- /.box-body -->
</div>
<?php
include("footer.php");
?>
