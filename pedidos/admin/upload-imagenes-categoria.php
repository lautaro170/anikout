<?php
include_once("controller/funciones.php");

$image_name = $_POST["fileId"];
$image_file = $_FILES["file_data"];
$categoria_id = $_POST["categoria_id"];

if($categoria_id == null || $categoria_id == ""){
    echo json_encode(array('status' => 'error', 'message' => 'Categoria no especificada.'));
    return;
}

if($image_file == null || $image_file == ""){
    echo json_encode(array('status' => 'error', 'message' => 'Imagen no especificada.'));
    return;
}


$image_id = crear_imagenes_categoria($categoria_id, $image_file, $image_name );

$imagen = getImagenCategoria($image_id);

$response = generateImageKrajeeResponse($imagen);

echo json_encode($response);
 
?>