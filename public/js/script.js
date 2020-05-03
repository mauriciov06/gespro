$(document).ready(function() {

  //Muestra el modal para enviar notificacion de que falta la pieza grafica
  $('.btn-envio-desaprovad').click(function(e){
    e.preventDefault();
    var id = $(this).data("idpos");
    var id_planeacion = $(this).data("idplane");

    $('#enviar-msg-pp').attr('data-idplaenvio', id);
    $('#enviar-msg-pp').attr('data-idposenvio', id_planeacion);

  });

  //Enviar el mensaje por correo cuando no esta subida una pieza grafica
  $('#enviar-msg-pp').click(function(e){
    e.preventDefault();
    var id_post = $(this).data("idposenvio");
    var id_plane = $(this).data("idplaenvio");
    var mensaje = $("#enviodesaprovad-modal #mensaje_revision").val();
    var token = $("#enviodesaprovad-modal #token").val();
    var route = '/mails';

    if(mensaje != ''){
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "GET",
        dataType: "json",
        data: {id_post:id_post,id_plane:id_plane,mensaje:mensaje},
        beforeSend: function() {
          $("#msg-flash-mensajeenvio").html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'><i class='fas fa-sync-alt'></i> Por favor espere un momento estamos enviando el mensaje...</div>");
        },
        success: function(response) {
          if(response['send'] == true){
            $("#msg-flash-mensajeenvio").html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Se ha enviado el mensaje.</div>");
            setTimeout('document.location.reload()', 1500);
          }
        }
      });
    }else{
      $("#msg-flash-mensajeenvio").html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingrese el mensaje.</div>");
    }

  });


  //Muestra el modal para reprobar los post o planeacion
  $('.btn-reproved').click(function(e){
    e.preventDefault();
    var id = $(this).data("idreproved");
    var type = $(this).data("typeoption");
    var fase = $(this).data("faseoption");

    $('#desaprobar-pp').attr('data-idpp', id);
    $('#desaprobar-pp').attr('data-typepp', type);
    $('#desaprobar-pp').attr('data-fasepp', fase);

  });

  //Desaprueba post y planeaciones en seccion de revisiones
  $('#desaprobar-pp').click(function(e){
    e.preventDefault();
    var id = $(this).data("idpp");
    var type = $(this).data("typepp");
    var fase = $(this).data("fasepp");
    var razon_desaprobacion = $('#desaprobacion-modal .modal-body #razon_desaprobacion').val();

    if(razon_desaprobacion != ''){
      var token = $('#desaprobacion-modal .modal-body #token').val();
      var route = "/posts/reproved/"+id;
      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "PUT",
        dataType: "json",
        data: {id:id,type:type,fase:fase,razon_desaprobacion:razon_desaprobacion},
        beforeSend: function() {
          $("#msg-flash-desaprobacion").html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'><i class='fas fa-sync-alt'></i> Por favor espere un momento estamos enviando la información ingresada.</div>");
        },
        success: function(response) {
          if(response['reproved'] == true){
            $("#msg-flash-desaprobacion").html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Se ha enviado la razon de su desaprobación correctamente.</div>");
            setTimeout('document.location.reload()', 1500);
          }
        }
      });
    }else{
      $("#msg-flash-desaprobacion").html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingrese la razón de su desaprobación.</div>");
    }

  });

  //Aprobar post y planeaciones en seccion de revisiones
  $('.btn-aproved').click(function(e){
    e.preventDefault();
    var id = $(this).data("idaproved");
    var type = $(this).data("typeoption");
    var stringData = '';
    if(type != 'post'){
      var fase_aproved = $(this).data("faseaproved");
      stringData = {id:id,type:type,fase_aproved:fase_aproved};
    }else{
      var fase_post = $(this).data("fasenextaproved");
      var fase_aproved = $(this).data("faseaproved");
      stringData = {id:id,type:type,fase_post:fase_post,fase_aproved:fase_aproved};
    }
    var fase_aproved = $(this).data("faseaproved");
    var token = $('#form-'+id+' #token').val();

    var route = "/posts/aproved/"+id;
    var token = $('#verasunto .modal-body #token').val();
    
    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "PUT",
      dataType: "json",
      data: stringData,
      beforeSend: function() {
        $('.group-'+id+' .btn-aproved').hide();
        $('.group-'+id+' .btn-reproved').hide();
        $('.group-'+id).append('<div class="loader"></div>');        
      },
      success: function(response) {
        if(response['aproved'] == true){
          $('.group-'+id+' .loader').hide();
          $('#mensaje-aproved-'+id).html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Se aprobo el post correctamente.</div>");
          setTimeout('document.location.reload()', 1500);
        }
      }
    });

  });

  //Muestra modal con el asunto a ver o editar en la seccion de revisiones.
  $('.verasunto_modal').click(function(e){
    e.preventDefault();
    var id = $(this).data("idpostasunto");

    $('#actualziar-asunto').attr('data-idactuasunto',id);

    var route = '/posts/asunto/'+id+'';
    $.get(route, function(res){
      $('#asunto_script').val(res.asunto);
    });

  });

  //Actualiza el asunto en el modal de la seccion de revisiones
  $('#actualziar-asunto').click(function(e){
    e.preventDefault();
    var id = $(this).data("idactuasunto");
    var asunto = $('#verasunto .modal-body #asunto_script').val();

    if(asunto != ''){
      var route = "/posts/updateasunto/"+id;
      var token = $('#verasunto .modal-body #token').val();
      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "PUT",
        dataType: "json",
        data: {id:id,asunto:asunto},
        beforeSend: function() {
          $('#verasunto .modal-body #msg-flash-asunto').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento estamos actualizando el asunto.</div>");
        },
        success: function(response) {
          if(response['actualizado'] == true){
            $('#verasunto .modal-body #msg-flash-asunto').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Se ha actualizado el asunto correctamente.</div>");
            setTimeout('document.location.reload()', 1500);
          }else{
            $('#verasunto .modal-body #msg-flash-asunto').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>No se ha podido actualizado el asunto.</div>");
          }
        }
      });
    }else{
      $('#verasunto .modal-body #msg-flash-asunto').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingresa el asunto.</div>");
    }

  });

  $('#tipo_post_script').change(function(e){
    e.preventDefault();
    var tipo_post = $(this).val();
    
    if(tipo_post == 'Organico'){
      $('#inver_ini_script').val(0);
    }else{
      $('#inver_ini_script').val('');
    }
  });

  //Muestra modal de confirmacion de eliminacion al dar click en boton de eliminar usuario.
  $('.btn-eliminar').click(function(e){
    e.preventDefault();
    var id = $(this).data("ideliminar");

    //Valida cuantos contactos tiene un cliente
    var ruta = location.pathname;
    if(ruta == '/clientes'){
      var route = '/clientes/contactos/'+id+'';
      $.get(route, function(res){
        $('#modaleliminar .modal-body p').text('Estas seguro de eliminar este cliente tiene '+res.num_contactos+' contacto?');
      });
    }else if(ruta == '/planeaciones'){
      var route = '/planeaciones/post/'+id+'';
      $.get(route, function(res){
        $('#modaleliminar .modal-body p').text('Estas seguro de eliminar esta planeación tiene '+res.num_posts+' posts?');
      });
    }
    //Termina validacion de contactos de un cliente

    $('#confirmacion-eliminar').attr('data-idconfieliminar',id);
  });

  //Valida que se ingrese la contraseña y posteriormente elimina el usuario confirmado.
  $('#confirmacion-eliminar').click(function(e){
    e.preventDefault();

    var ruta = location.pathname;
    var contrasena = $('#password-confi').val();
    var id = $(this).data("idconfieliminar");

    if(contrasena != ''){
      if(ruta.indexOf('listado-contactos') != -1){
        ruta = '/contactos';
      }else if(ruta.indexOf('listado-posts') != -1){
        ruta = '/posts';
      }
      var route = ruta+"/"+id;
      var token = $('#token').val();
      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "DELETE",
        data: {id:id,contrasena:contrasena},
        beforeSend: function() {
          $('#msg-eliminacion').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento estamos validando la información ingresada.</div>");
        },
        success: function(response) {
          if(response.borrado == true){
            $('#msg-eliminacion').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
            setTimeout('document.location.reload()', 1500);
          }else{
            $('#msg-eliminacion').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>La contraseña es incorrecta.</div>");
          }
        }
      });

    }else{
      $('#msg-eliminacion').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingresa la contraseña para confirmar la eliminación.</div>");
    }
  });

  //Limpia los campos de las busquedas.
  $('#button-clear-search').click(function(e){
    e.preventDefault();
    $('.search_filter #nombre_usu').val('');
    $('.search_filter #correo_usu').val('');
    $('.search_filter #ciudad_usu').val('');
    $('.search_filter #nombre_equipo').val('');
    $('.search_filter #tipo_cuen').val('');
    $('.search_filter #nombre_soli').val('');
    $('.search_filter #tema_urge').val('');
    $('.search_filter #nombre_plan').val('');
    $('.search_filter #servicio_plan').val('');
    $('.search_filter #estado_plan').val('');
    $('.search_filter #nombre_post').val('');
    $('.search_filter #tip_pos').val('');
  });


  $('.btn-editar-equipo').click(function(e){
    e.preventDefault();
    $('#modalequipo .modal-title').text('Editar Equipo');
    $('#modalequipo .btn-equipo#crear-equipo').hide();
    $('#modalequipo .btn-equipo#actualizar-equipo').show();
    var id = $(this).data("ideditarequipo");

    var route = '/equipos/'+id+'/edit';

    $.get(route, function(res){
      $('#nombre_equ').val(res.nombre_equipo);
      $('.btn-equipo#actualizar-equipo').attr('data-idequipoupdate',res.id);
    });

  });

  $('#btn-crear-equipo').click(function(e){
    e.preventDefault();

    $('#modalequipo .modal-title').text('Crear Equipo');
    $("#nombre_equ").val('');
    $('#modalequipo .btn-equipo#crear-equipo').show();
    $('#modalequipo .btn-equipo#actualizar-equipo').hide();

  });

  $('#crear-equipo').click(function(e){
    e.preventDefault();
    
    var dato = $("#nombre_equ").val();
    var token = $("#token").val();
    var route = "/equipos";

    if(dato != ''){
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: "POST",
        dataType: "json",
        data: {nombre_equipo:dato},
        beforeSend: function() {
          $('#msg-equipo').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento estamos creando el equipo.</div>");
        },
        success: function(response) {
          $('#msg-equipo').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
            setTimeout('document.location.reload()', 1500);
        }
      });
    }else{
      $('#msg-equipo').html("<div class='alert alert-danger' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor ingrese el nombre del equipo</div>");
    }

  });

  $('#actualizar-equipo').click(function(e){
    e.preventDefault();

    var value = $("#nombre_equ").val();
    var id = $(this).data("idequipoupdate");
    var token = $("#token").val();
    var route = "/equipos/"+id;

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: "PUT",
      dataType: "json",
      data: {id:id,equipo:value},
      beforeSend: function() {
        $('#msg-equipo').html("<div class='alert alert-info' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>Por favor espere un momento estamos actualizando el equipo.</div>");
      },
      success: function(response) {
        $('#msg-equipo').html("<div class='alert alert-success' role='alert' style='margin-bottom: 0;margin-top: 12px;font-size: 14px;padding: 12px;'>"+response.mensaje+"</div>");
        setTimeout('document.location.reload()', 1500);
      }
    });

  });

  $('input[name=editable]').click(function(e){
    changeeditable();
  });


});

