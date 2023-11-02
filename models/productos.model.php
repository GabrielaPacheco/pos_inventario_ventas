<?php

require_once "conexion.php";
class ModeloProductos
{
    // MOSTRAR PRODUCTOS

    static public function mdlMostrarProductos($tabla, $item, $valor, $orden)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden DESC"); //SE DEBE DE ENLAZAR PARAMETRO $item
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); //ENLAZANDO PARAMETRO
            $stmt->execute();
            return $stmt->fetch(); //RETORNANDO UN SOLO ITEM DE NUESTRA TABLA
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");
            $stmt->execute();
            return $stmt->fetchAll(); //RETORNANDO TODOS LOS VALORES DE LA TABLA
        }

        $stmt = null;
    }

    // REGISTRO DE PRODUCTO
    static public function mdlIngresarProducto($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta) 
        VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    // EDITAR PRODUCTO
    static public function mdlEditarProducto($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion=:descripcion, 
        imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR); //ENLAZANDO PARAMETROS
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    // ELIMINAR PRODUCTOS
    static public function mdlEliminarProducto($tabla, $datos)
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
	ACTUALIZAR PRODUCTO
	=============================================*/

    static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt = null;
    }
    
    /*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/
    static public function mdlMostrarSumaVentas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }
}
