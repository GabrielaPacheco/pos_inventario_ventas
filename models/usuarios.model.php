<?php

require_once "conexion.php";

class ModeloUsuarios
{
    // MOSTRAR USUARIOS

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        $stmt = (new Conexion)->conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item"); //SE DEBE DE ENLAZAR PARAMETRO $item
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); //ENLAZANDO PARAMETRO
        $stmt->execute();
        return $stmt->fetch(); //RETORNANDO UN SOLO ITEM DE NUESTRA TABLA
        
    }
}
