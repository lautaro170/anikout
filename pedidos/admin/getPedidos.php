<?php

include_once(__DIR__."/controller/funciones.php");

if(true)
{	
	conectar();	

	$cdresult4=getPedidosUltimasTresSemanas();

	$arrayPedidos = array();
	while($cdrow4 = mysqli_fetch_array($cdresult4,MYSQLI_ASSOC)){
		
		$arrayPedidos[] = json_encode(array('id' => $cdrow4["pedidoid"], 'name' => ($cdrow4["Nombre"] . " " . $cdrow4["Apellido"]), 'date' => $cdrow4["fecha"], 'ready' => ($cdrow4["armado"] == 1 ? "Si" : "No"), 'cantidad' => $cdrow4["chico"] + $cdrow4["mediano"] + $cdrow4["grande"] + $cdrow4["cantidad"], 'categoryId' => $cdrow4["categoriaid"]));
	}
	
	$ret =  ['items'=>$arrayPedidos];

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