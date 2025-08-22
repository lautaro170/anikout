<?php
include_once("admin/controller/funciones.php");


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

$registerErrorMessage = registrar();

include_once("header.php");

?>

<div class="container" id="pedido">
    <div class="row" id="menupedido">
        <div class="col-12 col-md-7">
            <?php 
            include_once("template-parts/block-fecha-entrega.php");
            include_once("template-parts/login.php");
            include_once("template-parts/register.php");
            ?>
        </div>
        <div class="col-12 col-md-4">
            <?php 
            //include_once("template-parts/block-horarios-entrega.php");
            //include_once("template-parts/block-medios-pago.php");
            include_once("template-parts/mi-pedido-pagina-registro.php");
            ?>

        </div>
    </div>
</div>
<?php
include_once("template-parts/register.php");
include_once("template-parts/modal-confirmar-pedido.php");
include_once("template-parts/modal-pedido-enviado-exitosamente.php");
include_once("template-parts/modal-pedido-enviado-error.php");
include_once("template-parts/scroll-links.php");
?>

<script type="text/javascript" src="js/custom.js?v=10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

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
