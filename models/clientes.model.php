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
    // EDITAR CLIENTE
    static public function mdlEditarCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, documento=:documento, email=:email, 
         telefono=:telefono, direccion=:direccion, fecha_nacimiento=:fecha_nacimiento WHERE id=:id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT); //ENLAZANDO PARAMETROS
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

    // ELIMINAR CLIENTES
    static public function mdlEliminarCliente($tabla, $datos)
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

    /*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

    static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }
        $stmt = null;
    }
}
