<button class="accordion mt-4">CLICK PARA VER ZONAS DE ENVÍO</button>
<div class="accordion-panel panel panel-default">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Zona</th>
                <th>Precio</th>

            </tr>
        </thead>
        <tbody>
            <?php

            $zonas_envio = getZonasEnvio();

            foreach($zonas_envio as $zona_envio) {
                if (isset($zona_envio)) {
                    $nombre = $zona_envio["Nombre"];
                    $precio = $zona_envio["precio"];
                }
            ?>
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td>$<?php echo $precio; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2" class="text-center">Si tu localidad no está en la lista, consultanos! <a href="https://wa.me/541145586179?text=" style="background-color:#25d366; color:#fff;font-size:20px; padding:5px; border-radius:10px" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>