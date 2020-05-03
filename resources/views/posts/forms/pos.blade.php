<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="sub-datos">
		<div class="title-sub-datos">
			<h3>Datos del Post</h3>
		</div>
		<div class="content-sub-datos" style="margin-bottom: -7px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Tematica post'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
						<?php if(!empty($post)){ ?>
            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Fecha Inicio" value="{!!$post->start!!}" />
            <?php }else{ ?>
            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Fecha Inicio" />
            <?php }?>
            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
            </div>
	        </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker5" data-target-input="nearest">
						<?php if(!empty($post)){ ?>
            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker5" placeholder="Fecha Final" value="{!!$post->end!!}" />
            <?php }else{ ?>
            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker5" placeholder="Fecha Final" />
            <?php }?>
            <div class="input-group-append" data-target="#datetimepicker5" data-toggle="datetimepicker">
                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
            </div>
	        </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group" style="color: #868686;font-size: 18px;">
					{!!Form::label('editable', 'Editable:')!!}
					{!!Form::radio('editable', 1)!!} Si
					{!!Form::radio('editable', 0)!!} No
					<div id="contentino-editable">
						<input type="file" name="adjunto_editable" id="files" class="inputfile inputfile-1" style="bottom: 0;height: 50px;width: 100%;" />
						<label for="adjunto_editable" style="max-width: 100%;text-align: center;font-size: 20px;"><span>Adjuntar Editable</span></label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 float-left">
				<div class="form-group">
					{!!Form::textarea('asunto',null,['class'=>'form-control', 'placeholder'=>'Asunto'])!!}
				</div>
			</div>
		</div>
	</div>
	<div class="sub-datos">
		<div class="title-sub-datos">
			<h3>Pieza Grafica</h3>
		</div>
		<div class="content-sub-datos" style="margin-bottom: -7px;">
			<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4 col-lg-4 offset-lg-4 float-left">
				<div class="form-group text-center" style="margin-bottom: 0;">
					<input type="file" name="adjunto_pieza_grafica" id="files" class="inputfile inputfile-1" style="bottom: 0;height: 50px;width: 100%;" />
					<label for="adjunto_pieza_grafica" style="max-width: 100%;text-align: center;font-size: 20px;"><span>Adjuntar Pieza Grafica</span></label>
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
					{!!Form::select('tipo_post',['Organico'=>'Organico','Pago'=>'Pago'], null,['class'=>'form-control', 'placeholder'=>'Tipos post', 'id'=>'tipo_post_script'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('inversion_inicial',null,['class'=>'form-control', 'placeholder'=>'Inversión', 'id'=>'inver_ini_script'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::text('ciudades_post',null,['class'=>'form-control', 'placeholder'=>'Ciudades separadas por coma (,)'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::select('formato_post',['Jpg'=>'Jpg','Video'=>'Video','Secuencua'=>'Secuencua','Canvas'=>'Canvas'], null,['class'=>'form-control', 'placeholder'=>'Formato de post'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::select('genero_post',['Mujeres'=>'Mujeres','Hombres'=>'Hombres','Mujeres y Hombres'=>'Mujeres y Hombres'], null,['class'=>'form-control', 'placeholder'=>'Genero'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
				<div class="form-group">
					{!!Form::select('edades_post',['23 a 52'=>'23 a 52','20 a 55'=>'20 a 55','18 a 55'=>'18 a 55'], null,['class'=>'form-control', 'placeholder'=>'Edades'])!!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
				<div class="form-group">
					{!!Form::textarea('describir_detalles_post',null,['class'=>'form-control', 'placeholder'=>'Describir detalles de post'])!!}
				</div>
			</div>
		</div>
	</div>
</div>
{!!Form::hidden('id_usuario', Auth::id())!!}
<?php if(!empty($post)){ ?>
	<input type="hidden" name="fase_post" value="{{$post->fase_post}}">
<?php }else{ ?>
	<input type="hidden" name="fase_post" value="en-espera">
<?php }?>
<?php if(!empty($idplaneacion)){ ?>
	<input type="hidden" name="id_planeacion" value="<?php echo $idplaneacion; ?>">
<?php }?>
{!!Form::hidden('estado', 0)!!}