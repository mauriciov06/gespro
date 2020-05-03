<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Aprobaciones</title>
	</head>
	<body>
		<h2>Información del Post</h2>
		<p><strong>Nombre post:</strong> {!!$post->title!!}</p>
		<p><strong>Fecha de Inicio:</strong> <?php echo $date_ini = date("d-m-Y", strtotime($post->start)); ?></p>
		<p><strong>Fecha Final:</strong> <?php echo $date_fin = date("d-m-Y", strtotime($post->end)); ?></p>
		<p><strong>Tipo de post:</strong> {!!$post->tipo_post!!}</p>
		<p><strong>Inversión:</strong> <?php echo '$'.number_format($post->inversion_inicial); ?></p>
		<p><strong>Asunto:</strong> {!!$post->asunto!!}</p>
	</body>
</html>