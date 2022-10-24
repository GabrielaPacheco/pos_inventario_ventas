<?php

class ControladorUsuarios
{
    // INGRESO DE USUARIO

    static public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {
            //VALIDACIONES DE LETRAS Y NÚMEROS PERMITIDOS a-z A-Z  0-9 PARA CONTROLAR 
            //Y NO HAYA ATAQUES EN EL SISTEMA COMO SQL INJECTION
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {

                $tabla = "usuarios"; //TABLA USUARIOS
                $item = "usuario"; //COLUMNA USUARIO
                $valor = $_POST["ingUsuario"]; //LO QUE DIGITE EL USUARIO EN CAJA DE TEXTO USUARIO

                //EJECUTANDO ESTE TIPO DE CLASE Y SE HACE DE ESTE MÉTODO DEBIDO A 
                //QUE SE ESTA RECIBIENDO UN VALOR COMO RESPUESTA QUE SE ALMACENA
                //EN VARIABLE RESPUESTA
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if (
                    is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] &&
                    $respuesta["password"] == $_POST["ingPassword"]
                ) {
                    $_SESSION["iniciarSesion"] = "ok";
                    echo '<script> 
                    window.location = "inicio"; 
                    </script>';
                } else {
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    // REGISTRO DE USUARIO 
    static public function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoUsuario"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñNáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
            ) {
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET ALERT Y LO REDIRECCIONA A LA PAGINA USUARIOS
                echo '<script>

                swal({

                    type: "error",
                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
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
}