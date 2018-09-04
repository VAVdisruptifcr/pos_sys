<?php

class ControladorVentas{

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

	/*=================================================================================
	ACTUALIZAR COMPRAS DEL CLIENTE / REDUCIR EL STOCK / AUMENTAR VENTA DE LOS PRODUCTOS
	=================================================================================*/ 
		$listaProductos = json_decode($_POST["listaProductos"], true);

		$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados , $value["cantidad"]);

				$tabla = "productos";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
				

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas = ModeloProductos::mdlActualizarProductos($tabla, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevasStock = ModeloProductos::mdlActualizarProductos($tabla, $item1b, $valor1b, $valor);
				
			}

			$tabla = "clientes";

			$item = "id";

			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

			

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;			

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla, $item1b, $valor1b, $valor);			

			/*================================================
			GUARDAR LA COMPRA
			================================================*/ 

			$tablaVentas = "ventas";

			$datos = array("id_vendedor" => $_POST["idVendedor"],
							"id_cliente" => $_POST["seleccionarCliente"],
							"codigo" => $_POST["nuevaVenta"],
							"productos" => $_POST["listaProductos"],
							"impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalVenta"],
							"metodo_pago" => $_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlCrearVenta($tablaVentas, $datos);


			if($respuesta == "ok"){

				echo '<script>	


				swal({

					type:"success",
					title:"La venta ha sido guardada correctamente",
					showConfirmButton:"Cerrar",
					}).then((result)=>{

						if(result.value){

							window.location = "ventas";

						}

					})

				</script>';

			}


		}

	}

	/*=================================================
	EDICION DE LA VENTA
	=================================================*/ 
	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

		/*=========================================
		FORMATEAR TABLA DE PRODUCTOS Y DE CLIENTES
		=========================================*/ 

		$tabla = "ventas";

		$item = "codigo";
		$valor = $_POST["editarVenta"];

		$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		$productos = json_decode($traerVenta["productos"], true);

		$totalProductosComprados = array();

		foreach ($productos as $key => $value) {

			array_push($totalProductosComprados, $value["cantidad"]);

			$tabla = "productos";

			$item = "id";
			$valor = $value["id"];

			$traerProducto = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

			$item1a = "ventas";
			$valor1a = $traerProducto["ventas"] - $value["cantidad"];

			$nuevasVentas = ModeloProductos::mdlActualizarProductos($tabla, $item1a, $valor1a, $valor);		

			$item1b = "stock";
			$valor1b = $traerProducto["stock"] - $value["cantidad"];

			$nuevasStock = ModeloProductos::mdlActualizarProductos($tabla, $item1b, $valor1b, $valor);			
			
		}

		$tabla = "clientes";

		$item = "id";

		$valor = $_POST["seleccionarCliente"];

		$traerCliente = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);


		$item1a = "compras";
		$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

		$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla, $item1a, $valor1a, $valor);

	/*=================================================================================
	ACTUALIZAR COMPRAS DEL CLIENTE / REDUCIR EL STOCK / AUMENTAR VENTA DE LOS PRODUCTOS
	=================================================================================*/ 
		$listaProductos_2 = json_decode($_POST["listaProductos"], true);

		$totalProductosComprados_2 = array();

			foreach ($listaProductos_2 as $key => $value) {

				array_push($totalProductosComprados_2 , $value["cantidad"]);

				$tabla_2 = "productos";

				$item_2 = "id";
				$valor_2 = $value["id"];

				$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
				

				$item1a_2 = "ventas";
				$valor1a_2 = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas_2 = ModeloProductos::mdlActualizarProductos($tabla, $item1a, $valor1a, $valor);

				$item1b_2 = "stock";
				$valor1b_2 = $value["stock"];

				$nuevasStock_2 = ModeloProductos::mdlActualizarProductos($tabla, $item1b, $valor1b, $valor);
				
			}

			$tabla_2 = "clientes";

			$item_2 = "id";

			$valor_2 = $_POST["seleccionarCliente"];

			$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

			

			$item1a_2 = "compras";
			$valor1a_2 = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tabla, $item1a, $valor1a, $valor);

			$item1b_2 = "ultima_compra";

			$fecha_2 = date('Y-m-d');
			$hora_2 = date('H:i:s');
			$valor1b_2 = $fecha_2.' '.$hora_2;			

			$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tabla, $item1b, $valor1b, $valor);			

			/*================================================
			GUARDAR CAMBIOS DE LA COMPRA
			================================================*/

			$datos = array("id_vendedor" => $_POST["idVendedor"],
							"id_cliente" => $_POST["seleccionarCliente"],
							"codigo" => $_POST["editarVenta"],
							"productos" => $_POST["listaProductos"],
							"impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalVenta"],
							"metodo_pago" => $_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			var_dump($respuesta);


			if($respuesta == "ok"){

				echo '<script>

				swal({

					type:"success",
					title:"Venta exitosamente editada",
					showConfirmButton:"Cerrar",
					}).then((result)=>{

						if(result.value){

							window.location = "ventas";

						}

					})

				</script>';

			}else{

				echo '<script>

				swal({

					type:"error",
					title:"Error al editar la compra",
					showConfirmButton:"Cerrar",
					}).then((result)=>{

						if(result.value){

							window.location = "ventas";

						}

					})

				</script>';

			}


		}

	}

}