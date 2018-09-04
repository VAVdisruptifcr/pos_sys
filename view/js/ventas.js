/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

var table = $('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

});

/*========================================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA DE PRODUCTOS
========================================================*/
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var precio = respuesta["precio_venta"];

			/*=======================================
			EVITAR AGREGAR PRODUCTO CON STOCK EN CER0
			=======================================*/
			if(stock == 0){
				swal({
					title:"Producto Agotado",
					type:"error",
					confirmButtonText: "¡Cerrar!",
				});

				$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

				return;
			}

			$(".nuevoProducto").append(

				'<div class="row" style="padding:5px 15px;">'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+
                  
                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                      '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

                    '</div>'+

                  '</div>'+

                  '<!-- Cantidad del producto -->'+

                  '<div class="col-xs-3">'+
                    
                     '<input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

                  '</div>'+ 

                  '<!-- Precio del producto -->'+

                  '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                         
                      '<input type="text" class="form-control nuevoPrecioProducto" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" precioUnitario="'+precio+'" readonly required>'+
         
                    '</div>'+
                     
                  '</div>'+

                '</div>')

			//SUMAR TOTAL DE PRECIOS Y EL IMPUESTO 
			//EJECUCIÓN DE LA FUNCIÓN

			sumarTotalPrecios();
			agregarImpuesto();

			//AGRUPANDO LOS PRODUCTOS EN JSON

			listarProductos();

			//FORMATO AL PRECIO DE LOS PRODUCTOS JQUERYNUMBER

			$(".nuevoPrecioProducto").number(true, 2);
		}

	})

});

/*====================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
====================================================*/
$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}

	}

});

/*====================================================
QUITAR PRODUCTO DE LA VENTA Y RECUPERAR BÓTON AGREGAR
====================================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*================================================
	ALMACENAR EN LOCALSTORAGE ID DEL PRODUCTO A QUITAR
	================================================*/

	if(localStorage.getItem("quitarProducto") == null) {

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoTotalVenta").val(0);
		$("#nuevoTotalVenta").attr("total", 0);
		$("#totalVenta").val(0);

	}else{

	//SUMAR TOTAL DE PRECIOS Y EL IMPUESTO 
	//EJECUCIÓN DE LA FUNCIÓN

	sumarTotalPrecios();

	agregarImpuesto();

	//AGRUPANDO LOS PRODUCTOS EN JSON
			
	listarProductos();


	}



});

/*=================================================
AGREGANDO PRODUCTO DESDE EL BOTÓN PARA DISPOSITIVOS
=================================================*/ 
var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			
			$(".nuevoProducto").append(

				'<div class="row" style="padding:5px 15px;">'+
					'<!-- Descripción del producto -->'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+
                  
                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

                      '<select class="form-control nuevaDescripcionProducto agregarProducto" id="producto'+numProducto+'" idProducto="'+idProducto+'" name="nuevaDescripcionProducto" required>'+

                      '<option>Seleccione el producto</option>'+

                      '</select>'+

                    '</div>'+

                  '</div>'+

                  '<!-- Cantidad del producto -->'+

                  '<div class="col-xs-3 ingresoCantidad">'+
                    
                     '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

                  '</div>'+ 

                  '<!-- Precio del producto -->'+

                  '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                         
                      '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioUnitario="" readonly required>'+
         
                    '</div>'+
                     
                  '</div>'+

                '</div>');

			//AGREGAR LOS PRODUCTOS AL SELECT

			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index){

				if(item.stock != 0){

					$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

						)					

				}

			}

		//SUMAR TOTAL DE PRECIOS Y EL IMPUESTO 
		//EJECUCIÓN DE LA FUNCIÓN

		sumarTotalPrecios();
		agregarImpuesto();

		//FORMATO AL PRECIO DE LOS PRODUCTOS JQUERYNUMBER

			$(".nuevoPrecioProducto").number(true, 2);

		}


	});

});

