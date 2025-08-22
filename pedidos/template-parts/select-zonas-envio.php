
<select style="width:100%;height:35px;border-radius:5px;" name="zonaenvio" id="zonaenvio" required>
    <option value="" selected disabled hidden>Zona de Envío Del Pedido</option>
    <?php
    $zonas_envio = getZonasEnvio();
    foreach($zonas_envio as $zona){
        echo "<option data-precio='" . $zona['Precio'] . "' value='" . $zona['ZonaId'] . "'>" . $zona['Nombre'] . "</option>";
    } ?>
</select>
