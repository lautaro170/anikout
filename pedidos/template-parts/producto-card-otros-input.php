<div class="col-12 brd-top">
    <div class="row">

        <div class="col-md-4 col-10 card-btm brd-right">
            <div>Cantidad</div>
            <div class="qty-input-group">
                <input type="button" value="-" class="button-substract-qty" />
                <input type="number" min="0" data-price="<?php echo $precio; ?>" data-medida="unidad" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                <input type="button" value="+" class="button-add-qty" />
            </div>
        </div>
    </div>
</div>
