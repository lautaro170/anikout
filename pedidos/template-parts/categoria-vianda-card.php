<button id="<?php echo $accordion_id?>" class="accordion"><?php echo $nom;?></button>
<div  class="accordion-panel">
    <?php
    if($imagenes_categoria != null)
        include('template-parts/categoria-imagenes-carousel.php');


    //Show the Viandas category
    $precios_viandas = getViandasPreciosForCategoria($catid);
    $precio_chico = $precios_viandas["preciochico"];
    $precio_mediano = $precios_viandas["preciomediano"];
    $precio_grande = $precios_viandas["preciogrande"];
    include('template-parts/categoria-header-vianda.php');
    include('template-parts/productos-loop.php');
    ?>
</div>
