<?php

require_once "../controllers/categorias.controller.php";
require_once "../models/categorias.model.php";

class AjaxCategorias
{
    // EDITAR CATEGORIA
    public $idCategoria;
    public function ajaxEditarCategoria()
    {
        $item = "id";
        $valor = $this->idCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }

    //NO REPETIR LA CATEGORIA EN BASE DE DATOS
    public $validarCategoria;
    public function ajaxValidarCategoria()
    {
        $item = "categoria";
        $valor = $this->validarCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }
}

// EDITAR CATEGORIA 
if (isset($_POST["idCategoria"])) {
    $editar = new AjaxCategorias();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}

// VALIDAR NO REPETIR CATEGORÍA YA QUE LA CATEGORÍA ES ÚNICO
if (isset($_POST["validarCategoria"])) {
    $validarCategoria = new AjaxCategorias();
    $validarCategoria->validarCategoria = $_POST["validarCategoria"];
    $validarCategoria->ajaxValidarCategoria();
}