/*==================================
SELECCIONAR PRODUCTO EN DISPOSITIVOS
===================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
	datos.append("nombreProducto", nombreProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
			$(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"]-1));
			$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
			$(nuevoPrecioProducto).attr("precioUnitario", respuesta["precio_venta"]);

			//AGRUPANDO LOS PRODUCTOS EN JSON
			
			listarProductos();

		}
	});

});

/*==========================================
MODIFICAR LA CANTIDAD
==========================================*/ 

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioUnitario");

	precio.val(precioFinal);

	var nuevoStock =  Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*===============================================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR A VALORES INICIALES
		===============================================================*/ 

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioUnitario");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
			title: "Stock Insuficiente",
			text: "Existen "+$(this).attr("stock")+" unidades solamente",
			type: "error",
			confirmButtonText: "Cerrar"
		})

	}

	//SUMAR TOTAL DE PRECIOS Y EL IMPUESTO 
	//EJECUCIÓN DE LA FUNCIÓN

	sumarTotalPrecios();
	agregarImpuesto();

	//AGRUPANDO LOS PRODUCTOS EN JSON
			
	listarProductos();

});

/*====================================
SUMAR TODOS LOS PRECIOS
====================================*/ 
function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total", sumaTotalPrecio);


}

/*=======================================
FUNCION AGREGAR IMPUESTOS
=======================================*/ 

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=======================================
DETECTANDO CUANDO CAMBIA EL IMPUESTO 
=======================================*/
$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});

/*===================================================
FORMATO AL PRECIO FINAL DE LOS PRODUCTOS JQUERYNUMBER
===================================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=====================================
SELECCIONANDO EL MÉTODO DE PAGO
=====================================*/ 

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");
		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			'<div class="col-xs-4">'+

				'<div class="input-group ">'+

				'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

				'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

				'</div>'+

			'</div>'+

			'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px; margin-left:-5px">'+

				'<div class="input-group">'+

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					'<input type="text" class="form-control" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="00000" readonly required>'+

				'</div>'+

			'</div>'
			
			);

		//agregando formato de precio
		$('#nuevoValorEfectivo').number(true, 2);
		$('#nuevoCambioEfectivo').number(true, 2);

		//EJECUTANDO FUNCION QUE LISTA METODOS DE PAGO
		listarMetodo();

	}else{

		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass('col-xs-6');

		$(this).parent().parent().parent().children('.cajasMetodoPago').html(

			'<div class="col-xs-6" style="padding-left:0px">'+
                        
                    '<div class="input-group">'+
                         
                      '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                           
                      '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                      
                    '</div>'+

                  '</div>' )


	}

})

/*=======================================
CAMBIO EN EFECTIVO
=======================================*/ 
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=======================================
CAMBIO TRANSACCIÓN
=======================================*/ 
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	//EJECUTANDO FUNCION QUE LISTA METODOS DE PAGO
	listarMetodo();

})

/*=====================================
LISTAR TODOS LOS PRODUCTOS USANDO JSON
=====================================*/ 

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto"); 


	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({"id": $(descripcion[i]).attr("idProducto"),
							  "descripcion":$(descripcion[i]).val(),
							  "cantidad":$(cantidad[i]).val(),
							  "stock":$(cantidad[i]).attr("nuevoStock"),
							  "precio":$(precio[i]).attr("precioUnitario"),
							  "total":$(precio[i]).val()})

	}

	$("#listaProductos").val(JSON.stringify(listaProductos));

}

	/*=================================================
	LISTAR MÉTODO DE PAGO
	=================================================*/ 

	function listarMetodo(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "efectivo"){

		$("#listaMetodoPago").val("efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());		

	}


}

/*=================================================
BOTÓN PARA EDITAR VENTA
=================================================*/ 
$(".btnEditarVenta").click(function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

});

/*=========================================================================================
DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PROCUCTO YA HABÍA SIDO SELECCIONADO EN LA VENTA
=========================================================================================*/ 

function quitarAgregarProducto(){

	var idProductos = $(".quitarProducto");

	var botonesTabla = $("tablaVentas tbody button.agregarProducto");

	for(var i = 0; i < idProductos.length; i++){

		var boton = $(idProductos[i].attr("idProducto"));

		for(var j = 0; j < botonesTabla.length; j++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}

		}
	}

}

/*===============================================
EJECUTAR LA FUNCION CADA VEZ QUE CARGUE LA TABLA
===============================================*/ 

$('.tablaVentas').on('draw.dt', function(){

	quitarAgregarProducto();

})