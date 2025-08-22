<?php include_once("header.php"); ?>
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Pedidos
       <small>Listado</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Pedido</a></li>
       <li class="active">Listado</li>
     </ol>
   </section>
   <!-- Main content -->
   <section class="content">

     <!-- TABLE: LATEST ORDERS -->

     <div class="box box-info">

       <div class="box-body">
         <div class="table-responsive">
           <table class="table table-striped" id="table-pedido">
             <thead>
               <tr>
                 <th>Usuario</th>
                 <th>Total</th>
                 <th>Armado</th>
               </tr>
             </thead>
             <tbody>
               <?php

                $conn = conectar();
                $cdquery = "SELECT p.pedidoid,u.Nombre, u.Apellido, u.Preferencias as preferencias, p.fecha,p.armado, COUNT(pp.pedidoid) as cant, u.UsuarioId, p.nota FROM pedido p
          left join usuario u on p.usuarioid = u.UsuarioId
          inner join productopedido pp on pp.pedidoid = p.pedidoid
          where p.fecha > DATE_SUB(NOW(), INTERVAL 21 DAY)
          group by p.pedidoid order by p.pedidoid desc;";

                $cdresult = mysqli_query($conn, $cdquery) or die("Query to get data from firsttable failed: ");
                $oldNombre = "";
                $oldUser = 0;
                while ($cdrow = mysqli_fetch_array($cdresult)) {

                  $pid = $cdrow["pedidoid"];
                  $preferencias = $cdrow["preferencias"];
                  $nombrePedido = getPedidoNombre($cdrow["fecha"], $pid);



                  if ($nombrePedido[1] != $oldNombre) {
                    $oldNombre = $nombrePedido[1];


                ?>
                   <tr style="font-weight: 700; background-color: #ccc;">
                     <td>
                       <?php
                        echo "Pedido - "  . $nombrePedido[1];
                        ?>
                     </td>
                     <td colspan="5">
                     </td>
                   </tr>

                 <?php
                  }

                  $nota = $cdrow["nota"];

                  $uid = $cdrow["UsuarioId"];
                  $armado = ($cdrow["armado"] == 1 ? "checked" : "");
                  $classArmado = ($cdrow["armado"] == 1 ? "row-armado" : "");
                  $user = ($cdrow["Nombre"] == NULL ? "sin nombre" : $cdrow["Nombre"] . " " . $cdrow["Apellido"]);

                  $oldUser = $uid;
                  ?>
                 <tr data-target="#pedido<?php echo $pid; ?>" data-ui="<?php echo $uid; ?>" class="keydiv <?php echo $classArmado; ?>">
                   <td class="nombre-cliente">
                     <?php
                      echo $user;
                      ?>
                   </td>

                   <td>
                     <?php echo "$" . getPedidoPrecioTotal($pid); ?>
                   </td>
                   <td>
                     <input type="checkbox" class="chk-armado" data-id="<?php echo $pid; ?>" <?php echo $armado; ?> />
                   </td>
                 </tr>

                 <?php

                  ?>
                 <tr id="pedido<?php echo $pid; ?>" class="grupo<?php echo $uid; ?>" style="display:none;">
                   <td colspan="3">
                     <table class="table table-striped">
                       <thead>
                         <tr>
                           <th>Categoria</th>
                           <th></th>
                           <th>Nombre</th>
                           <th>Cantidad</th>
                           <th>Chico</th>
                           <th>Mediano</th>
                           <th>Grande</th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php
                          $cdresult2 = getPedidoDetalle($pid);

                          $oldCat = 0;
                          $acum = 0;
                          $catid = 0;

                          while ($cdrow2 = mysqli_fetch_assoc($cdresult2)) {

                            //$imagen2 = $cdrow2["imagen"];
                            $prod2 = $cdrow2["prod"];
                            $cat2 = $cdrow2["cat"];
                            $catid = $cdrow2["catid"];

                            $chico2 = $cdrow2["chico"];
                            $mediano2 = $cdrow2["mediano"];
                            $grande2 = $cdrow2["grande"];
                            $cantidad2 = $cdrow2["cantidad"];


                            if ($oldCat != $catid) {
                              if ($oldCat != 0) {
                                if ($oldCat == 1 || $oldCat == 2) {
                          ?>
                                 <tr style="border-top: solid;">
                                   <td colspan="2"></td>
                                   <td>SUBTOTALES </td>
                                   <td></td>
                                   <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 1); ?></td>
                                   <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 2); ?></td>
                                   <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 3); ?></td>
                                 </tr>
                               <?php
                                } else {
                                ?>
                                 <tr style="border-top: solid;">
                                   <td colspan="2"></td>
                                   <td>SUBTOTALES </td>
                                   <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 4); ?></td>
                                   <td colspan="3"></td>
                                 </tr>
                             <?php
                                }
                              }
                              $oldCat = $catid;

                              ?>
                             <tr>


                               <td colspan="2"><?php echo $cat2; ?></td>
                               <td colspan="5"></td>
                             </tr>
                           <?php
                            }
                            ?>
                           <tr>
                             <td></td>
                             <td></td>

                             <td><?php echo $prod2; ?></td>
                             <?php
                              if ($catid == 1 || $oldCat = 2) {
                              ?>
                               <td></td>
                               <td><?php echo $chico2; ?></td>
                               <td><?php echo $mediano2; ?></td>
                               <td><?php echo $grande2; ?></td>
                             <?php
                              } else {
                              ?>
                               <td><?php echo $cantidad2; ?></td>
                               <td colspan="3"></td>
                             <?php
                              }
                              ?>
                           </tr>
                         <?php
                          }

                          if ($oldCat == 1) {
                          ?>
                           <tr style="border-top: solid;">
                             <td colspan="2"></td>
                             <td>SUBTOTALES </td>
                             <td></td>
                             <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 1); ?></td>
                             <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 2); ?></td>
                             <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 3); ?></td>
                           </tr>
                         <?php
                          } else {
                          ?>
                           <tr style="border-top: solid;">
                             <td colspan="2"></td>
                             <td>SUBTOTALES </td>
                             <td><?php echo getCantidadPorCategoriaPorPedido($pid, $oldCat, 4); ?></td>
                             <td colspan="3"></td>
                           </tr>
                         <?php
                          }
                          ?>
                         <tr>
                           <td colspan="3"><strong>Nota adicional</strong></td>
                           <td colspan="4"><?php echo $nota; ?></td>
                         </tr>
                         <tr>
                           <td colspan="3"><strong>Preferencias cliente</strong></td>
                           <td colspan="4"><?php echo $preferencias; ?></td>
                         </tr>
                       </tbody>
                     </table>
                   </td>
                 </tr>
               <?php

                }
                ?>
             </tbody>
           </table>
         </div><!-- /.table-responsive -->
       </div><!-- /.box-body -->
       <div class="box-footer clearfix">

       </div><!-- /.box-footer -->
       <script type="text/javascript">
         $("#table-pedido").on("click", ".keydiv", function() {
           //alert("ASfsaf");
           var uid = $(this).data("target");
           //alert("asf: " + uid);
           console.log(uid);

           console.log("entro");
           $("#table-pedido").find("tr" + uid).toggle();

         });
       </script>

       <?php

        include("footer.php");
        ?>