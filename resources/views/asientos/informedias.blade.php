@extends('layout')


@section('principal')
<h4 class="page-header">Informe</h4>

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
                    "sLast": ">>", 
                    "sFirst": "<<", 
                    "sNext": "<", 
                    "sPrevious": ">" 
                }
            },
            "bSort":true,
            //"aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' },
                { "sType": 'string' }
            ],                    
            "bJQueryUI":true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
        });
	} );



        function volver(){
            window.location = '{{ URL::asset("main") }}';
        }

        
</script>


 <!--aviso de alguna accion--> 
<div class="alert alert-success" role="alert" id="accionTabla" style="display: none; ">
</div>

@if (Session::has('errors'))
<div class="alert alert-success" id="accionTabla2" role="alert" style="display: block; ">
{{ $errors }}
</div>
@endif

<?php
$fechaDesde=date('d/m/Y',mktime(0,0,0,date('m'),date('d')-$dias,date('Y')));
$fechaHasta=date('d/m/Y');
?>

<h4>Desde {{ $fechaDesde }} hasta {{ $fechaHasta }}</h4>
<table id="ejemplo1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Motivo</th>
            <th>Ingreso</th>
            <th>Gasto</th>
            <th>Deudor</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(is_array($arResult)){
        $ingreso=0;
        $gasto=0;
        for ($i = 0; $i < count($arResult); $i++) {
            $ingreso=$ingreso+$arResult[$i]['Ingreso'];
            $gasto=$gasto+$arResult[$i]['Gasto'];
    
        ?>
        <tr>
            <td class="sgsiRow" onClick="">{{ $arResult[$i]['motivo'] }}</td>
            <td class="sgsiRow" onClick="">
                <div align="right">
                    {{ number_format($arResult[$i]['Ingreso'],2) }}
                </div>
            </td>
            <td class="sgsiRow" onClick="">
                <div align="right">
                    {{ number_format($arResult[$i]['Gasto'],2) }}
                </div>
            </td>
            <td class="sgsiRow" onClick="">
                <div align="left">
                    {{ $arResult[$i]['deudor'] }}
                </div>
            </td>
        </tr>
        <?php
        }
    }
    ?>    
    </tbody>
</table>


<div align="center">
    <table class="table table-striped table-bordered table-hover" style="width: 40%;">
        <tr style="background-color: #81a8cb;">
            <th><div align="center">Ingreso</div></th>
            <th><div align="center">Gasto</div></th>
            <th><div align="center">Saldo</div></th>
        </tr>
        <tr style="background-color: #CDF2E6;">
            <td class="sgsiRow" align="center">{{ number_format($ingreso,2) }}</td>
            <td class="sgsiRow" align="center">{{ number_format($gasto,2) }}</td>
            <td class="sgsiRow" align="center">{{ number_format($ingreso-$gasto,2) }}</td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <input type="button" class="btn btn-default" name="Volver" value="Volver" onClick="volver();" />
            </td>
        </tr>
    </table>
</div>


@stop



