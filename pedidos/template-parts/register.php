<div class="mt-2 mb-2">
    <div class="register-box-body  w-full">
        <p style="font-size: 18px; font-weight: 700" class="text-center pt-2">Es mí primera compra</p>
        <form class="p-2" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="*Nombre:" name="nombre" required>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="*Apellido:" name="apellido" required>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Telefono:" name="telefono" required>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="*Celular:" name="celular" required>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="*Direccion:" name="address" required>
            </div>
            <div class="form-group has-feedback">
                <?php include("template-parts/select-zonas-envio.php")?>
            </div>

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Rango horario de entrega:" name="timetodeliver">
            </div>
            <div class="form-group has-feedback">
                <textarea class="form-control" cols="40" placeholder="Datos complementarios (condicion de salud, regimen particular, gustos y preferencias):" name="preferences" rows="5"></textarea>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="*Email:" name="email" required>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="*Contraseña:" name="password" id="password" required>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="*Repetir contraseña:" id="repassword" required>
            </div>
            <div class="form-group msg-error">
                <?php
                echo $registerErrorMessage;
                //registrar();
                ?>
            </div>
            <div class="form-group text-center">
                <button type="submit" id="btnregister" class="btn realizar-pedido-button" disabled>CONFIRMAR PEDIDO</button>
            </div>
            <!-- /.col -->
    </form>
    </div>
</div>