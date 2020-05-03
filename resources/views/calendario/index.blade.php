@extends('layouts.app')

@section('title', 'Dashboard')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>

@section('content')
	<div class="title-content-form">
		<h2>Calendario</h2>
	</div>
	
	<div class="conten-form">	
		<div class="p-0">
			<div id="calendar"></div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  {!!Html::script('js/locale-all.js')!!}

	<script type="text/javascript">

		$(document).ready(function() {
			var route = 'calendario/listspost/'+<?php echo Auth::id(); ?>;

			$.get(route, function(data){
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek,month,listMonth'
          },
          buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Dia',
            listDay: 'Agenda Diaria',
            listWeek: 'Agenda Semanal',
            listMonth: 'Agenda Mensual'
          },
          defaultDate: new Date(),
          locale: 'es',
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          editable: true,
          events: $.parseJSON(data),
          eventDrop: function(event){
            var id = event.id;
            var fi = event.start.format();
            $.get("/calendario/updatePost/"+id+"/fecha_inicio/"+fi, function(res){
              if (res.actualizado == true) {
                alert('Post actualizado correctamente.');
              }else{
                alert('Error al actualizar el posts.');
              }
            });
          },
          eventClick: function(event) {
            var id = event.id;
            $.get("/calendario/infoPost/"+id, function(res){
              $('#infopost-modal #tematica_post').html(res.title);

              var date_ini = new Date(res.start);
              var year = date_ini.getFullYear();
              var month = date_ini.getMonth()+1;
              var day = date_ini.getDate()+1;
              $('#infopost-modal #fecha_ini').html(day+'/'+month+'/'+year);

              var date_fin = new Date(res.end);
              var year_fin = date_fin.getFullYear();
              var month_fin = date_fin.getMonth()+1;
              var day_fin = date_fin.getDate()+1;
              $('#infopost-modal #fecha_fin').html(day_fin+'/'+month_fin+'/'+year_fin);

              $('#infopost-modal #asunto').html(res.asunto);
              $('#infopost-modal #tipo_post').html(res.tipo_post);
              $('#infopost-modal #inversion_post').html('$'+number_format(res.inversion_inicial),1);
              $('#infopost-modal #ciudade_post').html(res.ciudades_post);
              $('#infopost-modal #formato_post').html(res.formato_post);
              $('#infopost-modal #gene_post').html(res.genero_post);
              $('#infopost-modal #edades_post').html(res.edades_post);
              $('#infopost-modal #detalle_post').html(res.describir_detalles_post);

              if(res.adjunto_pieza_grafica != 0){
                $("#infopost-modal #pieza_grafica").attr("href", '/piezas-graficas/'+res.adjunto_pieza_grafica);
              }else{
                $("#infopost-modal #pieza_post_datos").hide();
              }

            });
            $('#infopost-modal').modal();

            if (event.url) {
              window.open(event.url);
              return false;
            }

          }
          /*eventResize: function(event) {
            var id = event.id;
            var fi = event.start.format();
            var ff = event.end.format();

            $.get("/calendario/updatePost/"+id+"/fecha_inicio/"+fi, function(res){
              if (res.actualizado == true) {
                alert('Post actualizado correctamente.');
              }else{
                alert('Error al actualizar el posts.');
              }
            });
          },*/
        }); 
		  });
    });

    function number_format(amount, decimals) {

      amount += ''; // por si pasan un numero en vez de un string
      amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

      decimals = decimals || 0; // por si la variable no fue fue pasada

      // si no es un numero o es igual a cero retorno el mismo cero
      if (isNaN(amount) || amount === 0) 
          return parseFloat(0).toFixed(decimals);

      // si es mayor o menor que cero retorno el valor formateado como numero
      amount = '' + amount.toFixed(decimals);

      var amount_parts = amount.split('.'),
          regexp = /(\d+)(\d{3})/;

      while (regexp.test(amount_parts[0]))
          amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

      return amount_parts.join('.');
  }

	</script>
@endsection