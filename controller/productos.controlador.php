<?php

class ControladorProductos{

	/*================================
	MÉTODO MOSTRAR PRODUCTOS
	================================*/ 

	static public function ctrMostrarProductos($item, $valor, $orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*==============================
	MÉTODO CREAR PRODUCTO
	==============================*/ 

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) && 
				preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"])&&
				preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

				$ruta = "view/img/productos/default/anonymous.png";

			   if(isset($_FILES["nuevaImagen"]["tmp_name"])){

			   	list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

			   	$nuevoAncho = 500;
			   	$nuevoAlto = 500;

			   	/*===================================================
			   	CREANDO DIRECTORIO DONDE VAMOS A ALMACENAR LA IMAGEN
			   	===================================================*/ 

			   	$directorio = "view/img/productos/".$_POST["nuevoCodigo"];

			   	mkdir($directorio, 0755);

			   	/*=====================================================================
			   	DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			   	=====================================================================*/
   				if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

   					/*==================================
   					GUARDANDO IMAGEN EN EL DIRECTORIO
   					==================================*/ 
   					$aleatorio = mt_rand(100,999);

   					$ruta = "view/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

   					$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
   					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

   					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

   					imagejpeg($destino, $ruta);

   				}

   				if($_FILES["nuevaImagen"]["type"] == "image/png"){

   					/*==================================
   					GUARDANDO IMAGEN EN EL DIRECTORIO
   					==================================*/ 
   					$aleatorio = mt_rand(100,999);

   					$ruta = "view/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

   					$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
   					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

   					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

   					imagepng($destino, $ruta);

   				}   				

			}

				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
								"codigo" => $_POST["nuevoCodigo"],
								"descripcion" => $_POST["nuevaDescripcion"],
								"stock" => $_POST["nuevoStock"],
								"precio_compra" => $_POST["nuevoPrecioCompra"],
								"precio_venta" => $_POST["nuevoPrecioVenta"],
								"imagen" => $ruta);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({
						title:"EL producto se ha ingresado correctamente",
						type: "success",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then((result) =>{
							if(result.value){
								window.location = "productos";
								}
							})

					</script>';

				}

			}else{

				echo '<script>

					swal({
						type:"error",
						title: "El producto no puede quedar con campos vacios o contener caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "cerrar"
						}).then((result)=>{
							if(result.value){

								window.location = "productos";
								
								}
							})

				</script>';

			}

		}

	}

	/*==============================
	MÉTODO EDITAR PRODUCTO
	==============================*/ 

	static public function ctrEditarProducto(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
				preg_match('/^[0-9]+$/', $_POST["editarStock"]) && 
				preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"])&&
				preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

				$ruta = $_POST["imagenActual"];

			   if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

			   	list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

			   	$nuevoAncho = 500;
			   	$nuevoAlto = 500;

			   	/*===================================================
			   	CREANDO DIRECTORIO DONDE VAMOS A ALMACENAR LA IMAGEN
			   	===================================================*/ 

			   	$directorio = "view/img/productos/".$_POST["editarCodigo"];

			   	/*====================================================
			   	PREGUNTAMOS SI EXISTE OTRA FOTO YA EN LA BASE DE DATOS
			   	====================================================*/

			   	if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "view/img/productos/default/anonymous.png") {

			   		unlink($_POST["imagenActual"]);

			   	}else{

			   		mkdir($directorio, 0755);

			   	}


   	/*=====================================================================
   	DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
   	=====================================================================*/
   				if($_FILES["editarImagen"]["type"] == "image/jpeg"){

   					/*==================================
   					GUARDANDO IMAGEN EN EL DIRECTORIO
   					==================================*/ 
   					$aleatorio = mt_rand(100,999);

   					$ruta = "view/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

   					$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
   					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

   					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

   					imagejpeg($destino, $ruta);

   				}

   				if($_FILES["editarImagen"]["type"] == "image/png"){

   					/*==================================
   					GUARDANDO IMAGEN EN EL DIRECTORIO
   					==================================*/ 
   					$aleatorio = mt_rand(100,999);

   					$ruta = "view/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

   					$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
   					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

   					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

   					imagepng($destino, $ruta);

   				}   				

			}

				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
								"codigo" => $_POST["editarCodigo"],
								"descripcion" => $_POST["editarDescripcion"],
								"stock" => $_POST["editarStock"],
								"precio_compra" => $_POST["editarPrecioCompra"],
								"precio_venta" => $_POST["editarPrecioVenta"],
								"imagen" => $ruta);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({
						title:"EL producto se ha editado correctamente",
						type: "success",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then((result) =>{
							if(result.value){
								window.location = "productos";
								}
							})

					</script>';

				}

			}else{

				echo '<script>

					swal({
						type:"error",
						title: "El producto no puede quedar con campos vacios o contener caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "cerrar"
						}).then((result)=>{
							if(result.value){

								window.location = "productos";
								
								}
							})

				</script>';

			}

		}

	}

	/*=====================================
	MÉTODO PARA ELIMINAR UN PRODUCTO
	=====================================*/ 
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla = "productos";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "view/img/productos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('view/img/productos/'.$_GET["codigo"]);

			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

				swal({
					type: "success",
					title: "El producto se eliminó correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

						})

				</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}

}