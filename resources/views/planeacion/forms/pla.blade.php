<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="sub-datos">
		<div class="title-sub-datos">
			<h3>Datos de la Planeación</h3>
		</div>
		<div class="content-sub-datos" style="margin-bottom: -7px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('nombre_planeacion',null,['class'=>'form-control', 'placeholder'=>'Nombre de planeación'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
						<?php if(!empty($planeacion)){ ?>
            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker3" placeholder="Fecha Inicio" value="{!!$planeacion->start!!}" />
            <?php }else{ ?>
            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker3" placeholder="Fecha Inicio" />
            <?php }?>
            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
            </div>
	        </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
						<?php if(!empty($planeacion)){ ?>
            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="Fecha Final" value="{!!$planeacion->end!!}" />
            <?php }else{ ?>
            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="Fecha Final" />
            <?php }?>
            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
            </div>
	        </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('tipo_servicio', null,['class'=>'form-control', 'placeholder'=>'Servicios'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('momentos',null,['class'=>'form-control', 'placeholder'=>'Momentos'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					<input type="file" name="archivo_adjunto" id="files" class="inputfile inputfile-1" style="bottom: 0;height: 50px;width: 100%;" />
					<label for="archivo_adjunto" style="max-width: 100%;text-align: center;font-size: 20px;"><span>Adjuntar Archivo</span></label>
				</div>
			</div>
		</div>
	</div>
	<div class="sub-datos">
		<div class="title-sub-datos">
			<h3>Datos de la Pauta</h3>
		</div>
		<div class="content-sub-datos" style="margin-bottom: -7px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('inversion_inicial',null,['class'=>'form-control', 'placeholder'=>'Inversión'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('ciudades_planeacion',null,['class'=>'form-control', 'placeholder'=>'Ciudades separadas por coma (,)'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::select('edades_planeacion',['23 a 52'=>'23 a 52','20 a 55'=>'20 a 55','18 a 55'=>'18 a 55'], null,['class'=>'form-control', 'placeholder'=>'Edades'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
		<div class="form-group">
			{!!Form::textarea('detalles_planeacion',null,['class'=>'form-control', 'placeholder'=>'Describir detalles de pauta'])!!}
		</div>
	</div>
		</div>
	</div>
</div>
{!!Form::hidden('id_usuario', Auth::id())!!}
{!!Form::hidden('estado', 'en-espera')!!}