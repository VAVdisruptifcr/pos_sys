<?php

require_once "../controller/productos.controlador.php";
require_once "../model/productos.modelo.php";

require_once "../controller/categorias.controlador.php";
require_once "../model/categorias.modelo.php";

class TablaProductos{

	/*==============================
	MOSTRAR LA TABLA DE PRODUCTOS
	==============================*/ 

	public function mostrarTablaProductos(){

		$item = null;
		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductos($item,$valor);

		$datosJson = '{
					  "data": [';

					for($i=0; $i < count($productos); $i++){

					/*==============================
					TRAEMOS LA IMAGEN
					==============================*/ 

					$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

					/*==============================
					TRAEMOS LA CATEGORIA
					==============================*/ 
					$item = "id";
					$valor = $productos[$i]["idCategoria"];

					$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

					/*==============================
					STOCK
					==============================*/
					if($productos[$i]["stock"] <= 10){

						$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

					}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 19){

						$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

					}else{

						$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
						
					}

					/*=======================================
					TRAEMOS LOS BTNS DE ACCIONES
					=======================================*/

					$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."' data-toggle='modal' data-target='#modalEliminarProducto'><i class='fa fa-times'></i></button></div>";

					  	$datosJson .='[
					      "'.($i+1).'",
					      "'.$imagen.'",
					      "'.$productos[$i]["codigo"].'",
					      "'.$productos[$i]["descripcion"].'",
					      "'.$categorias["categoria"].'",
					      "'.$stock.'",
					      "'.$productos[$i]["precio_compra"].'",
					      "'.$productos[$i]["precio_venta"].'",
					      "'.$productos[$i]["fecha"].'",
					      "'.$botones.'"
					    ],';

					  }


					  $datosJson = substr($datosJson, 0, -1);

					  $datosJson .= ']

					}';

					echo $datosJson;		

	}

}

/*==============================
ACTIVAR LA TABLA DE PRODUCTOS
==============================*/ 

$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();