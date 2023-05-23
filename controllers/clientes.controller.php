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
}
