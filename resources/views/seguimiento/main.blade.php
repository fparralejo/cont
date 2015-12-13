@extends('layout')

@section('principal')
<h2 class="page-header">Buscar Trabajo</h2>
<h3 class="page-header">Listado Seguimiento Oferta: <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$oferta[0]->fecha)->format('d/m/Y') }} - {{ $oferta[0]->oferta }}</b> </h3>

<style>
    .sgsiRow:hover{
        cursor: pointer;
    }

</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
        $('#seguimiento').dataTable({
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


	function leerSeguimiento(id_seguimiento,id_oferta){
            $.ajax({
              data:{"id_seguimiento":id_seguimiento},  
              url: "../seguimiento/"+id_oferta+"/show",
              type:"get",
              success: function(data) {
                var seguimiento = JSON.parse(data);
                $('#id_seguimiento').val(seguimiento.id_seguimiento);
                $('#fecha').val(seguimiento.fecha);
                $('#tipo').val(seguimiento.tipo);
                $('#contacto').val(seguimiento.contacto);
                $('#telefono').val(seguimiento.telefono);
                $('#seguimiento1').val(seguimiento.seguimiento);
                $('#email').val(seguimiento.email);
                //cambiar nombre del titulo del formulario
                $("#tituloForm").html('Editar Seguimiento');
                $("#submitir").val('OK');
              }
            });
	}

	function borrarSeguimiento(id_seguimiento,id_oferta){
            if (confirm("¿Desea borrar el seguimiento?"))
            {
                $.ajax({
                  data:{"id_seguimiento":id_seguimiento},  
                  url: "../seguimiento/"+id_oferta+"/delete",
                  type:"get",
                  success: function(data) {
                        $('#accionTabla').html(data);
                        $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href="../seguimiento/"+id_oferta;
                }, 1000);
            }
	}

//	function ofertaSeguimiento(id_oferta){
//            //vamos a la views de seguimiento con esta oferta
//            document.location.href="{{URL::to('seguimiento/"+id_oferta+"')}}";
//	}

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


<!-- aviso de alguna accion -->
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
{{ $errors }}
</div>
@endif

<table id="seguimiento" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
<!--            <th>Id</th>-->
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Seguimiento</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($listado as $seguimiento)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerSeguimiento(".$seguimiento->id_seguimiento.",".$oferta[0]->id_oferta.");";
    ?>
        <tr>
<!--            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->id_seguimiento }}</td>-->
            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$seguimiento->fecha)->format('d/m/Y') }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->tipo }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->contacto }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->telefono }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->email }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $seguimiento->seguimiento }}</td>
            <td>
                <button type="button" onclick="borrarSeguimiento({{ $seguimiento->id_seguimiento }},{{ $oferta[0]->id_oferta }})" class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr/>
<h3><span id="tituloForm">Nuevo Seguimiento</span></h3>
<br/>

<style type="text/css">
#productForm .inputGroupContainer .form-control-feedback,
#productForm .selectContainer .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<form role="form" class="form-horizontal" id="seguimientoForm" name="seguimientoForm" action="{{ URL::asset('seguimiento') }}" method="post">
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
            <label for="tipo">Tipo:</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value=""></option>
                <option value="llamada">Llamada</option>
                <option value="email">E-mail</option>
            </select>
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
                <label for="seguimiento1">Seguimiento:</label>
                <textarea class="form-control" rows="4" name="seguimiento1" id="seguimiento1"></textarea>
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
    <input type="hidden" id="id_seguimiento" name="id_seguimiento" value="" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#seguimientoForm').formValidation({
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
            tipo: {
                validators: {
                    notEmpty: {
                        message: 'El tipo es requerido'
                    }
                }
            },
            contacto: {
                validators: {
                    notEmpty: {
                        message: 'El contacto es requerida'
                    }
                }
            },
            seguimiento1: {
                validators: {
                    notEmpty: {
                        message: 'La descripción del seguimiento es requerida'
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
