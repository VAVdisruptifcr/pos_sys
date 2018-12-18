<?php 

require_once "../../controller/usuarios.controlador.php";
require_once "../../controller/clientes.controlador.php";
require_once "../../controller/ventas.controlador.php";

require_once "../../model/usuarios.modelo.php";
require_once "../../model/clientes.modelo.php";
require_once "../../model/ventas.modelo.php";

$reporte = new ControladorVentas();
$reporte -> ctrDescargarReporte();