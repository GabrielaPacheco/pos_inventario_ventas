<?php
class ControladorVentas
{
    static public function ctrMostrarVentas($item, $valor)
    {

        $tabla = "ventas";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;
    }
}