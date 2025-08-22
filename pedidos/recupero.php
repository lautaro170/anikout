<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ani Kout - Recupero Clave</title>
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
<body class="hold-transition" id="login-body">
  <?php

  include_once("admin/controller/funciones.php");
  ?>
  <div class="container-fluid">
    <div class="col-xs-12 col-md-11">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="index.php">Inicio</a>
              </li>

              <li><a href="register.php">Registrarse</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    </div>
  </div>
  <div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
      <img src="images/logo-login.png" class="img-responsive hidden-xs chica-fondo" />
      <p class="login-box-msg">Recuperar contraseña</p>


        <div class="form-group has-feedback">
          <input type="email" name="usuario" class="form-control usuariotexto" placeholder="Email" />
        </div>

        <div class="row">

          <!-- /.col -->
          <div class="col-xs-12 text-center">

            <button type="button" class="btn-pink recuperar">Enviar email</button>
          </div>
          <div class="col-xs-12 text-center" style="margin-top: 10px; color: green;">
            <p class="mensaje">

            </p>
          </div>

          <!-- /.col -->
        </div>


    </div>
    <!-- /.login-box-body -->
  </div>

  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="admin/bootstrap/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
    $(".recuperar").click(function(){

     $.get({
       url: "recuperaremail.php",
       data: {  usuario : $(".usuariotexto").val()
      },
      success: function(data) {
      $(".mensaje").html(data.data);

      }
    });

   });
  })
</script>

</body>
</html>
