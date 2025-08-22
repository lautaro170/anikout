<?php
header('Access-Control-Allow-Origin: *'); 
header("Content-Type:application/json");
include("controller/funciones.php");
if(!empty($_GET["pedidoid"]))
{
	$pedid = $_GET["pedidoid"];

	$ret = actualizar_estado_pedido($pedid);	

	delivery_response(200, "event created", $ret);

	
}
else
{
	delivery_response(400, "Invalid request", NULL);

}


function delivery_response($status, $status_message, $data)
{
	header("HTTP/1.1 $status $status_message");

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}


?>