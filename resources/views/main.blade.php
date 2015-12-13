@extends('layout')


@section('principal')
{{  dd($movimientos)  }}
<h3 class="page-header">Listado</h3>

<style>
    .sgsiRow:hover{
        cursor: pointer;
    }

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
        $('#ejemplo1').dataTable({
        	"responsive": true,
            "bProcessing": true,
            "sPaginationType":"full_numbers",
            "oLanguage": {
                "sLengthMenu": "Ver _MENU_ registros por pagina",
                "sZeroRecords": "No se han encontrado registros",
                "sInfo": "Ver _START_ al _END_ de _TOTAL_ Registros",
                "sInfoEmpty": "Ver 0 al 0 de 0 registros",
                "sInfoFiltered": "(filtrados _MAX_ total registros)",
                "sSearch": "Busqueda:",
                "oPaginate": { 
                    "sLast": "Última página", 
                    "sFirst": "Primera", 
                    "sNext": "Siguiente", 
                    "sPrevious": "Anterior" 
                }
            },
            "bSort":true,
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'none' }
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	} );


	function leerAsiento(Id){
        $.ajax({
          data:{"Id":Id},  
          url: '{{ URL::asset("main/show") }}',
          type:"get",
          success: function(data) {
            var asiento = JSON.parse(data);
            $('#Id').val(asiento.Id);
            $('#fecha').val(asiento.Fecha);
            $('#movimientos').val(asiento.Movimiento);
            $('#euros').val(asiento.Euros);
            $('#motivos').val(asiento.Motivo);
            $('#deudor').val(asiento.Deudor);
            //cambiar nombre del titulo del formulario
            $("#tituloForm").html('Editar Datos');
            $("#submitir").val('OK');
          }
        });
	}

	function borrarAsiento(Id){
            if (confirm("¿Desea borrar este asiento?"))
            {
                $.ajax({
                  data:{"Id":Id},  
                  url: '{{ URL::asset("main/delete") }}',
                  type:"get",
                  success: function(data) {
                        $('#accionTabla').html(data);
                        $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href="{{URL::to('main')}}";
                }, 1000);
            }
	}


	//hacer desaparecer en cartel
	$(document).ready(function() {
	    setTimeout(function() {
	        $("#accionTabla2").fadeOut(1500);
	    },3000);
	});

</script>


<!-- aviso de alguna accion -->
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
{{ $errors }}
</div>
@endif

<table id="ejemplo1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Ingreso/Gasto</th>
            <th>Motivo</th>
            <th>Euros</th>
            <th>Deudor</th>
            <th>Baja</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($mfinal as $movFinal)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerAsiento(".$movFinal->Id.");";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$movFinal->Fecha)->format('d/m/Y') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movimientos[$movFinal->Movimiento] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $motivos[$movFinal->Motivo] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movFinal->Euros }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $deudores[$movFinal->Deudor] }}</td>
            <td>
                <button type="button" onclick="borrarAsiento({{ $movFinal->Id }})" class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr/>
<h3><span id="tituloForm">Nuevos Datos</span></h3>
<br/>

<style type="text/css">
#productForm .inputGroupContainer .form-control-feedback,
#productForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="asientoForm" name="asientoForm" action="{{ URL::asset('main') }}" method="post">
     CSRF Token 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <script language="JavaScript">
                $(function() {
                        $("#fecha").datepicker({
                            closeText: 'Cerrar',
                            prevText: '&#x3c;Ant',
                            nextText: 'Sig&#x3e;',
                            currentText: 'Hoy',
                            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                            weekHeader: 'Sm',
                            format: 'dd/mm/yyyy',
                            firstDay: 1,
                            isRTL: false,
                            showMonthAfterYear: false,
                            yearSuffix: '',
                            changeMonth: true, 
                            changeYear: true 
                        });
                });
                </script>
                <label for="fecha">Fecha:</label>
                <input type="text" class="form-control" id="fecha" name="fecha"  maxlength="38">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <label for="movimientos">Ingreso/Gasto:</label>
            <select class="form-control" id="movimientos" name="movimientos">
                <option value="1">Ingreso</option>
                <option value="2">Gasto</option>
            </select>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="euros">Importe (Euros):</label><input type="text" class="form-control" id="euros" name="euros" maxlength="15">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="motivos">Motivo:</label>
	        <select class="form-control" name="motivos" id="motivos">
                    @foreach ($motivos as $motivo)
                    <option value="{{ $motivo->IdMot }}">{{ $motivo->motivo }}</option>
                    @endforeach
	        </select>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="deudor">Deudor/Pagador:</label>
	        <select class="form-control" name="deudor" id="deudor">
                    @foreach ($deudores as $deudor)
                    <option value="{{ $deudor->IdDeu }}">{{ $deudor->deudor }}</option>
                    @endforeach
	        </select>
            </div>
        </div>
    </div>
    
    
    <br/>



    <input type="hidden" id="Id" name="Id" value="" />
    <input type="hidden" id="id_usuario" name="id_usuario" value="{{ Session::get('id') }}" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#asientoForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            euros: {
                validators: {
                    notEmpty: {
                        message: 'El importe es requerido'
                    },
                    numeric: {
                        message: 'El importe tiene que ser un valor numérico'
                    }
                }
            }
        }
    });
});
</script>

@stop



