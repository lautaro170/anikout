<?php
include_once("controller/funciones.php");

if(true)
{
    conectar();
    $cdresult4= getPedidosPorCocinero();
  
    $arrayPedidosCocinero = array();

    while($cdrow4 = mysqli_fetch_array($cdresult4, MYSQLI_ASSOC)){
        $arrayPedidosCocinero[]= json_encode(array('nombre'=>$cdrow4["nombre"],'cook'=>$cdrow4["cook"],'cookid'=>$cdrow4["cookid"],'chico'=>$cdrow4["chico"],'mediano'=>$cdrow4["mediano"],'grande'=>$cdrow4["grande"],'cantidad'=>$cdrow4["cantidad"],'catid'=>$cdrow4["catid"],'nombrePedido'=>getPedidoNombre($cdrow4["fecha"])));
    }

    $ret= ['items'=>$arrayPedidosCocinero];

    delivery_response(200, "event found", $ret);
}
else
{
    delivery_response(400, "Invalid request", NULL);
}

function delivery_response($status, $status_message, $data)
{
	

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}


?>