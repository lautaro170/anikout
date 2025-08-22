<?php
include_once("controller/funciones.php");

if(true)
{	
	/*
	conectar();

	$cdresult4=getAllProductos();

	$items = array();
	
	while($cdrow4 = mysqli_fetch_assoc($cdresult4)){
		//$checked = ($cdrow4["activo"] == 1 ? "checked" : "");
		$items[] = array('id' => $cdrow4["productoid"], 'imagen' => $cdrow4["imagen"],'nombre' => $cdrow4["prod"], 'categoria' => $cdrow4["cat"], 'activo' => $cdrow4["activo"], 'orden' => $cdrow4["orden"]);
	}
	
	//$ret =  array('items'= $items);
	*/
	$conn = mysqli_connect("localhost", "c0710367_arte", "Artesana123", "c0710367_arte") or die("Error".mysqli_error($conn));

	//fetch table rows from db
	$sql="SELECT nombre,productoid from producto ;";
	$items = array();
	$result = mysqli_query($conn, $sql) or die("Error in Selecting".mysqli_error($conn));
	while($cdrow4 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		
		//$items[] = json_encode(array('a' => $cdrow4["nombre"], 'b' => $cdrow4["productoid"]));
		//$items[] = $cdrow4;
		array_push($items,$cdrow4);
	}
	echo json_encode($items);
	

	//delivery_response(200, "event found",$items);
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