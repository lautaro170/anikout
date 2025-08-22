<button id="<?php echo $accordion_id?>" class="accordion"><?php echo $nom;?></button>
<div  class="accordion-panel">
<?php
    
if($imagenes_categoria != null)
    include('template-parts/categoria-imagenes-carousel.php');

if ($catid == 1) {
    include('template-parts/categoria-header-vianda.php');
} 
else { 
    echo $acl;
} 
include('template-parts/productos-loop.php');
?>
</div>
