<?php
include_once("controller/funciones.php");

$file_id = $_POST["key"];

if($file_id == null || $file_id == ""){
    echo json_encode(array('status' => 'error', 'message' => 'Imagen no especificada.'));
    return;
}

if( !borrar_imagen_categoria($file_id) ){
    echo json_encode(array('status' => 'error', 'message' => 'Error al borrar la imagen.'));
    return;
}

echo json_encode(array('status' => 'success', 'message' => 'Imagen borrada correctamente.'));

?>