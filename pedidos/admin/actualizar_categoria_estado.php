<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type:application/json");
include("controller/funciones.php");

if(empty($_POST["categoriaid"])) {
    delivery_response(400, "Invalid request", NULL);
    return;
}


if( !actualizar_estado_categoria( $_POST["categoriaid"] ) ){
    delivery_response(400, "Invalid request", NULL);

}

delivery_response(200, "event created", NULL);




function delivery_response($status, $status_message, $data)
{
    header("HTTP/1.1 $status $status_message");

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
