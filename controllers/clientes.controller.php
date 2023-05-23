<?php

class ControladorClientes
{
    // REGISTRO DE CLIENTE 
    static public function ctrCrearCliente()
    {
        if (isset($_POST["nuevoCliente"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"])  &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])  &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])
            ) {
                $tabla = "clientes";
                $datos = array(
                    "nombre" => $_POST["nuevoCliente"],
                    "documento" => $_POST["nuevoDocumento"],
                    "email" => $_POST["nuevoEmail"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "direccion" => $_POST["nuevaDireccion"],
                    "fecha_nacimiento" => $_POST["nuevoFechaNacimiento"]
                );

                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
                //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL USUARIO SE HA AGREGADO
                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "clientes";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA CLIENTES
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "clientes";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }

    // MOSTRAR CLIENTES
    static public function ctrMostrarClientes($item, $valor)
    {
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }

    // EDICION DE CLIENTE 
    static public function ctrEditarCliente()
    {
        if (isset($_POST["editarCliente"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"])  &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])  &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])
            ) {
                $tabla = "clientes";
                $datos = array(
                    "id" => $_POST["idCliente"],
                    "nombre" => $_POST["editarCliente"],
                    "documento" => $_POST["editarDocumentoId"],
                    "email" => $_POST["editarEmail"],
                    "telefono" => $_POST["editarTelefono"],
                    "direccion" => $_POST["editarDireccion"],
                    "fecha_nacimiento" => $_POST["editarFechaNacimiento"]
                );

                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
                //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL CLIENTE SE HA EDITADO
                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
    
                        type: "success",
                        title: "¡El cliente ha sido cambiado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
    
                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "clientes";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA CLIENTES
                echo '<script>
    
                    swal({
    
                        type: "error",
                        title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{
    
                        if(result.value){
    
                            window.location= "clientes";
    
                        }
                        
                    });
    
                    </script>';
            }
        }
    }

    // BORRANDO EL CLIENTE
    static public function ctrEliminarCliente()
    {
        //DE EXISTIR VARIABLES GET ENTONCES SE VERIFICA Y SE MANDA EL ID DE USUARIO
        if (isset($_GET["idCliente"])) {
            $tabla = "clientes";
            $datos = $_GET["idCliente"];
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);
            //EN CASO DE HACER CORRECTAMENTE LA CONSULTA APARECE LA ALERTA SWEET CONFIRMANDO QUE EL USUARIO SE HA ELIMINADO
            if ($respuesta == "ok") {
                echo '<script>

                swal({

                    type: "success",
                    title: "¡El cliente ha sido eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{
                    if(result.value){
                        window.location= "clientes";
                    }
                });
                </script>';
            }
        }
    }
}