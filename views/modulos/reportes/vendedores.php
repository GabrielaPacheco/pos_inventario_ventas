<?php

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayVendedores = array();
$arrayListaVendedores = array();

foreach ($ventas as $key => $valueVentas) {
    foreach ($usuarios as $key => $valueUsuarios) {

        if ($valueUsuarios["id"] == $valueVentas["id_vendedor"]) {

            //Capturamos los vendedores en un array
            array_push($arrayVendedores, $valueUsuarios["nombre"]);

            //Capturamos los nombres y los valores netos en un mismo array
            $arrayListaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);
            //Sumar los netos de cada vendedor
            foreach ($arrayListaVendedores as $key => $value) {
                $sumaTotalVendedores[$key] += $value;
            }
        }
    }
}
//Evitar repetir los nombres de los vendedores
$noRepetirNombres = array_unique($arrayVendedores);

?>


<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Vendedores</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart1" style="height: 300px;">
            </div>
        </div>
    </div>
</div>
<script>
    //BAR CHART
    var bar = new Morris.Bar({
        element: 'bar-chart1',
        resize: true,
        data: [

            <?php
            foreach ($noRepetirNombres as $value) {
                echo "{ y: '" . $value . "', a: '" . $sumaTotalVendedores[$value] . "'},";
            }
            ?>
        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Ventas'],
        preUnits: '$',
        hideHover: 'auto'
    });
</script>