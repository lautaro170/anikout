<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Artesana - Ingresar</title>
  <!-- Meta -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="apple-touch-icon" href="apple-icon-72x72.png">
  
  <link rel="icon" type="image/png"  href="favicon-16x16.png">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">

  <link rel="stylesheet" href="css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body id="login-body">
  <?php

  include_once("admin/controller/funciones.php");
  ?>
  

  <div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
      <img src="images/logo-login.png" class="img-responsive" />
      <p class="login-box-msg">Iniciá sesión</p>
      <?php 
      if( isset($_GET["error"]) ){
        ?> 
        <div class="alert alert-danger" role="alert">
          El usuario o la contraseña son incorrectos.
        </div>
        <?php
      }
      ?>
      <form action="admin/controller/funciones.php?fcn=1" method="post">
        <div class="form-group has-feedback">
          <input type="email" name="usuario" class="form-control" placeholder="Email">
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="clave" class="form-control" placeholder="Contraseña">
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-xs-12 text-center buttons">

            <button type="submit" class="btn-pink">INGRESAR</button>
            <!--div class="btn-pink" style="margin-bottom: 10px">
              <a href="register.php" >REGISTRARSE</a>
            </div -->
          </div>
        <!-- /.col -->
        <div class="link-container" style="margin-top: 30px">
          <!--div class="row">
            <--a href="register.php">Si no ten&eacute;s un usuario, registrate ac&aacute;!</a>
          </div-->
          <div class="row">
            <a href="recupero.php">Olvid&eacute; mi contraseña</a>
          </div>
        </div>
        <div class="text-center link-container" >

        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
$(function () {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
});
</script>
</body>
</html>
