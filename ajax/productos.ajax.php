<?php
require_once "../controllers/productos.controller.php";
require_once "../models/productos.model.php";
class AjaxProductos
{
    //GENERANDO CÓDIGO A PARTIR DE ID CATEGORÍA
    public $idCategoria;
    public function ajaxCrearCodigoProducto()
    {
        $item = "id_categoria";
        $valor = $this->idCategoria;
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

    // EDITAR PRODUCTO
    public $idProducto;
    public function ajaxEditarProducto()
    {
        $item = "id";
        $valor = $this->idProducto;
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }
}
// GENERAR CÓDIGO A PARTIR DE ID CATEGORÍA 
if (isset($_POST["idCategoria"])) {
    $codigoProducto = new AjaxProductos();
    $codigoProducto->idCategoria = $_POST["idCategoria"];
    $codigoProducto->ajaxCrearCodigoProducto();
}

// EDITAR PRODUCTO 
if (isset($_POST["idProducto"])) {
    $editar = new AjaxProductos();
    $editar->idProducto = $_POST["idProducto"];
    $editar->ajaxEditarProducto();
}