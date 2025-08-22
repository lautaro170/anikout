<?php 
include_once("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-8">
      <?php

      $categorias = getAllCategorias();

      while ($cat=mysql_fetch_array($categorias)) {
        $catid = $cat["CategoriaId"];
        $nom = $cat["Nombre"];
        $acl = $cat["Aclaracion"];  
        $precio = $cat["Precio"];   
        ?>
        <h3 class="subtitulos"><?php echo $nom; ?> - $<?php echo $precio; ?></h3>
        <p class="cateroria-aclaracion"><?php echo $acl; ?></p>
        <div class="carrousel-comidas row">
          <div class="card-deck col-12">
            <?php
            $productos = getProductsByCategory($catid);
            foreach( $productos as $prod) {
              $prodid = $prod["productoid"];
              $nombre = $prod["nombre"];
              $desc = $prod["descripcion"];
              $img = "admin/" . $prod["imagen"];
              $vegano = $prod["vegano"];
              $singluten = $prod["singluten"];      

              ?>
              <div class="col-12 col-sm-6 ">
                <div class="card no-padding">
                  <img class="card-img-top img-fluid" src="<?php echo $img; ?>" alt="Card image cap">
                  <div class="card-block">
                    <h4 class="card-title"><?php echo $nombre; ?></h4>
                    <p class="card-text"><?php echo $desc; ?></p>
                    <div class="row pull-right type-food">                 
                      <?php if($vegano == 1){ ?>         
                      <i class="fa fa-leaf" aria-hidden="true"></i><p class="card-text">Vegano</p> 
                      <?php } if($singluten == 1){ ?>         
                      <i class="fa fa-star" aria-hidden="true"></i><p class="card-text">Sin Gluten</p>
                      <?php } ?>
                    </div>               
                  </div>
                  <?php if($catid == 1)
                  {
                    ?>
                    <div class="card-footer">
                      <small class="text-muted">Chico</small>
                      <input type="number" data-price="<?php echo $precio; ?>" data-medida="chico" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                      <small class="text-muted">Mediano</small>
                      <input type="number" data-price="<?php echo $precio; ?>" data-medida="mediano"  value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                      <small class="text-muted">Grande</small>
                      <input type="number" data-price="<?php echo $precio; ?>" data-medida="grande" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                    </div>

                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="card-footer">
                      <small class="text-muted">Cantidad</small>
                      <input type="number" data-price="<?php echo $precio; ?>" data-medida="unidad" value="0" data-id="<?php echo $prodid; ?>" data-prod="<?php echo $nombre; ?>" class="cant-field" />
                    </div>

                    <?php
                  }
                  ?>
                </div>
              </div>

              <?php 
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
    <div class="col-12 col-md-4">
      <div class="wrapper-col-resumen-pedido">
        <div class="col-12 mi-pedido">
          <span class="titulo-resumen-pedido">Mi pedido</span>        
        </div>
        <div id="pedido-lista">
          <div class="col-12 separacion">
            <p>Todavia no agrego ningun producto a la lista</p>
          </div>
        </div>

        <div class="col-12 separacion">
          <?php

          $resultado = getUsuarioDireccion($_SESSION['u_id_a']);
          $dire = "";
          while ($user=mysql_fetch_array($resultado)) {
            $dire = $user["address"];
            $delivery = $user["delivery"];
          }


          ?>
          <span>Delivery para <?php echo $dire;?>. Valor $<?php echo $delivery;?></span>   

        </div>

        <div class="input-group separacion">
          <input type="text" class="form-control notas-adicionales" placeholder="Agregar notas adicionales" />
        </div>

        <div class="col-12 text-center buttons">
          <button type="button" id="btnConfirmarPedido" class="btn btn-pedido">REALIZAR PEDIDO</button>
          <button type="button" id="btnOtroPedido" class="btn btn-pedido otro-pedido">REALIZAR OTRO PEDIDO</button>
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