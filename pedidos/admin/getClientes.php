<?php

include_once("controller/funciones.php");

if(true)
{	
	conectar();
	

	$cdresult4=getAllClientes();


	$arrayClientes = array();
	while($cdrow4 = mysqli_fetch_array($cdresult4,MYSQLI_ASSOC)){
		
		$arrayClientes[] = json_encode(array('id' => $cdrow4["UsuarioId"], 'name' => $cdrow4["Nombre"],'apellido' => $cdrow4["Apellido"], 'direccion' => $cdrow4["Direccion"], 'datos' => $cdrow4["Preferencias"]));
	}
	

	$ret = ['items'=>$arrayClientes];

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