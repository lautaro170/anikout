<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador | Artesana</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body>
       


       <div class="login-box">
        <?php 
           if( isset($_GET['error']) ){
           ?>
               <div class="alert alert-danger" role="alert">
                    Usuario o Contraseña incorrectos.
               </div>
           <?php }?>

        <div class="login-logo">
         <a href="index.html"><b>Artesana</b></a>
       </div><!-- /.login-logo -->
       <div class="login-box-body">
         <p class="login-box-msg">Ingresar para iniciar la sesion</p>
         <form action="../controller/funciones.php?fcn=3" method="post">
          <div class="form-group has-feedback">
           <input type="email" class="form-control" name="usuario" placeholder="Email">
           <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         </div>
         <div class="form-group has-feedback">
           <input type="password" name="clave" class="form-control" placeholder="Password">
           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         </div>
         <div class="row">
           <div class="col-xs-8">
            
           </div><!-- /.col -->
           <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div><!-- /.col -->
          
        </div>
      </form>
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- CONTENIDO -->


  <!-- Control Sidebar -->

      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>

    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
         
       </body>
       </html>
