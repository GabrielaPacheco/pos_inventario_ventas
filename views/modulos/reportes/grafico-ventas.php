<?php
//Se coloco error reporting para que no saltara el error del array ventas para sumar las ventas de fechas del mismo dia
error_reporting(0);
if (isset($_GET["fechaInicial"])) {
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
} else {
    $fechaInicial = null;
    $fechaFinal = null;
}
$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {
    //Capturamos el año y mes de las ventas.
    $fecha = substr($value["fecha"], 0, 7);

    //Guardamos en un arreglo las fechas.
    array_push($arrayFechas, $fecha);

    $arrayVentas = array($fecha => $value["total"]);

    //Sumar las ventas que ocurrieron el mismo mes.
    foreach ($arrayVentas as $key => $value) {
        $sumaPagosMes[$key] += $value;
    }
}
//Se crea este array unique para que el array fechas y array ventas tengan los mismos indices, no hayan conflictos.
$noRepetirFechas = array_unique($arrayFechas);

?>
<!--=============================================
 GRAFICO DE VENTAS
  =============================================-->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Gráfico de Ventas</h3>
    </div>
    <div class="box-body border-radius-none nuevoGraficoVentas">
        <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
    </div>
</div>

<script>
    var line = new Morris.Line({
        element: 'line-chart-ventas',
        resize: true,
        data: [
            <?php
            if ($noRepetirFechas != null) {
                foreach ($noRepetirFechas as $key) {
                    echo "{y: '" . $key . "', ventas: " . $sumaPagosMes[$key] . " },";
                }
                echo "{y: '" . $key . "',ventas: " . $sumaPagosMes[$key] . " }";
            } else {
                "{y: '0',ventas: '0' }";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['ventas'],
        labels: ['ventas'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: '#fff',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor: '#efefef',
        gridTextFamily: 'Open Sans',
        preUnits: '$',
        gridTextSize: 10
    });
</script>