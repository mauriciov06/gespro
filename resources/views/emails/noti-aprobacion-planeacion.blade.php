<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Aprobación</title>
	</head>
	<body>
		<h2>Información de la Planeación Aprobada</h2>
		<p><strong>Planeación:</strong> {!!$planeacion->nombre_planeacion!!}</p>
		<p><strong>Fecha de Inicio:</strong> <?php echo $date_ini = date("d-m-Y", strtotime($planeacion->start)); ?></p>
		<p><strong>Inversión inicial:</strong> <?php echo '$'.number_format($planeacion->inversion_inicial); ?></p>
		<p><strong>Tipo servicio:</strong> {!!$planeacion->tipo_servicio!!}</p>
		<p><strong>Ciudades de la Planeación:</strong> {!!$planeacion->ciudades_planeacion!!}</p>
		<p><strong>Edades de la Planeación:</strong> {!!$planeacion->edades_planeacion!!}</p>
		<p><strong>Detalles de la Planeación:</strong> {!!$planeacion->detalles_planeacion!!}</p>
		
	</body>
</html>