<div class="login-box pb-3 mt-2">
    <p style="font-size: 18px; font-weight: 700" class="pt-2 text-center text-center">Ya compré antes</p>

    <div style="max-width:400px" class="login-box-body mx-auto">
        <?php
        if (isset($_GET['error'])) {
        ?>
            <div class="m-1 alert alert-danger" role="alert">
                Usuario o Contraseña incorrectos.
            </div>
        <?php } ?>
        
        <form action="admin/controller/funciones.php?fcn=1" class="p-1" method="post">

            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="usuario" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="clave" class="form-control" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit"  class="btn realizar-pedido-button">INGRESAR</button>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <a href="recupero.php">Olvid&eacute; mi contraseña</a>
                </div>

            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->