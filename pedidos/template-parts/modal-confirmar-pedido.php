<!-- Modal Confirmar Pedido-->
<div class="modal fade" id="modalConfirmarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#a9dec2;">
        <h3 class="modal-title" style="font-weight:700" id="exampleModalLabel">Confirmar Pedido</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea confirmar el pedido con fecha de entrega <?php echo $fechaEntrega;?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnConfirmarPedido" class="btn" style="background:#F09780; font-family: 'Montserrat', sans-serif; font-weight: 700;" >Confirmar Pedido</button>
      </div>
    </div>
  </div>
</div>
