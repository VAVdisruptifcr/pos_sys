/*================================
SUBIENDO FOTO DEL USUARIO
================================*/ 
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	

	/*================================
	VALIDACIÓN FORMATO DE LA IMAGEN
	================================*/
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".nuevaFoto").val("");

		swal({
		  title: "Error al subir la imagen",
		  text: "La imagen debe ser jpg o png",
		  type: "error",
		  confirmButton: "¡Cerrar!"
		});

	}else if(imagen["size"] > 2000000 ){

		$(".nuevaFoto").val("");

		swal({
		  title: "Error al subir la imagen",
		  text: "La imagen no debe pesar más de 2MB",
		  type: "error",
		  confirmButton: "¡Cerrar!"
		});

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		});

	}

});

/*===========================
EDITAR USUARIO AJAX
===========================*/ 
$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuarios = $(this).attr("idUsuario");

	var datos = new FormData();
	datos.append("idUsuario", idUsuarios);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);

			$("#passwordActual").val(respuesta["password"]);
			$("#fotoActual").val(respuesta["foto"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}
	})

})

/*===================================
ALGORITMO ACTIVAR USUARIO
===================================*/ 
$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){

			if(window.matchMedia("(max-width:767px)").matches){

				swal({
					type: "success",
					title: "El usuario ha sido actualizado",
					confirmButtonText: "Cerrar",
				}).then((result)=>{

					if(result.value){

						window.location = "usuarios";

					}
				});

			}

		}

	})

	if(estadoUsuario == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 1);

	}else{

		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 0);		

	}

})

/*==============================
REVISAR USUARIO REPETIDO
==============================*/ 
$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			if(respuesta){

				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Ya existe este nombre de usuario!</div>');
				$("#nuevoUsuario").val("");

			}

		}

	})

})

/*===================================
ELIMINAR USUARIO
===================================*/ 
$(document).on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");

	swal({
		title: "Seguro que deseas eliminar el usuario?",
		text: "Puedes cancelar la acción si haz ingresado por error",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Eliminar usuario"
	}).then((result)=>{

		if(result.value){

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

		}

	})

})