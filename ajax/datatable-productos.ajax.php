<?php
require_once "../controllers/productos.controller.php";
require_once "../models/productos.model.php";

require_once "../controllers/categorias.controller.php";
require_once "../models/categorias.model.php";

class TablaProductos
{
    // Ajax data source (arrays)
    // MOSTRAR TABLA PRODUCTOS
    public function mostrarTablaProductos()
    {

        $item = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        //HACIENDO RECORRIDO AL ARRAY PRODUCTOS
        // CREANDO ESTRUCTURA DE JSON
        // CONCATENANDO TODOS LOS DATOS DE LOS PRODUCTOS
        $datosJson =  '{
    "data": [';
        //CREANDO VARIABLES IMAGEN Y BOTONES PARA NO INTERRUMPIR EL ARREGLO JSON Y NO DE ERROR CUANDO SE LLAME LA FOTO

        for ($i = 0; $i < count($productos); $i++) {

            // TRAEMOS LA IMAGEN
            $imagen = "<img src='" . $productos[$i]["imagen"] . "' width='40px'>";

            // LLAMANDO LAS CATEGORIAS DE LOS PRODUCTOS
            $item = "id";
            $valor = $productos[$i]["id_categoria"];
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            // STOCK SI VA DISMINUYENDO CAMBIA EL COLOR DEL STOCK
            if ($productos[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
            } else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
            } else {
                $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
            }

            //ACCIONES DE EDICION Y ELIMINACION
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "' imagen='" . $productos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";

            //ARREGLO JSON QUE MUESTRA LOS PRODUCTOS Y LAS CATEGORIAS EN DATATABLE
            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagen . '",
                    "' . $productos[$i]["codigo"] . '",
                    "' . $productos[$i]["descripcion"] . '",
                    "' . $categorias["categoria"] . '",
                    "' . $stock . '",
                    "' . $productos[$i]["precio_compra"] . '",
                    "' . $productos[$i]["precio_venta"] . '",
                    "' . $productos[$i]["fecha"] . '",
                    "' . $botones . '"
            
                ],';
        }
        //SUSTRAER EL ULTIMO CARACTER QUE EN ESTE CASO ES LA COMA PARA QUE EL JSON NO GENERE PROBLEMAS
        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']
    }';
        echo $datosJson;
    }
}

// ACTIVAR TABLA PRODUCTOS
$activarProducto = new TablaProductos();
$activarProducto->mostrarTablaProductos();