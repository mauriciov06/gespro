<!-- Modal -->
<div class="modal fade modalcustom-app" id="verasunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 600px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle del Asunto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea type="text" name="asunto" class="form-control" id="asunto_script" placeholder="Asunto" rows="5"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div id="msg-flash-asunto"></div>
      </div>
      <div class="modal-footer">
        <a id="actualziar-asunto" class="btn btn-primary" data-idactuasunto="">Actualizar Asunto</a>
        <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>