<?php

    $categorias = getActiveCategorias();
    while ($cat = mysqli_fetch_array($categorias)) {

        $catid = $cat["CategoriaId"];
        $nom = $cat["Nombre"];
        $acl = $cat["Aclaracion"];
        $precio_categoria = $cat["Precio"];
        $imagenes_categoria = getImagenesCategoria($catid);
        $accordion_id = str_replace(" ", "-", strtolower($nom));

        $transliterator = array(
            'á' => 'a',
            'é' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ú' => 'u',
            'Á' => 'A',
            'É' => 'E',
            'Í' => 'I',
            'Ó' => 'O',
            'Ú' => 'U'
        );
        $nom = strtr($nom, $transliterator);
        $accordion_id = str_replace(" ", "-", strtolower($nom));
        if($catid == 1 || $catid == 2)
            include("template-parts/categoria-vianda-card.php");
        else
            include("template-parts/categoria-card.php");
    }
    ?>
