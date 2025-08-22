<?php
include_once("header.php");


 $conn=conectar();
 $cdquery="SELECT * from web_cierre_sistema;";

$cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from first table failed: ".mysqli_error($conn));

 $cdrow=mysqli_fetch_array($cdresult);

 $texto = $cdrow["texto"];
 $desactivar =$cdrow["desactivar"];


 $dt = new DateTime();
 $fechaPedido =  $dt->format('Y-m-d H:i:s');
 $fechaEntregaRaw = getFechaEntrega($fechaPedido);

$dateTimeFechaEntrega = new DateTime($fechaEntregaRaw, new DateTimeZone('America/Argentina/Buenos_Aires'));

$fechaEntrega = 
IntlDateFormatter::formatObject( 
  $dateTimeFechaEntrega, 
  "eeee d 'de' MMMM", 
  'es' 
);

if($desactivar == 0)
{
  include_once("template-parts/main-content.php");
} else{
  include_once("template-parts/mensaje-pagina-cerrada.php");
}

include_once("template-parts/modal-confirmar-pedido.php");
include_once("template-parts/modal-pedido-enviado-exitosamente.php");
include_once("template-parts/modal-estamos-procesando-tu-pedido.php");
include_once("template-parts/modal-pedido-enviado-error.php");
include_once("template-parts/scroll-links.php");
?>



<script type="text/javascript" src="js/custom.js?v=11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


</body>
</html>
