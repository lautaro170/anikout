<div class="card no-padding">
    <div class="col-12 card-top">
        <div class="type-food">
            <?php if ($vegano == 1) { ?>
                <span class="card-text"><img src="images/vegan.png" class="ico-vegan"> Vegano</span>
            <?php }
            if ($singluten == 1) { ?>
                <span class="card-text"><img src="images/gluten.png" class="ico-gluten"> Sin Gluten</span>
            <?php } ?>
        </div>
            <h4 class="card-title"><?php echo "$nombre - $$precio"; ?></h4>
        <p class="card-text"><?php echo $desc; ?></p>
    </div>

    <?php
        include("template-parts/producto-card-otros-input.php");
    ?>

</div>
