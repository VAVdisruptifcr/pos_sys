/*=======================================
EDITAR CLIENTE
=======================================*/
$(".btnEditarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");
	
	console.log("idCliente", idCliente);
	
	var datos = new FormData();
		datos.append("idCliente", idCliente);

		$.ajax({
			url: "ajax/clientes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){

				$("#idCliente").val(respuesta["id"]);
				$("#editarCliente").val(respuesta["nombre"]);
				$("#editarDocId").val(respuesta["documento"]);
				$("#editarEmail").val(respuesta["email"]);
				$("#editarTel").val(respuesta["telefono"]);
				$("#editarDir").val(respuesta["direccion"]);
				$("#editarBirthday").val(respuesta["fecha_nacimiento"]);


			}	

		})
	})

/*=======================================
MÉTODO ELIMINAR CLIENTE
=======================================*/
$(".btnEliminarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");
	console.log("idCliente", idCliente);
	
	swal({
		title:"Seguro deseas eliminar el cliente?",
		text:"Pudes cancelar si no lo estas!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar cliente."
	}).then(function(result){
		if (result.value) {

			window.location = "index.php?ruta=clientes&idCliente="+idCliente;

		}
	})
})