<?php

require_once "conexion.php";

class ModeloVentas
{
    static public function mdlMostrarVentas($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item
            ORDER BY fecha DESC"); //SE DEBE DE ENLAZAR PARAMETRO $item
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

}