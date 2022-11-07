<?php
class ControladorCategorias
{
    // REGISTRO DE CATEGORIA 
    static public function ctrCrearCategoria()
    {
        if (isset($_POST["nuevaCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

                $tabla = "categorias";

                $datos = $_POST["nuevaCategoria"];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE LA CATEGORIA SE HA AGREGADO
                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡La categoría ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "categorias";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA CATEGORÍAS
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "usuarios";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }

    // MOSTRAR CATEGORIAS

    static public function ctrMostrarCategorias($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

    // EDITAR USUARIO
    static public function ctrEditarCategoria()
    {
        if (isset($_POST["editarCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {

                $tabla = "categorias";

                $datos = array("categoria" => $_POST["editarCategoria"], "id" => $_POST["idCategoria"]);

                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

                //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE LA CATEGORIA SE HA EDITADO
                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡La categoría ha sido editada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "categorias";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA CATEGORÍAS
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "usuarios";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }

     // BORRANDO LA CATEGORÍA
     static public function ctrEliminarCategoria()
     {
         //DE EXISTIR VARIABLES GET ENTONCES SE VERIFICA Y SE MANDA EL ID DE USUARIO
         if (isset($_GET["idCategoria"])) {
             $tabla = "categorias";
             $datos = $_GET["idCategoria"];
             $respuesta = ModeloCategorias::mdlEliminarCategoria($tabla, $datos);
             //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL USUARIO SE HA ELIMINADO
             if ($respuesta == "ok") {
                 echo '<script>
 
                 swal({
 
                     type: "success",
                     title: "¡La categoría ha sido eliminada correctamente!",
                     showConfirmButton: true,
                     confirmButtonText: "Cerrar",
                     closeOnConfirm: false
 
                 }).then((result)=>{
                     if(result.value){
                         window.location= "categorias";
                     }
                 });
                 </script>';
             }
         }
     }
}
