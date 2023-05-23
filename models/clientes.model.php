<?php


require_once "conexion.php";

class ModeloClientes
{
    // REGISTRO DE CLIENTE
    static public function mdlIngresarCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, documento, email, telefono, direccion, fecha_nacimiento) 
        VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    // MOSTRAR CLIENTES
    static public function mdlMostrarClientes($tabla, $item, $valor)
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

}
