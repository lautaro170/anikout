<?php include_once("header.php"); ?>
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
            <th style="width:100px" >Pedido</th>                
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
        $fecha_entrega_hace_4_semanas = getFechaEntrega( get_date("-28",$today) );
        $sql = "SELECT pr.productoid, pr.nombre, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, u.Nombre as cook, u.UsuarioId as cookid, p.fecha_entrega as fecha_entrega, pr.categoriaid as catid FROM pedido p 
        inner join productopedido pp 
        on p.pedidoid = pp.pedidoid
        inner join producto pr
        on pp.productoid = pr.productoid
        inner join usuario u 
        on pr.cocineroid = u.UsuarioId and u.Permiso = 'cocinero'
        WHERE fecha_entrega BETWEEN '$fecha_entrega_hace_4_semanas' AND '$today'
        group by pr.productoid, cookid, catid, fecha_entrega  
        ORDER BY fecha_entrega DESC, cookid;";

        $result = mysqli_query($conn,$sql);

        if($result === false) {
            echo "Error running query: " . mysqli_error($conn) . "\n";
        }
        $fecha_entrega_anterior = "";
        $cookId_anterior = 0;
        $acumChico = 0;
        $acumMediano = 0;
        $acumGrande = 0;
        $acumCantidad = 0;
        $oldCat = 0;
        $lastCat = 0;
        $lastId = 0;

        while($row= mysqli_fetch_assoc($result)){
            $productoId = $row["productoid"];
            $nombre = $row["nombre"];
            $cook = $row["cook"];
            $cookId = $row["cookid"];
            $chico = $row["chico"];
            $mediano = $row["mediano"];
            $grande = $row["grande"];
            $cantidad = $row["cantidad"];
            $catId = $row["catid"];
            $fecha_entrega = $row["fecha_entrega"];
            $lastCat = $catId;
            ?>
            
            <?php //fila fecha entrega
            if($fecha_entrega_anterior != $fecha_entrega){
                $fecha_entrega_anterior = $fecha_entrega;               

                ?>
                <tr style="border-top: solid; background:lemonchiffon;">
                    <td style="width:50px;">
                        <?php echo $fecha_entrega; ?>
                    </td>
                    <td colspan="5"></td>
                </tr>
                <?php 
            }//if
            ?>
            
            <?php //fila nombre cocinero
            
            if($oldCat != $catId){
                if($oldCat != 0){
                    ?>
                    <tr style="border-top: solid;">
                        <td></td>
                        <td></td>
                        <td><strong>Total : <?php ($oldCat == 1 || $oldCat == 2) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
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
               } //if 
            
            if($catId == 1 || $catId == 2){
                $acumGrande += $grande;
                $acumMediano += $mediano;
                $acumChico += $chico;
            }
            else{
                $acumCantidad += $cantidad;
            }
            
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
                <td><strong>Total : <?php ($lastCat == 1) ? print($acumChico+$acumMediano+$acumGrande) : print($acumCantidad); ?>
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
</div><!-- /.table-responsive -->
</div><!-- /.box-body -->
<div class="box-footer clearfix">

</div><!-- /.box-footer -->
<?php 
include("footer.php");
?>