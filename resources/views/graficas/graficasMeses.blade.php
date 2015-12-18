@extends('layout')


@section('principal')

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


 <!--aviso de alguna accion--> 
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
{{ $errors }}
</div>
@endif



<div id="graficaLineal" style="width: 100%; height: 500px; margin: 0 auto">
</div>


<script type="text/javascript">
	var chart;
	$(document).ready(function() {

		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
				defaultSeriesType: 'line'	// Pongo que tipo de gráfica es
			},
			title: {
				text: 'Gastos Ingresos Mensuales'	// Titulo (Opcional)
			},
			subtitle: {
				text: '<?php echo 'Año '.$year; ?>'		// Subtitulo (Opcional)
			},
                        credits: {
                            enabled: false
                        },
			// Pongo los datos en el eje de las 'X'
			xAxis: {
				categories: [<?php echo $meses; ?>],
				// Pongo el título para el eje de las 'X'
				title: {
					text: 'Meses'
				},
                                labels : { y : 20, rotation: -60 }
			},
			yAxis: {
				// Pongo el título para el eje de las 'Y'
				title: {
					text: 'Euros'
				}
			},
			// Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
			tooltip: {
				enabled: true,
				formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
						this.x +': '+ this.y;
				}
			},
			// Doy opciones a la gráfica
			plotOptions: {
				line: {
					dataLabels: {
						enabled: false
					},
					enableMouseTracking: true
				}
			},
			// Doy los datos de la gráfica para dibujarlas
			series: [{
		                name: 'Gasto',
		                data: [<?php echo $gasto; ?>]
		            },
		            {
		                name: 'Ingreso',
		                data: [<?php echo $ingreso; ?>]
		            }],
		});	
	});
        
        function volver(){
            window.location = '{{ URL::asset("main") }}';
        }
</script>


<!--            <td colspan="3" align="center">
                <input type="button" class="btn btn-default" name="Volver" value="Volver" onClick="volver();" />
            </td>-->



@stop



