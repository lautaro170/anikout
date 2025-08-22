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
        $zona_envio = "";
        $zona_precio = "";

        if (isset($_SESSION['u_id_a'])) {

            $resultado = getUsuarioDireccion($_SESSION['u_id_a']);
            $dire = "";
            while ($user = mysqli_fetch_array($resultado)) {
                $dire = $user["Direccion"];
                $delivery = $user["PrecioDelivery"];
                $zona_envio = ($user["Nombre"] != null) ? $user["Nombre"] : ': Seleccione Zona envío';
                $zona_precio = ($user["precio"] != null) ? $user["precio"] : '';
            }
        ?>
            <input type="hidden" id="txtDelivery" value="<?php echo $zona_precio; ?>" />
            <input type="hidden" id="idZonaEnvio" value="" />

            <span>Dirección: <?php echo $dire; ?></span></br>
            <span>Valor delivery para <span id="nombre-zona-envio"><?php echo $zona_envio; ?></span>: <div class="pull-right">$ <span id="precio-envio"><?php echo $zona_precio; ?></div></span><br>
            <span>Total: <div class="pull-right"><span id="txtTotalTotal">0</span></div></span>
        <?php
        }
        ?>
    </div>
    <div class="input-group separacion">
        <input type="text" id="notas-adicionales" class="form-control notas-adicionales" placeholder="Agregar notas adicionales" />
    </div>
    <div class="col-12 text-center buttons">
        <?php
        if (isset($_SESSION['u_id_a'])) {
        ?>
            </button>
            <div class="alert alert-danger" role="alert" id="textoSeleccionarZonaEnvio" style="display:none;">Para confirmar el pedido, Seleccione una Zona de Envío encima del cuadro "Mi Pedido"</div>
            <input type="hidden" class="idhidden" value="<?php $_SESSION['u_id_a']; ?>">


            <button type="button" data-toggle="modal" id="btnToggleModalConfirmarPedido" data-target="#modalConfirmarPedido" class="btn btn-pedido">FINALIZAR PEDIDO</button>


            <button type="button" id="btnOtroPedido" style="display:none;" class="btn btn-pedido otro-pedido">REALIZAR OTRO PEDIDO</button>
        <?php
        } else {
        ?>
            <div class="btn-pedido-container">
                <button type="button" onclick="window.location.href='realizar-pedido.php'" class="btn btn-pedido"><span class="btn-pedido-text">INICIAR PEDIDO</span></button>
            </div>
            <?php
        }
        ?>
    </div>
</div>