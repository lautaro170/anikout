<?php 

?>
<div id="image-carousel" class="splide">
  <div class="splide__track">
    <ul class="splide__list">
      
    <?php 
        foreach($imagenes_categoria as $imagen)
        {
            $filename = $imagen["filename"];
            echo '<li class="splide__slide"><a data-fancybox="gallery" href="/pedidos/images/categoria/'.$catid.'/'.$filename.'"><img class="img-fluid" src="/pedidos/images/categoria/'.$catid.'/'.$filename.'" alt="Imagen Muestra"></a></li>';
        }
    ?>
    </ul>
  </div>
</div>
