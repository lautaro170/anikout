<!-- Modal Pedido Enviado con exito-->
<div class="modal fade" id="modalPedidoEnviadoConExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#a9dec2;">
        <h3 class="modal-title" style="font-weight:700" id="exampleModalLabel">Pedido Enviado Correctamente</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Recibimos el pedido correctamente. La entrega se realizará el día  <?php echo $fechaEntrega;?>. Esperamos la disfrutes!!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
