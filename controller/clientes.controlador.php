<?php

class ControladorClientes{

	/*==================================
	MÉTODO CREAR CLIENTE
	==================================*/ 
	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTel"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDir"])){

			
			$tabla = "clientes";

			$datos = array("nombre" =>$_POST["nuevoCliente"],
							"documento" =>$_POST["nuevoDocId"],
							"email" =>$_POST["nuevoEmail"],
							"telefono" =>$_POST["nuevoTel"],
							"direccion" =>$_POST["nuevaDir"],
							"fecha_nacimiento" =>$_POST["nuevoBirthday"]);

			$respuesta = ModeloClientes::mdlCrearCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({
						type:"success",
						title:"Se ha guardado el cliente exitosamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "clientes";
							}
						})

					</script>';

				}

			}else{

				echo '<script>

				swal({
					title: "El campo cliente no puede quedar vacío, o contener caracteres especiales!",
					type: "error",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then((result) => {
						if(result.value){
							window.location = "clientes";
						}
					})

				</script>';

			}

		}			

	}

	/*==================================
	MÉTODO MOSTRAR CLIENTES
	==================================*/ 
	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTel"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDir"])){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDocId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTel"],
					           "direccion"=>$_POST["editarDir"],
					           "fecha_nacimiento" =>$_POST["editarBirthday"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}	

	/*==================================
	MÉTODO ELIMINAR CLIENTE
	==================================*/ 

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla = "clientes";
			$datos = $_GET["idCliente"];

			// var_dump($datos);

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);
			if($respuesta == "ok"){

				echo '<script>

					swal({
						type:"success",
						title:"Registro correctamente eliminado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false,
						}).then((result)=>{
								if(result.value){
									window.location = "clientes";
								}
							})

				</script>';

			}else{
				echo '<script>
				swal({
					text:"error al ejecutar proceso"
					})
				</script>';
			}

		}

	}

}


