<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <title>Gespro - @yield('title')</title>

  {!!Html::style('css/bootstrap.min.css')!!}
  {!!Html::style('css/style.css')!!}
  {!!Html::style('css/jquery.mCustomScrollbar.min.css')!!}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
</head>
<body>
  <div class="container-fluid">
    <div class="row">
    	<div class="sidebar-letf">
        <div class="left-title">
          <a href="#">GP</a>
          <a href="#">Gestor de Procesos</a>
        </div>
        <div class="left-avatar">
          <a href="javascript:void(0);"> 
            <div style="overflow: hidden;border-radius: 50%;display: inline-block;text-align: center;margin-right: 20px;">
              <?php 
                $user_avatar = '';
                if(Auth::user()->avatar == 0){
                  $user_avatar = '/imagenes/avatar-default.png';
                }else{
                  $user_avatar = '/avatares/'.Auth::user()->avatar;
                }
              ?>
              <img src="<?php echo $user_avatar; ?>" width="60" height="60">
            </div>
            <span>
              <?php 
                $name_user = explode(' ',Auth::user()->name);
                if(count($name_user) > 2){
                  echo $name_user[0].' '.$name_user[1];
                }else{
                  echo $name_user[0];
                }
              ?>
            </span></i>
          </a>
        </div>
        <ul class="menu-sidebar-left">
          <div class="accordion" id="accordionExample">
            @if(Auth::user()->tipo_cuenta == 1)
              <li>
                <a class="active" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="far fa-user"></i> <span>Usuarios</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('usuarios/create')!!}">Crear Usuario</a>
                    <a href="{!! url('usuarios')!!}">Listado de Usuarios</a>
                  </div>
                </div>
              </li>
              <li>
                <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fas fa-users"></i> <span>Clientes</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('clientes/create')!!}">Crear Cliente</a>
                    <a href="{!! url('clientes')!!}">Listado de Clientes</a>
                  </div>
                </div>
              </li>
              <li>
                <a data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fas fa-sitemap"></i>  <span>Equipos</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('equipos')!!}">Listado de Equipos</a>
                  </div>
                </div>
              </li>
              <li>
                <a data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><i class="far fa-calendar-alt"></i> <span>Calendario</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('calendario')!!}">Ver Calendario</a>
                  </div>
                </div>
              </li>
            @endif
              <li>
                <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fas fa-project-diagram"></i> <span>Planeación</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('planeaciones/create')!!}">Crear Planeación</a>
                    <a href="{!! url('planeaciones')!!}">Listado de Planeaciones</a>
                  </div>
                </div>
              </li>
              <li>
                <a data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="far fa-edit"></i> <span>Solicitudes</span><i class="fas fa-caret-down"></i></a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card card-body">
                    <a href="{!! url('solicitudes/create')!!}">Crear Solicitud</a>
                    <a href="{!! url('solicitudes')!!}">Listado de Solicitudes</a>
                  </div>
                </div>
              </li>
          </div>
        </ul>
      </div>
      <div class="sidebar-content">
        <nav id="main-navegation" class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav" style="display: initial;width: 100%;">
              <li class="nav-item" style="font-size: 24px;color: #fff;line-height: 2;display: block;margin: 0;float: left;">
                @yield('title')
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{!!URL::to('/cerrar-sesion')!!}">Cerrar Sesión</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell"></i><!--<span class="badge badge-danger badge-custom">4</span>-->
                </a>
                <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item">Tiene 14 Notificaciones</a>
                  <div class="dropdown-divider"></div>
                  <ul class="notification-list">
                    <li><a href="#">Ajuste en una campaña</a></li>
                    <li><a href="#">Ajuste en un post</a></li>
                    <li><a href="#">Esta por vencerse una tarea</a></li>
                    <li><a href="#">Ajuste en una campaña</a></li>
                  </ul>
                </div>-->
              </li>
            </ul>
          </div>
        </nav>
        <div class="content-seccion">
          @include('alerts.sucess')
          @include('alerts.request')
          @yield('content')
        </div>
      </div>
      <!-- Modal de eliminacion de usuario -->
      @include('modal-eliminacion.modal-eliminar')
      <!-- Modal de creacion y edicion de equipos -->
      @include('equipo.modal-equipo')
      <!-- Modal para ver info del post en el calendario -->
      @include('calendario.modal-info-post-calendar')
      <!-- Modal para ver el asunto de los posts en revisiones -->
      @include('revisiones.modal-asuntos')
      <!-- Modal para desaprobar planeacion y posts en revisiones -->
      @include('revisiones.modal-reproved')
      <!-- Modal para enviar una notificacion de que falta subir una pieza grafica -->
      @include('revisiones.modal-notisubir-pieza-grafica')
    </div>
  </div>
</body>
  
  {!!Html::script('js/jquery.min.js')!!}
  {!!Html::script('js/bootstrap.min.js')!!}
  {!!Html::script('js/script.js')!!}
  {!!Html::script('js/jquery.mCustomScrollbar.min.js')!!}
  {!!Html::script('js/jquery.mCustomScrollbar.concat.min.js')!!}
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

  @section('scripts')
  @show


</html>