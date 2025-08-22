<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ani Cocina</title>
  <!-- Meta -->
  ">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="apple-touch-icon" href="apple-icon-72x72.png">
  
  <link rel="icon" type="image/png"  href="favicon-16x16.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">

  <link rel="stylesheet" href="css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body id="register-body">
  <?php
  include_once("admin/controller/funciones.php");

  ?>

  <div class="register-box">


    <div class="register-box-body">
      <div class="register-logo">
       <img src="images/logo-login.png" class="img-responsive" />
       <p class="sub-title">Complet&aacute; los siguientes datos para
       crear un usuario y hacer tus pedidos.</p>
     </div>

     <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">        
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
      <!--div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="*Localidad (especificar el barrio):" name="city">
      </div-->
       <div class="form-group has-feedback">
       
        <select style="width:100%;height:35px;border-radius:5px;" name="zonaenvio" id="zonaenvio" required>
            
          <option value="" selected disabled>Zona de Envío Del Pedido</option>
          
           <?php 
            $zonas_envio = getZonasEnvio();
            foreach($zonas_envio as $zona ) {
              echo "<option value='".$zona['ZonaId']."'>".$zona['Nombre']."</option>";
            }?>
            
        </select>
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
        registrar();
        ?>
      </div>
      <div class="form-group text-center buttons">
        <button type="submit" id="btnregister" disabled>REGISTRARME</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
<!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {

    $("#password, #repassword").keyup(function() {
      console.log($("#password").val() + " - " + $("#repassword").val());
      if($("#password").val() == $("#repassword").val()){
        $("#password, #repassword").css("border","solid 1px green");
        $("#btnregister").removeAttr("disabled");
      }
      else
      {
       $("#password, #repassword").css("border","solid 1px red");
       $("#btnregister").attr("disabled","disabled");
     }
   });


  
});
</script>
</body>
</html>
<?php
ob_end_flush();
?>