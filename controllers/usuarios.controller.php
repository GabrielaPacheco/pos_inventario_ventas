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
                // DESENCRIPTANDO CONTRASEÑA PARA INGRESAR AL SISTEMA UTILIZANDO EL HASH DEFINIDO PARA ENCRIPTAR
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios"; //TABLA USUARIOS
                $item = "usuario"; //COLUMNA USUARIO
                $valor = $_POST["ingUsuario"]; //LO QUE DIGITE EL USUARIO EN CAJA DE TEXTO USUARIO

                //EJECUTANDO ESTE TIPO DE CLASE Y SE HACE DE ESTE MÉTODO DEBIDO A 
                //QUE SE ESTA RECIBIENDO UN VALOR COMO RESPUESTA QUE SE ALMACENA
                //EN VARIABLE RESPUESTA
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if (
                    is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] &&
                    $respuesta["password"] == $encriptar
                ) {
                    // CREANDO SESION PARA INGRESAR AL SISTEMA 
                    $_SESSION["iniciarSesion"] = "ok";

                    //CREANDO VARIABLES DE SESION PARA CONOCER CUAL DE TODOS LOS USUARIOS HA INGRESADO AL SISTEMA
                    // Y MANTIENE LA SESION INICIADA
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["foto"] = $respuesta["foto"];
                    $_SESSION["perfil"] = $respuesta["perfil"];

                    // REDIRECCIONANDO A PAGINA DE INICIO AL INGRESAR AL SISTEMA
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
                // VALIDAR IMAGEN 
                $ruta = "";
                if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    // REDIMENSIONANDO EL ANCHO Y ALTO DE IMAGEN A 500x500
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // CREAMOS DIRECTORIO DONDE SE VA A GUARDAR LA FOTO DEL USUARIO
                    $directorio = "views/img/usuarios/" . $_POST["nuevoUsuario"];
                    mkdir($directorio, 0755); //PARA CREAR EL DIRECTORIO SE OCUPA MKDIR CON EL NOMBRE DE DIRECTORIO Y LOS PERMISOS

                    // DE ACUERDO AL TIPO DE IMAGEN SE APLICAN LAS FUNCIONES POR DEFECTO DE PHP
                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

                        // GUARDAMOS LA IMAGEN DEL DIRECTORIO
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                        // GUARDAMOS LA IMAGEN DEL DIRECTORIO
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                }
                $tabla = "usuarios";
                // ENCRIPTANDO CONTRASEÑA
                //OCUPANDO HASH BLOWFISH PARA ENCRIPTAR CONTRASEÑA
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["nuevoPerfil"],
                    "foto" => $ruta

                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
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
    
                            window.location= "usuarios";
    
                        }
                        
                    });
    
                    </script>';
                }
            } else {
                //EN CASO DE CARACTERES ESPECIALES APARECE LA ALERTA SWEET Y LO REDIRECCIONA A LA PAGINA USUARIOS
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

    // MOSTRAR USUARIOS

    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }
}
