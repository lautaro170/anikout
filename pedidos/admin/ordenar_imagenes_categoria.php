<?php
include_once("controller/funciones.php");


function updateImagenCategoriaOrder($sortedIDs){
    $conn = conectar();
    $sql = "UPDATE categoria_imagen SET image_order = CASE id ";
    foreach($sortedIDs as $orden => $id){
        $sql .= sprintf("WHEN %d THEN %d ", $id, $orden);
    }
    $sql .= "ELSE NULL END WHERE id IN (".implode(",", $sortedIDs).")";
    $conn->query($sql);
    return $sql;
}

$sortedIDs = $_POST["sortedIDs"];


if($sortedIDs == null || $sortedIDs == ""){
    $response = [
        "status" => "error",
        "message" => "No se especificaron imagenes"
    ];
    echo json_encode($response);
    return;
}


updateImagenCategoriaOrder($sortedIDs);

$response = [
    "status" => "success",
    "message" => "Orden actualizado"
];
echo json_encode($response);
return;


?>