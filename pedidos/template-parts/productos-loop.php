<?php
    $productos = getProductsByCategory($catid);
    foreach($productos as $prod) {
        $prodid = $prod["productoid"];
        $nombre = $prod["nombre"];
        $desc = $prod["descripcion"];
        $img = "admin/" . $prod["imagen"];
        $vegano = $prod["vegano"];
        $singluten = $prod["singluten"];
        $precio = ($prod["precio"] == 0 || $prod["precio"] == null) ? $precio_categoria : $prod["precio"];
        $precio = (int) $precio;
        if (isset($_SESSION['u_id_a'])) {
            $i++;
        }
        if($catid == 1 || $catid == 2)
            include("template-parts/producto-vianda-card.php");
        else
            include("template-parts/producto-card.php");
    }