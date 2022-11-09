<?php

require_once "conexion.php";

class ModeloCategorias
{
    // REGISTRO DE CATEGORIA
    static public function mdlIngresarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (categoria) VALUES (:categoria)");
        $stmt->bindParam(":categoria", $datos, PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }


    // MOSTRAR CATEGORIAS

    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item"); //SE DEBE DE ENLAZAR PARAMETRO $item
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); //ENLAZANDO PARAMETRO
            $stmt->execute();
            return $stmt->fetch(); //RETORNANDO UN SOLO ITEM DE NUESTRA TABLA
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(); //RETORNANDO TODOS LOS VALORES DE LA TABLA
        }

        $stmt = null;
    }

     // EDITAR CATEGORIAS
     static public function mdlEditarCategoria($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");
        $stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;

     }
     // ELIMINAR USUARIO
    static public function mdlEliminarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id  = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }
}
