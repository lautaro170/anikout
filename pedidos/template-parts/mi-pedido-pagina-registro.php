<?php

$fechaEntregaMonth = IntlDateFormatter::formatObject(
    $dateTimeFechaEntrega,
    "MMM",
    'es'
);

$fechaEntregaDay = IntlDateFormatter::formatObject(
    $dateTimeFechaEntrega,
    "d",
    'es'
);
?>

<div class="wrapper-col-resumen-pedido mt-3">

    <div class="col-12 mi-pedido">
        <div class="menu-semanal">
            <p><?php echo $fechaEntregaDay; ?></p>
            <p><?php echo $fechaEntregaMonth; ?></p>
        </div>
        <h3 class="titulo-resumen-pedido">MI PEDIDO</h3>
    </div>
    <div id="pedido-lista">
        <div class="col-12 separacion">
            <p>Todavia no agrego ningun producto a la lista</p>
        </div>
    </div>
    <div id="pedido-lista">
        <div class="col-12 separacion">
        </div>
    </div>
    <div class="col-12 separacion">
        <?php
        $zona_envio = "Seleccione Zona Envío";
        $zona_precio = "";
        $dire = "";
        $delivery = "";
        ?>
        <input type="hidden" id="txtDelivery" value="<?php echo $zona_precio; ?>" />
        <input type="hidden" id="idZonaEnvio" value="" />

        <span>Valor delivery para <span id="nombre-zona-envio"> - </span>: <div class="pull-right">$ <span id="precio-envio"><?php echo $zona_precio; ?></div></span><br><br>
        <span>Total: <div class="pull-right"><span id="txtTotalTotal">0</span></div></span>
    </div>
    <div class="input-group separacion">
        <input type="text" id="notas-adicionales" class="form-control notas-adicionales" placeholder="Agregar notas adicionales" />
    </div>
</div>