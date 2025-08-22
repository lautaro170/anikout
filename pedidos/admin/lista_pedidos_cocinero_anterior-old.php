<?php 

include_once("header.php");
include_once("controller/funciones.php");

?>
<div class="content-wrapper" ng-app="ui.bootstrap.demo">
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
                <th>Pedido</th>                
                <th>Cocinero</th>           
                <th>Plato</th>           
                <th>Chico / Cantidad</th>           
                <th>Mediano</th>           
                <th>Grande</th>          
            </tr>
        </thead>
        <tbody>  
            <?php 
            $conn =conectar();
            $today = date("Y-m-d");

            /*
            FUNCIONA PERO ORDENA MAL
 $sql = "SELECT p.pedidoid,pr.productoid, pr.nombre, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, u.Nombre as cook, u.UsuarioId as cookid, p.fecha, pr.categoriaid as catid FROM pedido p inner join productopedido pp on p.pedidoid = pp.pedidoid inner join producto pr on pp.productoid = pr.productoid inner join usuario u on pr.cocineroid = u.UsuarioId and u.Permiso = 'cocinero' 
            group by pr.productoid, cookid, catid 
            ORDER BY p.fecha, cookid, catid DESC";
            */
            $sql = "SELECT p.pedidoid,pr.productoid, pr.nombre, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, u.Nombre as cook, u.UsuarioId as cookid, p.fecha, pr.categoriaid as catid FROM pedido p inner join productopedido pp on p.pedidoid = pp.pedidoid inner join producto pr on pp.productoid = pr.productoid inner join usuario u on pr.cocineroid = u.UsuarioId and u.Permiso = 'cocinero' 
            group by pr.productoid, cookid, catid 
            ORDER BY p.fecha, cookid, catid DESC";

            $result = mysqli_query($conn,$sql);

            if($result === false) {
                echo "Error running query: " . mysqli_error() . "\n";
            }
            $stateName = "";
            $user = 0;
            $acumChico = 0;
            $acumMediano = 0;
            $acumGrande = 0;
            $acumCantidad = 0;
            $oldCat = 0;
            $lastCat = 0;
            $lastId = 0;

            while($row= mysqli_fetch_assoc($result)){
                $productoId = $row["productoid"];
                $pid = $row["pid"];
                $nombre = $row["nombre"];
                $cook = $row["cook"];
                $cookId = $row["cookid"];
                $chico = $row["chico"];
                $mediano = $row["mediano"];
                $grande = $row["grande"];
                $cantidad = $row["cantidad"];
                $catId = $row["catid"];
            //$nombrePedido = getPedidoFechaNombre($row["fecha"]);
                $nombrePedido = getPedidoNombre($row["fecha"], $pid)[1];
                $lastCat = $catId;
                //$arrayPedidos[] = json_encode(array($row["cookid"]=>array('productos'=>$row["productoid"])));




                if($oldCat != $catId){
                    if($oldCat != 0){
                        ?>
                        <tr style="border-top: solid;">
                            <td></td>
                            <td></td>
                            <td><strong>Total : <?php ($oldCat == 1) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
                                <?php
                                if($oldCat == 1){
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
               } //if 


               if($catId == 1){
                $acumGrande += $grande;
                $acumMediano += $mediano;
                $acumChico += $chico;
            }
            else{
                $acumCantidad += $cantidad;
            }

            
            if($stateName != $nombrePedido){
                $stateName = $nombrePedido;               

                if($oldCat != 0 && $oldCat != $catId){

                    $oldCat = $catId;
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <?php
                            if($oldCat == 1){
                                echo " v ".$acumChico+$acumMediano+$acumGrande;
                            }else{
                                echo " o ".$acumCantidad;
                            } 
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="background-color: #d3cccc">
                    <td>
                        <?php echo $nombrePedido; ?>
                    </td>
                    <td colspan="5"></td>
                </tr>
                <?php 
            }//if
            
            if($user != $cookId){
                if($user != 0)
                {
                    //aca tengo q poner el total del cocinero anterior
                    ?>
                    <tr style="border-top: solid; background-color: #666; color: #fff">
                        <td></td>
                        <td></td>
                        <td><strong>Total : <?php ($lastCat == 1) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
                            <?php
                            if($oldCat == 1){
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
                $user = $cookId;
                ?>
                <tr>
                    <td></td>
                    <td colspan="5">
                        <?php echo $cook; ?>
                    </td>
                </tr>
                <?php 
            } //if
            ?>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <?php echo $nombre; ?>
                </td>
                <?php if($catId == 1){ ?>
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

              if($catId == 1){
                $acumGrande += $grande;
                $acumMediano += $mediano;
                $acumChico += $chico;
            }
            else{
                $acumCantidad += $cantidad;
            }
            ?>
        </tr>




        <?php }//while 
        if($lastCat == $oldCat){
            ?>
            <tr style="border-top: solid;">
                <td></td>
                <td></td>
                <td><strong>Total : <?php ($lastCat == 1) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
                    <?php
                    if($oldCat == 1){
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
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->
<div class="box-footer clearfix">

</div><!-- /.box-footer -->
<?php 
include("footer.php");
?>
