<!-- Modal -->
<div class="modal fade modalcustom-app" id="enviodesaprovad-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 500px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Envio de solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea type="text" name="mensaje" class="form-control" id="mensaje_revision" placeholder="Describa el mensaje" rows="5"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div id="msg-flash-mensajeenvio"></div>
      </div>
      <div class="modal-footer">
        <a id="enviar-msg-pp" class="btn btn-primary" data-idplaenvio="" data-idposenvio="">Enviar</a>
        <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>