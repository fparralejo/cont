@extends('layout')


@section('principal')
<h2 class="page-header">Buscar Trabajo</h2>

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


	function leerWebT(id_web){
        $.ajax({
          data:{"id_web":id_web},  
          url: '{{ URL::asset("web/show") }}',
          type:"get",
          success: function(data) {
            var webT = JSON.parse(data);
            $('#id_web').val(webT.id_web);
            $('#nombre').val(webT.nombre);
            $('#url').val(webT.url);
            $('#usuario').val(webT.usuario);
            $('#pass').val(webT.pass);
            $('#fecha').val(webT.fecha);
            //cambiar nombre del titulo del formulario
            $("#tituloForm").html('Editar Datos');
            $("#submitir").val('OK');
          }
        });
	}

	function borrarWebT(id_web){
            if (confirm("¿Desea borrar la web de trabajo?"))
            {
                $.ajax({
                  data:{"id_web":id_web},  
                  url: '{{ URL::asset("web/delete") }}',
                  type:"get",
                  success: function(data) {
                        $('#accionTabla').html(data);
                        $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href="{{URL::to('web')}}";
                }, 1000);
            }
	}

	//hacer desaparecer en cartel
	$(document).ready(function() {
	    setTimeout(function() {
	        $("#accionTabla2").fadeOut(1500);
	    },3000);
	});


//        function verPDF(pdf){
//            window.open('{{ URL::asset('pdf_cv') }}/'+pdf, '', 'scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no,location=no');
//        }
        
</script>

<h3>Web Trabajo</h3>

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
            <th>Nombre</th>
            <th>Url</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($listado as $webT)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerWebT(".$webT->id_web.");";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $webT->nombre }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $webT->url }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $webT->usuario }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $webT->pass }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$webT->fecha)->format('d/m/Y') }}</td>
            <td>
                <button type="button" onclick="borrarWebT({{ $webT->id_web }})" class="btn btn-xs btn-danger">Borrar</button>
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

<form role="form" class="form-horizontal" id="webForm" name="webForm" action="{{ URL::asset('web') }}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label><input type="text" class="form-control" id="nombre" name="nombre" maxlength="75">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <label for="url">Url:</label><input type="text" class="form-control" id="url" name="url" maxlength="200">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="usuario">Usuario:</label><input type="text" class="form-control" id="usuario" name="usuario" maxlength="75">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="pass">Password:</label><input type="text" class="form-control" id="pass" name="pass" maxlength="75">
            </div>
        </div>
        <div class="col-md-1">
        </div>
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
    </div>
    <br/>



    <input type="hidden" id="id_web" name="id_web" value="" />
    <input type="hidden" id="id_usuario" name="id_usuario" value="{{ Session::get('id') }}" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#webForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre de la web de trabajo es requerido'
                    }
                }
            },
            url: {
                validators: {
                    notEmpty: {
                        message: 'La url es requerida'
                    }
                }
            },
            usuario: {
                validators: {
                    notEmpty: {
                        message: 'El usuario es requerido'
                    }
                }
            },
            pass: {
                validators: {
                    notEmpty: {
                        message: 'El password es requerido'
                    }
                }
            }
        }
    });
});
</script>

@stop



