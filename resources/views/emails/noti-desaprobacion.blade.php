<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Desaprobaciones</title>
	</head>
	<body>
		<p><strong>Razon desaprobación:</strong> {!!$razon_desa!!}</p>
		@if($type_obj == 'post')
			<h2>Información de Post</h2>
			<p><strong>Nombre post:</strong> {!!$dataReproved->title!!}</p>
			<p><strong>Fecha de Inicio:</strong> <?php echo $date_ini = date("d-m-Y", strtotime($dataReproved->start)); ?></p>
			<p><strong>Fecha Final:</strong> <?php echo $date_fin = date("d-m-Y", strtotime($dataReproved->end)); ?></p>
			<p><strong>Tipo de post:</strong> {!!$dataReproved->tipo_post!!}</p>
			<p><strong>Inversión:</strong> <?php echo '$'.number_format($dataReproved->inversion_inicial); ?></p>
			<p><strong>Asunto:</strong> {!!$dataReproved->asunto!!}</p>
			<p><strong>Pieza grafica:</strong> <a href="http://127.0.0.1:8000/piezas-graficas/{!!$dataReproved->adjunto_pieza_grafica!!}">Ver pieza grafica</a></p>
		@else
			<h2>Información de la Planeación</h2>
			<p><strong>Planeación:</strong> {!!$dataReproved->nombre_planeacion!!}</p>
			<p><strong>Fecha de Inicio:</strong> <?php echo $date_ini = date("d-m-Y", strtotime($dataReproved->start)); ?></p>
			<p><strong>Inversión inicial:</strong> <?php echo '$'.number_format($dataReproved->inversion_inicial); ?></p>
			<p><strong>Ciudades de la Planeación:</strong> {!!$dataReproved->ciudades_planeacion!!}</p>
			<p><strong>Edades de la Planeación:</strong> {!!$dataReproved->edades_planeacion!!}</p>
		@endif
		
	</body>
</html>