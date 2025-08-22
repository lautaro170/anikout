<!DOCTYPE html>
<html>
<head>
  <!-- SITE TITLE -->
  <meta charset="utf-8">
  <title>Carlos A. Fiotto & Hijos SRL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="description" content="Carlos A. Fiotto e Hijos SRL: Está al servicio de grandes empresas y también de aquellas que recién comienzan a operar en comercio exterior, 
  Carlos A. Fiotto e Hijos SRL Brinda un SERVICIO INTEGRAL que abarca todas las áreas del comercio exterior, sin excepción. De este modo, el cliente puede centralizar su requerimiento de importación y exportación, delegando la operatoria en una estructura profesional y eficiente.">
  
  <!-- CSS STYLE -->
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/lightbox.css">
  <link rel="stylesheet" type="text/css" href="css/tooltipster.css">
  
  <!-- FAVICON -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- MOBILE ICON -->
  <link rel="apple-touch-icon" href="img/webclip.png">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP1LECxEeVlL-SPQVRRwsOL0XQRn4gO3E"></script>
</head>

<body>
  <?php session_start();?>
  <?php include('layout/header.php') ?>
  <div id="overlay"></div>
  <span id="image-loader">
    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
  </span>

  <!-- SUB BANNER -->
  <div class="sub-banner">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-6">
          <h4 class="title-bread">Contactanos&nbsp;<span class="sub-title-lighter">/ TEL: <a href="tel:5218-6655">5218-6655</a></span></h4>
        </div>
        <div class="w-col w-col-6 col-right">
          <div class="breadcrumbs">Inicio&nbsp;/&nbsp;Contacto</div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SUB BANNER -->
  
  <!-- START SECTION 1 -->
  <section class="w-section section">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-8">
          <div>
            <div>
              <form action="contactoEnvio.php" id="email-form" name="email-form" method="POST" data-name="Email Form">
                <input class="w-input text-field" id="contactName" type="text" placeholder="Nombre y Apellido" name="name" data-name="Name" required>
                <input class="w-input text-field" id="contactEmail" type="email" name="email" placeholder="Dirección de email" data-name="Email" required>
                <input class="w-input text-field" id="contactSubject" type="text" name="subject" placeholder="Asunto" data-name="Subject" required>
                <textarea class="w-input text-area" id="contactMessage" name="message" placeholder="Escribí tu mensaje..." data-name="Text Area" required></textarea>
                <div class="div-spc">
                  <button class="w-button button no-margin" type="submit">Enviar Mensaje</button>
                </div>
              </form>
              <div id="resultado-envio">
                <!-- contact-success -->
                    <?php if (isset($_SESSION["mensajeEnvio"])) 
                    {
                      echo '<i class="fa fa-check"></i> ' . $_SESSION["mensajeEnvio"];
                    }
                      session_destroy();
                    ?>
              </div>
            </div>
          </div>
        </div>
        <div class="w-col w-col-4">
          <div>
            <!--div class="w-widget w-widget-map" data-widget-latlng="-34.602724200,-58.376739800" data-widget-style="roadmap" data-widget-zoom="12"></div-->
            <div id="map">

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END SECTION 1 -->
  
  
  <?php include('layout/footer.php') ?>
  
  <!-- JQUERY SCRIPTS -->
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
      }
    });
  </script>
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/jquery-moutheme.js"></script>
  <script type="text/javascript" src="js/default.js"></script>
  <script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/form.js"></script>
  <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
  <script type="text/javascript" src="js/tweecool.js"></script>
  <script type="text/javascript" src="js/jquery.stellar.js"></script>
  <script type="text/javascript" src="js/jquery.stellar.js"></script>
  <script>
    $(document).ready(function(){
      function initMap() {
        var location = new google.maps.LatLng(-34.602724,-58.37674);
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: location,
          zoom: 16,
          panControl: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
          position: location,
          map: map,
          title: 'Maipu 474'
        });
      }
      google.maps.event.addDomListener(window, 'load', initMap);
    });
  </script>
  
</body>
</html>