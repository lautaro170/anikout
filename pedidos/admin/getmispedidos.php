<?php
header('Access-Control-Allow-Origin: *'); 
header("Content-Type:application/json");
include_once("controller/funciones.php");
error_reporting(E_ALL); 
ini_set('display_errors', 1);
if(!empty($_GET["usuarioid"]))
{
	//$uid = $_GET["usuarioid"];

	//$ret = getMisPedidos($uid);	
	//$ret = mysqli_fetch_array(getMisPedidos($_GET["usuarioid"]));
	$ret = getMisPedidos($_GET["usuarioid"]);
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