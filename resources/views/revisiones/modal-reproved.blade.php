<!-- Modal -->
<div class="modal fade modalcustom-app" id="desaprobacion-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Desaprobación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea type="text" name="razon_desaprobacion" class="form-control" id="razon_desaprobacion" placeholder="Describa la razón de su desaprobación" rows="5"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div id="msg-flash-desaprobacion"></div>
      </div>
      <div class="modal-footer">
        <a id="desaprobar-pp" class="btn btn-primary" data-idpp="" data-typepp="" data-fasepp="">Desaprobar</a>
        <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>