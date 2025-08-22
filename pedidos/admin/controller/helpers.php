<?php 


function generateImageKrajeeInitialPreview($imagen){
    return '<img src="/pedidos/images/categoria/'.$imagen['categoria_id'] .'/'.$imagen['filename'] . '" class="file-preview-image" alt="image" title="image" style="width:auto; height:auto;">';
}

function generateImageKrajeeInitialPreviewConfig($imagen){
    return [
        "type" => "image",
        "caption" => $imagen['filename'],
        "width" => "120px",
        "url" => "borrar_imagenes_categoria.php",
        "key" => $imagen['id'],
    ];
}

function generateImageKrajeeResponse($imagen){

    $response = [
        "initialPreview" => [
            generateImageKrajeeInitialPreview($imagen)        
        ],
        "initialPreviewAsData" => true,
        "initialPreviewConfig" => [
            generateImageKrajeeInitialPreviewConfig($imagen)
        ]
    ];
    return $response;
}

function generateKrajeeInitialArrays($imagenes){
    $response = [
        "initialPreview" => [],
        "initialPreviewAsData" => true,
        "initialPreviewConfig" => []
    ];
    foreach($imagenes as $imagen){
        $response['initialPreview'][] = generateImageKrajeeInitialPreview($imagen);
        $response['initialPreviewConfig'][] = generateImageKrajeeInitialPreviewConfig($imagen);
    }
    return $response;
}


?>