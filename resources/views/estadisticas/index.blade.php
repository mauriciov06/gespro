@extends('layouts.app')

@section('title', 'Estadisticas')

@section('content')
	<div class="title-content-form">
		<h2>Estadisticas de Calidad</h2>
	</div>
	
	<div class="conten-form">	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="sub-datos" style="margin-bottom: 0;">
				<div class="title-sub-datos">
					<h3>Datos de la Planeación</h3>
				</div>
				<div class="content-sub-datos" style="margin-bottom: -7px;">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
						<p>Planeacion: {!!$planeacion->nombre_planeacion!!}</p>
						<p>Fecha de inicio: 
							<?php 
								$fecha_ini = date("d/m/Y",strtotime($planeacion->start)); 
								echo $fecha_ini;
							?>
						</p>
						<p>Fecha de finalización: 
							<?php 
								$fecha_fin = date("d/m/Y",strtotime($planeacion->end)); 
								echo $fecha_fin;
							?>
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
						<p>Nº de post en la planeación: {!!$num_posts!!}</p>
						<p>Inversion de planeación aprobada: 
							<?php
								echo '$'.number_format($planeacion->inversion_inicial);
							?>
						</p>
						<p>Inversion total de posts: <?php echo '$'.number_format($inversion_fin); ?></p>
						<p>Saldo: 
							<?php  
								$saldo = abs($planeacion->inversion_inicial - $inversion_fin);
								if($saldo == 0){
									echo 'Se consumio el total de inversión, restante $'.number_format($saldo);
								}elseif($inversion_fin < $planeacion->inversion_inicial){
									echo 'Puedes agregar más post para completar la inversión aprobada, restante $'.number_format($saldo);
								}elseif($inversion_fin > $planeacion->inversion_inicial){
									echo 'Se crearon más post pagos de lo normal, excedente $'.number_format($saldo).'<br><small style="color: #dc3545;display: block;line-height: 1;margin-top: 1px;">Por favor revisa la inversión de los post puede ser un error de ingreso o la suma total de inversión de los post excede a la de la planeación.</small>';
								}
							?>
						</p>
					</div>
				</div>
			</div>
			<hr>
			<div class="sub-datos" style="margin-bottom: 0;">
				<div class="title-sub-datos">
					<h3>Indices de Calidad</h3>
				</div>
				<div class="content-sub-datos" style="margin-bottom: -7px;">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left" style="border-right: 1px solid #c6c6c5;">
						<strong style="display: block;margin-bottom: 10px;">{!!$name_user!!}</strong>
						<div class="col-md-6 float-left">
							<canvas id="myChart"></canvas>
						</div>
						<input type="hidden" id="client-response-chart" value="{!!$indice_respuesta_fase1!!}">
						<input type="hidden" id="client-restante-chart" value="{!!$indice_restante_fase1!!}">
						<div class="col-md-6 float-left">
							<canvas id="myChart2"></canvas>
						</div>
						<input type="hidden" id="client-response-chart2" value="{!!$indice_respuesta_fase2!!}">
						<input type="hidden" id="client-restante-chart2" value="{!!$indice_restante_fase2!!}">
						<div class="col-md-6" style="float: none;margin: 0 auto;">
							<canvas id="myChart3"></canvas>
						</div>
						<input type="hidden" id="client-response-chart3" value="{!!$indice_respuesta_fase3!!}">
						<input type="hidden" id="client-restante-chart3" value="{!!$indice_restante_fase3!!}">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
						<strong style="display: block;margin-bottom: 10px;">GoMind S.A.S</strong>
						<div class="col-md-6 float-left">
							<canvas id="myChart4"></canvas>
						</div>
						<div class="col-md-6 float-left">
							<canvas id="myChart5"></canvas>
						</div>
						<div class="col-md-6" style="float: none;margin: 0 auto;">
							<canvas id="myChart6"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script>

		var cli_res_chart = jQuery('#client-response-chart').val();
		var res_restan = jQuery('#client-restante-chart').val();

		var cli_res_chart2 = jQuery('#client-response-chart2').val();
		var res_restan2 = jQuery('#client-restante-chart2').val();

		var cli_res_chart3 = jQuery('#client-response-chart3').val();
		var res_restan3 = jQuery('#client-restante-chart3').val();

		var cli_res_chart4 = 100 - (cli_res_chart*200)/200;
		var res_restan4 = 100 - (res_restan*200)/200;

		var cli_res_chart5 = 100 - (cli_res_chart2*200)/200;
		var res_restan5 = 100 - (res_restan2*200)/200;

		var cli_res_chart6 = 100 - (cli_res_chart3*200)/200;
		var res_restan6 = 100 - (res_restan3*200)/200;

		if(cli_res_chart4 < 0){
			cli_res_chart4 = 0;
		}else if(cli_res_chart5 < 0){
			cli_res_chart5 = 0;
		}else if(cli_res_chart6 < 0){
			cli_res_chart6 = 0;
		}

	  var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart,
						res_restan
					],
					backgroundColor: [
						"#B71C1C",
						"#EF9A9A",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase I - Entrega de Planeación'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		var config2 = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart2,
						res_restan2
					],
					backgroundColor: [
						"#4A148C",
						"#CE93D8",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase II - Copys'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		var config3 = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart3,
						res_restan3
					],
					backgroundColor: [
						"#004D40",
						"#80CBC4",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase III - Pieza Grafica'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		//GoMind
		var config4 = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart4,
						res_restan4
					],
					backgroundColor: [
						"#B71C1C",
						"#EF9A9A",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase I - Entrega de Planeación'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		var config5 = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart5,
						res_restan5
					],
					backgroundColor: [
						"#4A148C",
						"#CE93D8",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase II - Copys'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		var config6 = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						cli_res_chart6,
						res_restan6
					],
					backgroundColor: [
						"#004D40",
						"#80CBC4",
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Indice de Respuesta',
					'Indice de Entrega'
				]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Fase III - Pieza Grafica'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

    window.onload = function () {
      var ctx = document.getElementById("myChart").getContext("2d");
      window.myLine = new Chart(ctx, config);

      var ctx2 = document.getElementById("myChart2").getContext("2d");
      window.myLine = new Chart(ctx2, config2);

      var ctx3 = document.getElementById("myChart3").getContext("2d");
      window.myLine = new Chart(ctx3, config3);

      var ctx4 = document.getElementById("myChart4").getContext("2d");
      window.myLine = new Chart(ctx4, config4);

      var ctx5 = document.getElementById("myChart5").getContext("2d");
      window.myLine = new Chart(ctx5, config5);

      var ctx6 = document.getElementById("myChart6").getContext("2d");
      window.myLine = new Chart(ctx6, config6);
    };
	</script>
@endsection

