<!-- Modal -->
<div class="modal fade modalcustom-app" id="modalequipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel"></h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
			    <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  @include('equipo.forms.equ')
			</div>
			<div class="modal-footer">
			  <a class="btn btn-primary btn-equipo" id="crear-equipo">Crear</a>
			  <a class="btn btn-primary btn-equipo" id="actualizar-equipo" data-idequipoupdate="" style="display: none;">Actualizar</a>
			  <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
			</div>
    </div>
  </div>
</div>