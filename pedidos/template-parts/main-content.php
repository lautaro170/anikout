<div class="container" id="pedido">
    <div class="row" id="menupedido">
        <div class="col-12 col-md-7">

            <?php
            include_once('template-parts/block-fecha-entrega.php');
            include_once('template-parts/categorias-loop.php');
            ?>
        </div>
        <!--div class="col-xs-hidden col-md-1">
      </div-->

        <div class="col-12 col-md-5">
            <?php 
                include_once("template-parts/block-medios-pago.php");
                include_once("template-parts/block-horarios-entrega.php")
            ?>
          

            
            
            <?php
            //Botones Ingresar Y Registrarse
           /* if (!isset($_SESSION['u_id_a'])) {
            ?>
                <div class="wrapper-col-resumen-pedido mt-3">
                    <div class="col-12 mi-pedido">
                        <h3 class="titulo-resumen-pedido"> PARA HACER TU PEDIDO </h3>
                    </div>
                    <div class="col-12">
                        <button type="button" id="btnIngresar" class="btn btn-pedido">INGRESAR</button>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" id="btnRegistrarme" class="btn btn-pedido">REGISTRARME</button>
                    </div>
                </div>
            <?php
            }*/
            ?>
            
            <!--Select Formas de Envio-->
            <?php
            if (isset($_SESSION['u_id_a'])) {
                if (getUserZonaEnvio($_SESSION['u_id_a']) == 0) {

            ?>
                    <div class="form-group has-feedback">
                        <div class="panel-heading titulo-resumen-pedido text-center h4 mb-2 mt-5">MÍ ZONA DE ENVIO</div>
                        <?php include("template-parts/select-zonas-envio.php")?>
                    </div>
            <?php }
            }; ?>

            <!--Lista de zonas de envios-->
            <?php include_once("template-parts/zonas-envio-list.php")?>


            <!--Tabla carrito-->
            <div class="mb-3">
                <?php include_once("template-parts/mi-pedido.php")?>

                <div id="resultado-pedido" class="text-center message-pedido-box">
                    <p id="msgPedido" style="font-weight:bold;"></p>
                </div>
            </div>

        </div>
    </div>
</div>