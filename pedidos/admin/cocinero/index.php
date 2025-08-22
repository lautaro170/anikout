<?php 
include_once("header.php");
$today = date("Y-m-d");

?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Administrador
			<small>Listados</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Administrador</li>
		</ol>
	</section>

 <section class="content">
   <div class="box">

     <div class="box-header">
    </div>
       <table class="table table-striped" id="table-pedido">
           <thead>
           <tr>
               <th>Pedido</th>
               <th>Cocinero</th>
               <th>Plato</th>
               <th>Descripción</th>
               <th>Chico / Cantidad</th>
               <th>Mediano</th>
               <th>Grande</th>
           </tr>
           </thead>
           <tbody>
           <?php
           $conn =conectar();


           $resultPedidos = getPedidoActualxCocinero($_SESSION['u_id_ac']);

           $stateName = "";
           $user = 0;
           $acumChico = 0;
           $acumMediano = 0;
           $acumGrande = 0;
           $acumCantidad = 0;
           $oldCat = 0;
           $oldCook = 0;
           $lastCat = 0;
           $lastId = 0;


           while($row= mysqli_fetch_assoc($resultPedidos)){
               $productoId = $row["productoid"];
               $nombre = $row["nombre"];
               $descripcion = $row["descripcion"];
               $cook = $row["cook"];
               $cookId = $row["cookid"];
               $chico = $row["chico"];
               $mediano = $row["mediano"];
               $grande = $row["grande"];
               $cantidad = $row["cantidad"];
               $catId = $row["catid"];
               $fecha_entrega = $row["fecha_entrega"];
               $lastCat = $catId;
               $lastCookId = $cookId;

               ?>

               <?php
               if($oldCat != $catId || $oldCook != $cookId){
                   if($oldCat != 0){
                       ?>
                       <tr style="border-top: solid;">
                           <td></td>
                           <td></td>
                           <td><strong>Total : <?php ($oldCat == 1 || $oldCat == 2) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
                                  <td></td>
                                   <?php
                                   if($oldCat == 1 || $oldCat == 2){
                                       ?>
                                       <td>
                                           <?php
                                           echo $acumChico;
                                           ?>
                                       </td>
                                       <td>
                                           <?php
                                           echo $acumMediano;
                                           ?>
                                       </td>
                                       <td>
                                           <?php
                                           echo $acumGrande;
                                           ?>
                                       </td>
                                       <?php
                                   }else{
                                       ?>
                                       <td>
                                           <?php
                                           echo $acumCantidad;
                                           ?>
                                       </td>
                                       <?php
                                   }

                                   ?>
                               </strong></td>
                       </tr>
                       <?php
                       $acumChico = 0;
                       $acumMediano = 0;
                       $acumGrande = 0;
                       $acumCantidad = 0;
                   }
                   $oldCat = $catId;
                   $oldCook = $cookId;
               } //if


               if($catId == 1 || $catId == 2){
                   $acumGrande += $grande;
                   $acumMediano += $mediano;
                   $acumChico += $chico;
               }
               else{
                   $acumCantidad += $cantidad;
               }
               ?>

               <?php //fila fecha entrega
               if($fecha_entrega_anterior != $fecha_entrega){
                   $fecha_entrega_anterior = $fecha_entrega;

                   ?>
                   <tr style="border-top: solid; background:lemonchiffon;">
                       <td>
                           <?php echo $fecha_entrega; ?>
                       </td>
                       <td colspan="6"></td>
                   </tr>
                   <?php
               }//if
               ?>

               <?php //fila nombre cocinero
               if($cookId_anterior != $cookId){
                   $cookId_anterior = $cookId;
                   ?>
                   <tr style="border-top:2px solid grey">
                       <td></td>
                       <td colspan="5">
                           <?php echo $cook; ?>
                       </td>
                   </tr>
                   <?php
               }
               ?>

               <tr>
                   <td></td>
                   <td></td>
                   <td>
                       <?php echo $nombre; ?>
                   </td>
                   <td><?php echo $descripcion;?></td>
                   <?php if($catId == 1 || $catId == 2){ ?>
                       <td><?php echo $chico;?></td>
                       <td><?php echo $mediano;?></td>
                       <td><?php echo $grande;?></td>
                   <?php } //if
                   else{
                       ?>
                       <td><?php echo $cantidad; ?></td>
                       <td colspan="2"></td>
                       <?php

                   }
                   ?>
               </tr>


           <?php }//while
           if($lastCat == $oldCat){
               ?>
               <tr style="border-top: solid;">
                   <td></td>
                   <td></td>
                   <td><strong>Total : <?php ($lastCat == 1 || $lastCat == 2) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
                          <td></td>
                           <?php
                           if($oldCat == 1 || $oldCat == 2){
                               ?>
                               <td>
                                   <?php
                                   echo $acumChico;
                                   ?>
                               </td>
                               <td>
                                   <?php
                                   echo $acumMediano;
                                   ?>
                               </td>
                               <td>
                                   <?php
                                   echo $acumGrande;
                                   ?>
                               </td>
                               <?php
                           }else{
                               ?>
                               <td>
                                   <?php
                                   echo $acumCantidad;
                                   ?>
                               </td>
                               <?php
                           }

                           ?>
                       </strong></td>
               </tr>
               <?php
           }
           ?>

           </tbody>
       </table>


    <?php /*
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <table class="table table-striped">

        <tr>
          <th>Categoria</th>
          <th>Plato</th>
          <th>Descripcion</th>
          <th>Cantidad Chico/Cantidad</th>
          <th>Cantidad Mediano</th>
          <th>Cantidad Grande</th>
        </tr>
        <?php
        $result = getPedidoActualxCocinero($_SESSION['u_id_ac']);
        //echo $result;
        $oldCat = "";
        $oldCatId = 0;
        $acumChico = 0;
        $acumMediano = 0;
        $acumGrande = 0;
        $acumCantidad = 0;
        $firstCat = 0;
        while ($cdrow=mysqli_fetch_array($result)) {
          $pid = $cdrow["productoid"];
          $nombre = $cdrow["nombre"];
          $desc = $cdrow["descripcion"];
          $chico = $cdrow["chico"];
          $mediano = $cdrow["mediano"];
          $grande = $cdrow["grande"];
          $cantidad = $cdrow["cantidad"];
          $cat = $cdrow["cat"];
          $catid = $cdrow["catid"];
          $firstCat = $catid;

          if($oldCat != "" && $oldCat != $cat){

            if($oldCatId == 1 || $oldCatId == 2)
            {
              ?>
              <tr> 
                <td></td>  
                <td></td>  
                <td><strong>Total:</strong></td>  
                <td><strong><?php echo $acumChico;?></strong></td> 
                <td><strong><?php echo $acumMediano; ?></strong></td>              
                <td><strong><?php echo $acumGrande; ?></strong></td>
              </tr>        
              <?php
            }
            else
            {
              ?>
              <tr>   
                <td></td>  
                <td></td>  
                <td><strong>Total:</strong></td> 
                <td><strong><?php echo $acumCantidad;?></strong></td>
                <td></td>
                <td></td>            
              </tr>              
              <?php
            }

            $acumChico = 0;
            $acumMediano = 0;
            $acumGrande = 0;
            $acumCantidad = 0;
          }
          if($oldCat != $cat){
            $oldCat = $cat;
            $oldCatId = $catid;
            ?>
            <tr>
              <td><?php echo $cat; ?></td>      
              <td colspan="4"></td>        
            </tr>
            <?php
          }

          ?>
          <tr>
            <td></td>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $desc; ?></td>
            <?php 
            if($catid == 1 || $catid == 2){
              ?>
              <td>
                <?php
                echo $chico;
                ?>
              </td>
              <td><?php echo $mediano; ?></td>
              <td><?php echo $grande; ?></td>
              <?php 
            }
            else{
              ?>
              <td>
                <?php
                echo $cantidad;
                ?>
              </td>
              <td colspan="2"></td>
              <?php 
            }
            ?>

          </tr>   
          <?php
          $acumChico = ($acumChico + $chico);
          $acumMediano = ($acumMediano + $mediano);
          $acumGrande = ($acumGrande + $grande);
          $acumCantidad = ($acumCantidad + $cantidad);
        }

        if($firstCat == 1 || $firstCat == 2)
        {
          ?>
          <tr> 
            <td></td>  
            <td></td>  
            <td><strong>Total:</strong></td>  
            <td><strong><?php echo $acumChico;?></strong></td> 
            <td><strong><?php echo $acumMediano; ?></strong></td>              
            <td><strong><?php echo $acumGrande; ?></strong></td>
          </tr>        
          <?php
        }
        else
        {
          ?>
          <tr>   
            <td></td>  
            <td></td>  
            <td><strong>Total:</strong></td> 
            <td><strong><?php echo $acumCantidad;?></strong></td>
            <td></td>
            <td></td>            
          </tr>              
          <?php
        }
        ?>             
      </table>
    </div>
    */ ?>
    <!-- /.box-body -->
  </div>
  <?php
  include("footer.php");
  ?>
