<?php

class ControladorProductos
{

    // MOSTRAR CATEGORIAS
    static public function ctrMostrarProductos($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrCrearProducto()
    {
        if (isset($_POST["nuevaDescripcion"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])
            ) {

                // VALIDAR IMAGEN 
                $ruta = "views/img/productos/default/anonymous.png";
                //Validando que el valor de la imagen sea un valor no vacío
                if (isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

                    // REDIMENSIONANDO EL ANCHO Y ALTO DE IMAGEN A 500x500
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // CREAMOS DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN DEL PRODUCTO
                    $directorio = "views/img/productos/" . $_POST["nuevoCodigo"];
                    mkdir($directorio, 0755); //PARA CREAR EL DIRECTORIO SE OCUPA MKDIR CON EL NOMBRE DE DIRECTORIO Y LOS PERMISOS

                    // DE ACUERDO AL TIPO DE IMAGEN SE APLICAN LAS FUNCIONES POR DEFECTO DE PHP
                    if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

                        // GUARDAMOS LA IMAGEN DEL DIRECTORIO COMO JPG
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["nuevaImagen"]["type"] == "image/png") {
                        // GUARDAMOS LA IMAGEN DEL DIRECTORIO COMO PNG
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";

                //CREANDO ARRAY PARA GUARDAR PRODUCTOS
                $datos = array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"],
                    "imagen" => $ruta

                );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL PRODUCTO SE HA AGREGADO
                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡El producto ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "productos";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA PRODUCTOS
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "productos";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }
    //EDITAR PRODUCTO
    static public function ctrEditarProducto()
    {
        if (isset($_POST["editarDescripcion"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])
            ) {
                $ruta = $_POST["imagenActual"];

                if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    $directorio = "views/img/productos/" . $_POST["editarCodigo"];

                    // PRIMERO SE PREGUNTA SI EXISTE OTRA IMAGEN EN BASE DE DATOS

                    if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "views/img/productos/default/anonymous.png") {
                        unlink($_POST["imagenActual"]); //ELIMINA EL ARCHIVO QUE ENCUENTRA EN ESA RUTA
                    } else {
                        //SI NO HAY FOTO DEBE CREAR LA CARPETA PARA RUTA Y GUARDAR LA FOTO
                        mkdir($directorio, 0755);
                    }

                    if ($_FILES["editarImagen"]["type"] == "image/jpeg") {

                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["editarImagen"]["type"] == "image/png") {
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";

                $datos = array(
                    "id_categoria" => $_POST["editarCategoria"],
                    "codigo" => $_POST["editarCodigo"],
                    "descripcion" => $_POST["editarDescripcion"],
                    "stock" => $_POST["editarStock"],
                    "precio_compra" => $_POST["editarPrecioCompra"],
                    "precio_venta" => $_POST["editarPrecioVenta"],
                    "imagen" => $ruta

                );

                $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡El producto ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "productos";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "productos";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }

    // BORRANDO EL PRODCUTO
    static public function ctrEliminarProducto()
    {
        //DE EXISTIR VARIABLES GET ENTONCES SE VERIFICA Y SE MANDA EL ID DE PRODUCTO
        if (isset($_GET["idProducto"])) {
            $tabla = "productos";
            $datos = $_GET["idProducto"];
            if ($_GET["imagen"] != "" && $_GET["imagen"] != "views/img/productos/default/anonymous.png") {
                unlink($_GET["imagen"]);
                rmdir('views/img/productos/' . $_GET["codigo"]);
            }
            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
            //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL PRODUCTO SE HA ELIMINADO
            if ($respuesta == "ok") {
                echo '<script>

                swal({

                    type: "success",
                    title: "¡El producto ha sido eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{
                    if(result.value){
                        window.location= "productos";
                    }
                });
                </script>';
            }
        }
    }
}
