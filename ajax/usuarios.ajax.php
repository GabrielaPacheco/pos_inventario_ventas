<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios
{
    // EDITAR USUARIO

    public $idUsuario;

    public function ajaxEditarUsuario()
    {
        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }

    //ACTIVAR USUARIO
    public $activarUsuario;
    public $activarId;
    public function ajaxActivarUsuario()
    {
        $tabla = "usuarios";
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {
        $item = "usuario";
        $valor = $this->validarUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
}
// EDITAR USUARIO CARGANDO A FORMULARIO DE EDITAR USUARIO LOS CAMPOS EN CAJITAS
if (isset($_POST["idUsuario"])) {
    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}
// ACTIVAR USUARIO
if (isset($_POST["activarUsuario"])) {
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}
// VALIDAR NO REPETIR USUARIO YA QUE EL USUARIO ES UNICO
if (isset($_POST["validarUsuario"])) {
    $validarUsuario = new AjaxUsuarios();
    $validarUsuario->validarUsuario = $_POST["validarUsuario"];
    $validarUsuario->ajaxValidarUsuario();
}
