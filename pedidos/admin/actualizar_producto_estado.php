<?php
header('Access-Control-Allow-Origin: *'); 
header("Content-Type:application/json");
include("controller/funciones.php");
if(!empty($_GET["productoid"]))
{
	$prodid = $_GET["productoid"];


    if($_GET["proxima"] == "true"){
        echo "1";
        $ret = actualizar_estado_proxima_producto($prodid);	

    }else{
                echo "2";

	    $ret = actualizar_estado_producto($prodid);	
    }
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