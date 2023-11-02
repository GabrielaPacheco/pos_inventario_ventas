<?php
require_once "../controllers/productos.controller.php";
require_once "../models/productos.model.php";


class TablaProductosVentas
{
    // Ajax data source (arrays)
    // MOSTRAR TABLA PRODUCTOS
    public function mostrarTablaProductosVentas()
    {

        $item = null;
        $valor = null;
        $orden="id";

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

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

            // STOCK SI VA DISMINUYENDO CAMBIA EL COLOR DEL STOCK
            if ($productos[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
            } else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
            } else {
                $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
            }

            //ACCIONES DE EDICION Y ELIMINACION
            $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='" . $productos[$i]["id"] . "'>Agregar</button></div>";

            //ARREGLO JSON QUE MUESTRA LOS PRODUCTOS EN DATATABLE DE VENTAS
            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagen . '",
                    "' . $productos[$i]["codigo"] . '",
                    "' . $productos[$i]["descripcion"] . '",
                    "' . $stock . '",
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
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas->mostrarTablaProductosVentas();