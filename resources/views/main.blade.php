@extends('layout')


@section('principal')
<h4 class="page-header">Listado</h4>

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
            "aaSorting": [[ 0, "desc" ]],
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
            //var asiento = data;
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

        function existeMotivo(objeto){
            $.ajax({
              data:{"motivo":objeto.value},  
              url: 'main/existeMotivo',
              type:"get",
              success: function(data) {
                if(data === 'NO'){
                    objeto.value = '';
                }
              }
            });
        }

        function existeDeudor(objeto){
            $.ajax({
              data:{"deudor":objeto.value},  
              url: 'main/existeDeudor',
              type:"get",
              success: function(data) {
                if(data === 'NO'){
                    objeto.value = '';
                }
              }
            });
        }

        
        

	//hacer desaparecer en cartel
	$(document).ready(function() {
            
            
	    setTimeout(function() {
	        $("#accionTabla2").fadeOut(1500);
	    },3000);

            //autocomplete de Motivos
            $("#motivos").autocomplete({
                source: 'main/motivosListado'
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                var txt=item.value;
                var inner_html = "<a><font color='Teal'>"+txt+"</font></a>";
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
            };
            
            //autocomplete de Deudores
            $("#deudor").autocomplete({
                source: 'main/deudorListado'
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                var txt=item.value;
                var inner_html = "<a><font color='Teal'>"+txt+"</font></a>";
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
            };
            
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
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($mfinal as $movFinal)
    <?php
    //carga los datos en el formulario para editarlos
    $url="javascript:leerAsiento('".$movFinal->Id."');";
    $fecha = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$movFinal->Fecha)->format('d/m/Y');
    $fechaTxt = explode('/',$fecha);
    $fechaTxt = $fechaTxt[2].$fechaTxt[1].$fechaTxt[0];
    ?>
        <tr>
            <td class="sgsiRow" onClick="{{ $url }}"><!-- {{ $fechaTxt }} --> {{ $fecha }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $movimientos[$movFinal->Movimiento] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">{{ $motivos[$movFinal->Motivo] }}</td>
            <td class="sgsiRow" onClick="{{ $url }}">
                <div align="right">
                    {{ $movFinal->Euros }}
                </div>
            </td>
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
     <!--CSRF Token--> 
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
                <input type="text" class="form-control" id="motivos" name="motivos" onblur="existeMotivo(this);">
            </div>
        </div>
        <div class="col-md-1">
                <label for="">&nbsp;</label>
                <button class="btn btn-primary" data-toggle="modal" data-target="#formMotivo">
                    Nuevo
                </button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="deudor">Deudor:</label>
                <input type="text" class="form-control" id="deudor" name="deudor" onblur="existeDeudor(this);">
            </div>
        </div>
        <div class="col-md-1">
                <label for="">&nbsp;</label>
                <button class="btn btn-primary" data-toggle="modal" data-target="#formDeudor">
                    Nuevo
                </button>
        </div>
    </div>
    
    <br/>



    <input type="hidden" id="Id" name="Id" value="" />
    <input type="submit" id="submitir" class="btn btn-default" value="Nuevo"/>
</form>


<!-- Modal Motivos -->
<div class="modal fade" id="formMotivo" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Motivos
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" id="motivoForm" name="motivoForm" role="form" action="{{ URL::asset('main/nuevoMotivo') }}" method="post">
                    <!--CSRF Token--> 
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="motivo">Nuevo Motivo</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" 
                        id="motivo" name="motivo" placeholder="Nuevo Motivo"/>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">OK</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>


 <!--Modal Deudores--> 
<div class="modal fade" id="formDeudor" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Deudores
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" id="deudorForm" name="deudorForm" role="form" action="{{ URL::asset('main/nuevoDeudor') }}" method="post">
                    <!--CSRF Token--> 
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="deudor">Nuevo Deudor</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" 
                        id="motivo" name="deudor" placeholder="Nuevo Deudor"/>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">OK</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!--validaciones-->
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
            },
            motivos: {
                validators: {
                    notEmpty: {
                        message: 'El motivo es requerido'
                    }
                }
            },
            deudor: {
                validators: {
                    notEmpty: {
                        message: 'El deudor es requerido'
                    }
                }
            }
        }
    });
    

    $('#motivoForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            motivo: {
                validators: {
                    notEmpty: {
                        message: 'El motivo es requerido'
                    }
                }
            }
        }
    });


    $('#deudorForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            deudor: {
                validators: {
                    notEmpty: {
                        message: 'El deudor es requerido'
                    }
                }
            }
        }
    });


});
</script>


@stop



