$(document).ready(function(){
	$("#table-pedido").on("click",".chk-armado",function(){
		$(this).parent().parent().toggleClass("row-armado");
		var pid = $(this).data("id");
		
		$.ajax({
			url:"actualizar_pedido_estado.php",
			data: { pedidoid : pid },
			type: "GET",
		}).success(function(data){       
			alert("Pedido acualizado con exito!")
		});
	});

	$("#prodTable").on("click",".chk-active",function(){	

		var pid = $(this).data("id");

		$.ajax({
			url:"actualizar_producto_estado.php",
			data: { productoid : pid },
			type: "GET",
		}).success(function(data){       
			
			alert("Pedido enviado con exito!")
		});

	});
	$("#prodTable").on("click",".chk-active-proxima",function(){	

		var pid = $(this).data("id");

		$.ajax({
			url:"actualizar_producto_estado.php",
			data: { productoid : pid, proxima:true },
			type: "GET",
		}).success(function(data){       
			
			alert("Pedido enviado con exito!")
		});
	});
	

	$("#table-pedido").on("click","tr",function(){

		if($(this).attr("data-toggle") == "collapse"){
			$(this).addClass("artesana-color-3");
		}
		if($(this).attr("aria-expanded") == "true"){
			$(this).removeClass("artesana-color-3");
		}
	});

	$(".table-striped").on("click",".borrar-pedido",function(){
		if (confirm("El pedido sera borrado definitivamente. Esta de acuerdo?")) {
		
			$.ajax({
				url:"borrar_pedido.php",
				data: { pedidoid : $(this).data("id") },
				type: "GET",
			}).success(function(data){       

				alert("Pedido borrado con exito!")
			});
			location.reload();
		}
	});

});