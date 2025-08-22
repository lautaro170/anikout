<?php 
/*
include_once("header.php");
 $conn=conectar();

$query_pedidos = "SELECT pedidoid, fecha FROM `pedido` WHERE 1";
$pedidos=mysqli_query($conn,$query_pedidos);


while($pedido=mysqli_fetch_array($pedidos)){
    
    $id = $pedido['pedidoid'];
    $fecha = $pedido['fecha'];
    $fecha_entrega = getFechaEntrega($fecha);
    $query_pedido = "UPDATE pedido
            SET fecha_entrega = '$fecha_entrega'
WHERE pedidoid = '$id';";

    echo $query_pedido;
    $pedido=mysqli_query($conn,$query_pedido);
    
    
    
}
*/
?>