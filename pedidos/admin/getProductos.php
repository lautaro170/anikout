<?php
include_once("controller/funciones.php");

if(true)
{	
	conectar();
	$cdresult4=getAllProductos();
	
	//create array
	$arrayProducts = array();
	
	while($cdrow4 = mysqli_fetch_array($cdresult4,MYSQLI_ASSOC)){
		//$checked = ($cdrow4["activo"] == 1 ? "checked" : "");
		$arrayProducts[] = json_encode(array('id' => $cdrow4["productoid"], 'imagen' => $cdrow4["imagen"],'nombre' => $cdrow4["prod"], 'categoria' => $cdrow4["cat"], 'activo' => $cdrow4["activo"],'activo_proxima_semana' => $cdrow4["activo_proxima_semana"], 'orden' => $cdrow4["orden"]));
	}
	
	$ret = ['items'=>$arrayProducts];
	//echo json_encode($ret);
	
	delivery_response(200, "event found", $ret);
	//return $ret;
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