$(function() {
  changeeditable();
});

$(function () {
  $('#datetimepicker2, #datetimepicker3, #datetimepicker4,#datetimepicker5').datetimepicker({
    format: 'YYYY-MM-DD'
  });
});

(function($){
    $(window).on("load",function(){
        $(".notification-list, .sidebar-letf .menu-sidebar-left").mCustomScrollbar({
				    theme:"minimal-dark"
				});
    });
})(jQuery);

(function($){
    $(window).on("load",function(){
        $(".content-seccion").mCustomScrollbar({
            theme:"minimal-dark",
            setHeight: 600,
        });
    });
})(jQuery);

$(function() {
  var menues = $(".sidebar-letf .menu-sidebar-left li > a"); 
  menues.click(function() {
     menues.removeClass("active");
     $(this).addClass("active");
  });

  $('.sidebar-letf').on('mouseleave', function() {
    $("#accordionExample .collapse").removeClass("show");
  });
});

function changeeditable() {
  var value_editable = $('input[name=editable]:checked').val();
  if(value_editable != 0){
    $('#contentino-editable').show();
  }else{
    $('#contentino-editable').hide();
  }
}

function archivo(evt) {
  var files = evt.target.files; // FileList object

  // Obtenemos la imagen del campo "file".
  for (var i = 0, f; f = files[i]; i++) {
  //Solo admitimos imágenes.
    if (!f.type.match('image.*')) {
    continue;
  }

  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {
      // Insertamos la imagen
      document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
    };
  })(f);

  reader.readAsDataURL(f);
  }
}
document.getElementById('files').addEventListener('change', archivo, false);