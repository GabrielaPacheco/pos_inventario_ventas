<?php
require_once "../../controllers/ventas.controller.php";
require_once "../../models/ventas.model.php";
require_once "../../controllers/clientes.controller.php";
require_once "../../models/clientes.model.php";
require_once "../../controllers/usuarios.controller.php";
require_once "../../models/usuarios.model.php";

$reporte = new ControladorVentas();
$reporte->ctrDescargarReporte();