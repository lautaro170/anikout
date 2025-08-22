<?php 
include_once("header.php");
?>
<div class="container" id="pedido">
  <div class="row">
    <div class="col-12 col-md-8">
        <h3 class="subtitulos">Viandas Chicas $90</h3>
        <h4>250 gr.</h4>
        <div class="card no-padding">
          <div class="col-12 card-top">
            <h4 class="card-title">Tarta de vegetales de estación CHICA</h4>
            <p class="card-text">con masa casera de harina integral orgánica</p>
          </div>
          <div class="col-12 brd-top">
            <div class="row">
              <div class="col-2 card-btm brd-right">
                Cantidad
              </div>
              <div class="col-1 card-btm brd-right text-center">
                0
              </div>
              <div class="col-9 card-btm ">
                
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="wrapper-col-resumen-pedido">
        <div class="col-12 mi-pedido">
          <h3 class="titulo-resumen-pedido">Mi pedido</h3>        
        </div>
        <div id="pedido-lista">
          <div class="col-12 separacion">
            <p>Todavia no agrego ningun producto a la lista</p>
          </div>
        </div>

        <div class="col-12 separacion">
            <span>Delivery para </span>  
        </div>

        <div class="input-group separacion">
          <input type="text" class="form-control notas-adicionales" placeholder="Agregar notas adicionales" />
        </div>

        <div class="col-12 text-center buttons">
            <button type="button" id="btnConfirmarPedido" class="btn btn-pedido">REALIZAR PEDIDO</button>
            <button type="button" id="btnOtroPedido" class="btn btn-pedido otro-pedido">REALIZAR OTRO PEDIDO</button>        
            <button type="button" id="btnRegistrarme" class="btn btn-pedido">REGISTRARME</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container" id="leyenda" style="display: none;">
  <div class="row">
    <div class="col-12 text-center">
      <div class="wrapper-col-resumen-pedido">
        <div class="col-12 mi-pedido">
          <span class="titulo-resumen-pedido">Oops! llegaste tarde!  
          Acordate que los pedidos se pueden realizar desde el jueves 10hs hasta el Sabado 13hs.</br>
        Disculpa el inconveniente.</br>
      Sumate la semana próxima,</br>
      Abrazo, Ani
    </span>        
  </div>        
</div>
</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


</body>
</html>