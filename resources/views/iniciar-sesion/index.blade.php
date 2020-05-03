<!DOCTYPE html>
<html>
  <head>
    <title>Gespro - Iniciar Sesion</title>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/jquery.mCustomScrollbar.min.css')!!}
   
  </head>
  <body class="body-login">

  	<div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-left">
          <a href="{!!URL::to('https://www.gomind.com.co/')!!}">
            <img class="img-responsive" src="/imagenes/logo-gomindsas.png" alt="">
          </a>
          <div class="content-login">
          	<h3>Iniciar Sesion</h3>
            {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
              <div class="form-group">
                {!!Form::label('Correo Electronico')!!}
                {!!Form::email('email', null,['class'=>'form-control'])!!}
              </div>
              <div class="form-group" style="margin-bottom: 0;">
                {!!Form::label('Contraseña')!!}
                {!!Form::password('password', ['class'=>'form-control'])!!}
              </div>
              <div class="form-group" style="display: inline-block;width: 100%;margin-bottom: 0;">
                @include('alerts.errors')
              </div>
              {!!Form::submit('Entrar',['class'=>'btn btn-login'])!!}
            {!!Form::close()!!}

          </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-9 col-lg-9 col-md-offset-3 main-right">
          <img src="/imagenes/banner-inicio-sesion.jpg" class="img-responsive" alt="">
        </div>
      </div>
    </div>

		{!!Html::script('js/jquery.min.js')!!}
	  {!!Html::script('js/bootstrap.min.js')!!}
	  {!!Html::script('js/script.js')!!}
	  {!!Html::script('js/jquery.mCustomScrollbar.min.js')!!}
  	{!!Html::script('js/jquery.mCustomScrollbar.concat.min.js')!!}
  </body>
</html>