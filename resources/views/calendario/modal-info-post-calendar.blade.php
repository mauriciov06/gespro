<!-- Modal -->
<div class="modal fade modalcustom-app" id="infopost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 30px 30px 28px;">
        <div class="datos-post">
          <h2>Datos del Post</h2>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Tematica del Post:</strong> <div id="tematica_post"></div></label> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Fecha Inicio:</strong> <div id="fecha_ini"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Fecha Final:</strong> <div id="fecha_fin"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
              <label><strong>Asunto:</strong> <div id="asunto"></div></label>
            </div>
          </div>
        </div>
        <div class="datos-post">
          <h2>Datos de la Pauta</h2>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Tipo de post: </strong> <div id="tipo_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Inversión: </strong> <div id="inversion_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Ciudades del post: </strong> <div id="ciudade_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Formato del post: </strong> <div id="formato_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Genero del post: </strong> <div id="gene_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
              <label><strong>Edades del post: </strong> <div id="edades_post"></div></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
              <label><strong>Detalles del post: </strong> <div id="detalle_post"></div></label>
            </div>
          </div>
        </div>
        <div class="datos-post" id="pieza_post_datos">
          <h2>Pieza Grafica</h2>
          <a href="#" target="_blank" class="ver_pie_modal" id="pieza_grafica">Ver Pieza Grafica</a>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>