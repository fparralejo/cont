@extends('layout')

@section('principal')
<h2 class="page-header">Buscar Trabajo</h2>
<h3 class="page-header">Listado Entrevistas Oferta: <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$oferta[0]->fecha)->format('d/m/Y') }} - {{ $oferta[0]->oferta }}</b> </h3>

<style>
    .sgsiRow:hover{
        cursor: pointer;
    }

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
        $('#entrevista').dataTable({
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
//                { "sType": 'string' },
                { "sType": 'string' },
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
	});


	function leerEntrevista(id_entrevista,id_oferta){
            $.ajax({
              data:{"id_entrevista":id_entrevista},  
              url: "../entrevistas/"+id_oferta+"/show",
              type:"get",
              success: function(data) {
                var entrevista = JSON.parse(data);
                $('#id_entrevista').val(entrevista.id_entrevista);
                $('#fecha').val(entrevista.fecha);
                $('#lugar').val(entrevista.lugar);
                $('#contacto').val(entrevista.contacto);
                $('#telefono').val(entrevista.telefono);
                $('#entrevista1').val(entrevista.entrevista);
                $('#email').val(entrevista.email);
                //cambiar nombre del titulo del formulario
                $("#tituloForm").html('Editar Entrevista');
                $("#submitir").val('OK');
              }
            });
	}

	function borrarEntrevista(id_entrevista,id_oferta){
            if (confirm("¿Desea borrar la entrevista?"))
            {
                $.ajax({
                  data:{"id_entrevista":id_entrevista},  
                  url: "../entrevistas/"+id_oferta+"/delete",
                  type:"get",
                  success: function(data) {
                        $('#accionTabla').html(data);
                        $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href="../entrevistas/"+id_oferta;
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

<table id="entrevista" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
<!--            <th>Id</th>-->
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Entrevista</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($listado as $entrevista)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerEntrevista(".$entrevista->id_entrevista.",".$oferta[0]->id_oferta.");";
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$entrevista->fecha)->format('d/m/Y') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $entrevista->lugar }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $entrevista->contacto }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $entrevista->telefono }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $entrevista->email }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $entrevista->entrevista }}</td>
            <td>
                <button type="button" onclick="borrarEntrevista({{ $entrevista->id_entrevista }},{{ $oferta[0]->id_oferta }})" class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr/>
<h3><span id="tituloForm">Nueva Entrevista</span></h3>
<br/>

<style type="text/css">
#productForm .inputGroupContainer .form-control-feedback,
#productForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="entrevistaForm" name="entrevistaForm" action="{{ URL::asset('entrevistas') }}" method="post">
    <!-- CSRF Token -->
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
            <div class="form-group">
                <label for="lugar">Lugar:</label><input type="text" class="form-control" id="lugar" name="lugar" maxlength="100">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="contacto">Contacto:</label><input type="text" class="form-control" id="contacto" name="contacto" maxlength="50">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">Teléfono:</label><input type="text" class="form-control" id="telefono" name="telefono" maxlength="20">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="entrevista1">Entrevista:</label>
                <textarea class="form-control" rows="4" name="entrevista1" id="entrevista1"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="email">Email:</label><input type="email" class="form-control" id="email" 
                                                        name="email" maxlength="100">
            </div>
        </div>
    </div>

    <br/>



    <input type="hidden" id="id_oferta" name="id_oferta" value="{{ $oferta[0]->id_oferta }}" />
    <input type="hidden" id="id_entrevista" name="id_entrevista" value="" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#entrevistaForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fecha: {
                validators: {
                    notEmpty: {
                        message: 'La fecha es requerida'
                    }
                }
            },
            lugar: {
                validators: {
                    notEmpty: {
                        message: 'El lugar es requerido'
                    }
                }
            },
//            contacto: {
//                validators: {
//                    notEmpty: {
//                        message: 'El contacto es requerida'
//                    }
//                }
//            },
            entrevista1: {
                validators: {
                    notEmpty: {
                        message: 'La descripción de la entrevista es requerida'
                    }
                }
//            },
//            email: {
//                validators: {
//                    notEmail: {
//                        message: 'El E-mail debe tener un formato válido'
//                    }
//                }
            }
        }
    });
});
</script>

@stop
