<div class="col-12 brd-top">
    <div class="row">
        <div class="col-md-4 col-12 card-btm brd-right">
            <div class="qty-container">
                <div>Chica</div>
                <div class="qty-input-group">
                    <input type="button" value="-" class="button-substract-qty" />
                    <input type="number" min="0" data-price="<?php echo $precio_chico; ?>" data-medida="chico" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                    <input type="button" value="+" class="button-add-qty" />
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12 card-btm brd-right">
        <div class="qty-container">
            <div>Mediana</div>
                <div class="qty-input-group">
                    <input type="button" value="-" class="button-substract-qty" />
                    <input type="number" min="0" data-price="<?php echo $precio_mediano; ?>" data-medida="mediano" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                    <input type="button" value="+" class="button-add-qty" />
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-12 card-btm">
            <div class="qty-container">
                <div>Grande</div>
                <div class="qty-input-group">
                    <input type="button" value="-" class="button-substract-qty" />
                    <input type="number" min="0" data-price="<?php echo $precio_grande; ?>" data-medida="grande" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                    <input type="button" value="+" class="button-add-qty" />
                </div>
            </div>
        </div>
    </div>
</div>
