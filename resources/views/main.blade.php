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

//	function cambioCriterio(objeto,CriConf2){
//		objeto.value = CriConf2.value;
//
//	}

	function leerAsiento(id_oferta){
        $.ajax({
          data:{"id_oferta":id_oferta},  
          url: '{{ URL::asset("ofertas/show") }}',
          type:"get",
          success: function(data) {
            var oferta = JSON.parse(data);
            $('#id_oferta').val(oferta.id_oferta);
            $('#oferta').val(oferta.oferta);
            $('#descripcion').val(oferta.descripcion);
            $('#empresa').val(oferta.empresa);
            $('#telefono').val(oferta.telefono);
            $('#email').val(oferta.email);
            $("#url").val(oferta.url);
            $('#webtrabajo').val(oferta.webtrabajo);
            $("#tipo_contrato").val(oferta.tipo_contrato);
            $("#duracion").val(oferta.duracion);
            $("#jornada").val(oferta.jornada);
            $("#salario").val(oferta.salario);
            $("#fecha").val(oferta.fecha);
            $("#cv_pdf").val(oferta.cv_pdf);
            //cambiar nombre del titulo del formulario
            $("#tituloForm").html('Editar Datos');
            $("#submitir").val('OK');
          }
        });
	}

	function borrarOferta(id_oferta){
            if (confirm("¿Desea borrar la oferta?"))
            {
                $.ajax({
                  data:{"id_oferta":id_oferta},  
                  url: '{{ URL::asset("ofertas/delete") }}',
                  type:"get",
                  success: function(data) {
                        $('#accionTabla').html(data);
                        $('#accionTabla').show();
                  }
                });
                setTimeout(function ()
                {
                    document.location.href="{{URL::to('ofertas')}}";
                }, 1000);
            }
	}

	function ofertaSeguimiento(id_oferta){
            //vamos a la views de seguimiento con esta oferta
            document.location.href="{{URL::to('seguimiento')}}/"+id_oferta;
	}

	function ofertaEntrevistas(id_oferta){
            //vamos a la views de ofertaEntrevistas con esta oferta
            document.location.href="{{URL::to('entrevistas')}}/"+id_oferta;
	}

	//hacer desaparecer en cartel
	$(document).ready(function() {
	    setTimeout(function() {
	        $("#accionTabla2").fadeOut(1500);
	    },3000);
	});


        function verPDF(pdf){
            window.open('{{ URL::asset('pdf_cv') }}/'+pdf, '', 'scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no,location=no');
        }
        
</script>

<h3>Ofertas</h3>

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
//    $nombreWebT = '';
//    foreach ($listWebT as $webT) {
//        if($webT->id_web === $oferta->webtrabajo){
//            $nombreWebT = $webT->nombre;
//        }
//    }
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movFinal->Fecha }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movimientos[$movFinal->Movimiento] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $motivos[$movFinal->Motivo] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movFinal->Euros }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $deudores[$movFinal->Deudor] }}</td>
<!--            <td class="sgsiRow" onClick="{{ $url }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$oferta->fecha)->format('d/m/Y') }}</td>-->
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

<form role="form" class="form-horizontal" id="productForm" name="productForm" action="{{ URL::asset('main') }}" method="post">
     CSRF Token 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="oferta">Oferta:</label><input type="text" class="form-control" id="oferta" name="oferta" maxlength="100">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" rows="4" name="descripcion" id="descripcion"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="empresa">Empresa:</label><input type="text" class="form-control" id="empresa" name="empresa" maxlength="75">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="telefono">Teléfono:</label><input type="text" class="form-control" id="telefono" name="telefono" maxlength="20">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="email">Email:</label><input type="email" class="form-control" id="email" name="email" maxlength="100">
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
                <label for="webtrabajo">Web Trabajo:</label>
	        <select class="form-control" name="webtrabajo" id="webtrabajo">
                    <option value=""></option>
                    @foreach ($listWebT as $webT)
                    <option value="{{ $webT->id_web }}">{{ $webT->nombre }}</option>
                    @endforeach
	        </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="tipo_contrato">Tipo Contrato:</label><input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" maxlength="30">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="duracion">Duración:</label><input type="text" class="form-control" id="duracion" name="duracion" maxlength="25">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="jornada">Jornada:</label><input type="text" class="form-control" id="jornada" name="jornada" maxlength="25">
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="salario">Salario:</label><input type="text" class="form-control" id="salario" name="salario" maxlength="20">
            </div>
        </div>
    </div>

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
            <label for="cv_pdf">CV PDF:</label>
            <select class="form-control" id="cv_pdf" name="cv_pdf">
                <option value=""></option>
                <option value="CV01.pdf">CV01.pdf</option>
            </select>
        </div>
    </div>
    <br/>



    <input type="hidden" id="id_oferta" name="id_oferta" value="" />
    <input type="hidden" id="id_usuario" name="id_usuario" value="{{ Session::get('id') }}" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>

<script>
$(document).ready(function() {
    $('#productForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
//            id_oferta: {
//                validators: {
//                    notEmpty: {
//                        message: 'El Id Oferta es requerido'
//                    },
//                    numeric: {
//                        message: 'El Id Oferta tiene que ser un valor numérico'
//                    }
//                }
//            },
            oferta: {
                validators: {
                    notEmpty: {
                        message: 'La Oferta de trabajo es requerida'
                    }
                }
            },
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'La descripción de trabajo es requerida'
                    }
                }
            },
            empresa: {
                validators: {
                    notEmpty: {
                        message: 'La empresa de trabajo es requerida'
                    }
                }
            }
        }
    });
});
</script>

@stop



