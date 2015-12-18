@extends('layout')


@section('principal')
<h4 class="page-header">Movimiento Meses {{ $arResult['Ejercicio'] }}</h4>

<div class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <div class="form-group">
            <input type="text" name="ejercicio" id="ejercicio" class="form-control"
                   value="<?php if(isset($_GET['ejercicio'])){echo $_GET['ejercicio'];}else{echo $arResult['Ejercicio'];}?>" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="button" class="btn btn-default" value="Calcular" onClick="calcular(document.getElementById('ejercicio').value);" />
        </div>
    </div>
</div>

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
                "aoColumns": [
                    { "sType": 'string' },
                    { "sType": 'string' },
                    { "sType": 'string' }
                ],                    
                "bJQueryUI":true,
                "aLengthMenu": [[25, -1], [25, "Todos"]],
                "iDisplayLength": 25
            });
	});



//        function volver(){
//            window.location = '{{ URL::asset("main") }}';
//        }
        
        function calcular(ejercicio){
            //window.location='../mesesEjercicio/'+ejercicio;
            window.location='{{ URL::asset("informes/mesesEjercicio") }}/'+ejercicio;
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



<table id="ejemplo1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th><div align="right">Ingreso</div></th>
            <th><div align="right">Gasto</div></th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(is_array($arResult)){
        $ingreso=0;
        $gasto=0;
        $ingreso=$ingreso+$arResult['Enero']['Ingreso'];
        $gasto=$gasto+$arResult['Enero']['Gasto'];
        ?>
        <tr>
            <td><!--01-->Enero {{ $arResult['Ejercicio'] }}</td>
            <td class="sgsiRow" align="right">{{ number_format($arResult['Enero']['Ingreso'],2) }}</td>
            <td class="sgsiRow" align="right">{{ number_format($arResult['Enero']['Gasto'],2) }}</td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Febrero']['Ingreso'];
        $gasto=$gasto+$arResult['Febrero']['Gasto'];
        ?>
        <tr>
            <td><!--02-->Febrero <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Febrero']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Febrero']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Marzo']['Ingreso'];
        $gasto=$gasto+$arResult['Marzo']['Gasto'];
        ?>
        <tr>
            <td><!--03-->Marzo <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Marzo']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Marzo']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Abril']['Ingreso'];
        $gasto=$gasto+$arResult['Abril']['Gasto'];
        ?>
        <tr>
            <td><!--04-->Abril <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Abril']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Abril']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Mayo']['Ingreso'];
        $gasto=$gasto+$arResult['Mayo']['Gasto'];
        ?>
        <tr>
            <td><!--05-->Mayo <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Mayo']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Mayo']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Junio']['Ingreso'];
        $gasto=$gasto+$arResult['Junio']['Gasto'];
        ?>
        <tr>
            <td><!--06-->Junio <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Junio']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Junio']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Julio']['Ingreso'];
        $gasto=$gasto+$arResult['Julio']['Gasto'];
        ?>
        <tr>
            <td><!--07-->Julio <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Julio']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Julio']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Agosto']['Ingreso'];
        $gasto=$gasto+$arResult['Agosto']['Gasto'];
        ?>
        <tr>
            <td><!--08-->Agosto <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Agosto']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Agosto']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Septiembre']['Ingreso'];
        $gasto=$gasto+$arResult['Septiembre']['Gasto'];
        ?>
        <tr>
            <td><!--09-->Septiembre <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Septiembre']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Septiembre']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Octubre']['Ingreso'];
        $gasto=$gasto+$arResult['Octubre']['Gasto'];
        ?>
        <tr>
            <td><!--10-->Octubre <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Octubre']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Octubre']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Noviembre']['Ingreso'];
        $gasto=$gasto+$arResult['Noviembre']['Gasto'];
        ?>
        <tr>
            <td><!--11-->Noviembre <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Noviembre']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Noviembre']['Gasto'],2); ?></td>
        </tr>
        <?php
        $ingreso=$ingreso+$arResult['Diciembre']['Ingreso'];
        $gasto=$gasto+$arResult['Diciembre']['Gasto'];
        ?>
        <tr>
            <td><!--12-->Diciembre <?php echo $arResult['Ejercicio']; ?></td>
            <td align="right"><?php echo number_format($arResult['Diciembre']['Ingreso'],2); ?></td>
            <td align="right"><?php echo number_format($arResult['Diciembre']['Gasto'],2); ?></td>
        </tr>
        <?php
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
<!--        <tr>
            <td colspan="3" align="center">
                <input type="button" class="btn btn-default" name="Volver" value="Volver" onClick="volver();" />
            </td>
        </tr>-->
    </table>
</div>


@stop



