<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Recordatorio de subida de pieza grafica</title>
	</head>
	<body>
		<p><strong>Planeación:</strong> {!!$planeacion->nombre_planeacion!!}</p>
		<p><strong>Nombre post:</strong> {!!$post->title!!}</p>
		<p><strong>Fecha de Inicio:</strong> <?php echo $date_ini = date("d-m-Y", strtotime($post->start)); ?></p>
		<p><strong>Fecha Final:</strong> <?php echo $date_fin = date("d-m-Y", strtotime($post->end)); ?></p>
		<p><strong>Tipo de post:</strong> {!!$post->tipo_post!!}</p>
		<p><strong>Inversión:</strong> ${!!$post->inversion_inicial!!}</p>
		<p><strong>Asunto:</strong> {!!$post->asunto!!}</p>
		<p><strong>Mensaje:</strong>{!!$_GET['mensaje']!!}</p>
	</body>
</html>