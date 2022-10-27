<?php

require_once "conexion.php";

class ModeloUsuarios
{
    // MOSTRAR USUARIOS

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
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

    // REGISTRO DE USUARIO
    static public function mdlIngresarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, usuario, password, perfil, foto) VALUES (:nombre, 
        :usuario, :password, :perfil, :foto)"); //SE DEBE DE ENLAZAR PARAMETRO $item
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }
}
