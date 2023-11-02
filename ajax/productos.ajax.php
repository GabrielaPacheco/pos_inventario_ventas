<?php
require_once "../controllers/productos.controller.php";
require_once "../models/productos.model.php";
class AjaxProductos
{
    //GENERANDO CÓDIGO A PARTIR DE ID CATEGORÍA
    public $idCategoria;
    public $traerProductos;
    public $nombreProducto;
    public function ajaxCrearCodigoProducto()
    {
        $item = "id_categoria";
        $valor = $this->idCategoria;
        $orden = "id";
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

        echo json_encode($respuesta);
    }

    // EDITAR PRODUCTO
    public $idProducto;
    public function ajaxEditarProducto()
    {
        if ($this->traerProductos == "ok") {
            //TRAER TODOS LOS PRODUCTOS PARA QUE LOS MUESTRE EN EL BOTÓN DE DISPOSITIVOS
            $item = null;
            $valor = null;
            $orden = "id";

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

            echo json_encode($respuesta);
        } else if ($this->nombreProducto != "") {
            //SE OCUPA ESTA PARTE PARA QUE NOS MUESTRE LOS PRODUCTOS CLASIFICADOS POR SU DESCRIPCIÓN
            $item = "descripcion";
            $valor = $this->nombreProducto;
            $orden = "id";

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

            echo json_encode($respuesta);
        } else {
            $item = "id";
            $valor = $this->idProducto;
            $orden = "id";

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

            echo json_encode($respuesta);
        }
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

// TRAER PRODUCTO 
if (isset($_POST["traerProductos"])) {
    $traerProductos = new AjaxProductos();
    $traerProductos->traerProductos = $_POST["traerProductos"];
    $traerProductos->ajaxEditarProducto();
}

// TRAER PRODUCTO 
if (isset($_POST["nombreProducto"])) {
    $nombreProducto = new AjaxProductos();
    $nombreProducto->nombreProducto = $_POST["nombreProducto"];
    $nombreProducto->ajaxEditarProducto();
}
