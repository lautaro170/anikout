<?php
include_once("controller/funciones.php");

if(true)
{
    //conectar();
    $cdresult4= getPedidosPorCocinero();
  
    //$arrayPedidosCocinero = array();

    /*while($cdrow4 = mysqli_fetch_assoc($cdresult4)){
        $arrayPedidosCocinero[]=$cdrow4;
    }*/

    for($set = array(); $row=$cdresult4->fetch_assoc(); $set[]=$row);

    $ret= ['items'=>$arrayPedidosCocinero];

    delivery_response(200, "event found", $set);
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