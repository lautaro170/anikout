$(document).ready(function(){
  var arrayPedido = [];

  $("#btnOtroPedido").hide();
  $("#btnOtroPedido").click(function(){
    location.reload();
  });

  $("#pedido-lista").on("click",".removeaction",function(){
    var prodid = $(this).data("id");
    var medida = $(this).data("medida");
    removeProductFromList(prodid,medida);
    actualizarList();
  });

  $("#btnRegistrarme").click(function(){
    window.location = "register.php";
  });

  $("#btnIngresar").click(function(){
    window.location = "login.php";
  });

  $(".cant-field").on("change",function(){
    var prodid = $(this).data("id");
    var prodname = $(this).data("prod");
    var prodmedida = $(this).data("medida");
    var prodprice = Math.floor($(this).data("price"));
    
    var cantidad = $(this).val();
    var subprice = prodprice * cantidad;
    
    addProductToList(prodid,prodname,cantidad,prodmedida,prodprice,subprice);
    actualizarList();
  });

  function actualizarList(){
   var lista = $("#pedido-lista");
   lista.html("");
   var amount = 0;

   $.map(arrayPedido, function(elementOfArray, indexInArray) {
    amount += elementOfArray.subtprice;
    //lista.append("<div class='col-4'>" + elementOfArray.cantidad + "</div><div class='col-5'>" + elementOfArray.nombre + "</div><div class='col-2'>" + elementOfArray.tamanio + "</div><div class='col-1'>$"+ elementOfArray.subtprice + "</div><div class='col-1 removeaction' data-id='"+ elementOfArray.productoid + "'  data-medida='"+ elementOfArray.tamanio + "'>X</div>");
    
    lista.append("<div class='row separacion'>");
    lista.append("<div class='col-1'><span>" + elementOfArray.cantidad + "</span></div>");
    lista.append("<div class='col-4'><span class='blue-text item-pedido'>" + elementOfArray.nombre + "</span></div>");
    lista.append("<div class='col-3'><span class='item-pedido'>" + elementOfArray.tamanio + "</span></div>");
    lista.append("<div class='col-3'><span>$"+ elementOfArray.subtprice + "</span></div>");
    lista.append("<div class='col-1'><i class='fa fa-trash trash-can removeaction' data-id='"+ elementOfArray.productoid + "'  data-medida='"+ elementOfArray.tamanio + "' aria-hidden='true'></i></div></div>");
  });
   //lista.append("<div class='col-12'>TOTAL: " + amount + "</div>");
   lista.append("<div class='col-12 separacion'><span>Total</span><div class='pull-right'><span>$" + amount + "</span></div></div>");

   if(lista.html() == ""){
    lista.html("<p>Todavia no agrego ningun producto a la lista</p>");
  }
}

function addProductToList(prodid,name,cant,medida,price,subprice){
  var added= false;


  $.map(arrayPedido, function(elementOfArray, indexInArray) {
   if (elementOfArray.productoid == prodid && elementOfArray.tamanio == medida) {
     elementOfArray.cantidad = cant;
     elementOfArray.precio = price;
     elementOfArray.subtprice = subprice;
     added = true;
   }
 });
  if (!added) {
    arrayPedido.push({cantidad: cant, productoid: prodid,nombre: name, tamanio: medida, precio: price, subtprice: subprice})
  }

  if(arrayPedido.length > 6){
    $(".wrapper-col-resumen-pedido").css("position","absolute");
  }
  else{
    $(".wrapper-col-resumen-pedido").css("position","fixed");
  }
}

function removeProductFromList(prodid,medida){

  $.each( arrayPedido, function( index, elementOfArray ){
    if(elementOfArray != undefined)
    {
     if (elementOfArray.productoid == prodid && elementOfArray.tamanio == medida) {

       arrayPedido.splice(index, 1);
     }
   }
 });
  
}
function validDate(){
  var d = new Date();
  var h = d.getHours();
  var weekday = new Array(7);
  weekday[0] =  "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";

  var n = weekday[d.getDay()];
  var ret = false;
  if(n == "Thursday" || n == "Friday" || n == "Saturday"){
    if(n == "Thursday" && h >= 10){
      ret = true;
    }
    else if(n == "Friday"){
      ret = true;
    }
    else if(n == "Saturday" && h <= 13){
      ret = true;
    }
  }
  return ret;
}

if(true)
//if(validDate())
{
  $("#leyenda").hide();
  $("#menupedido").show();
}
else{
  $("#leyenda").show();
  $("#menupedido").hide();
}


$("#btnConfirmarPedido").click(function(){
 console.log(arrayPedido);
  $.get({
   url: "enviarpedido.php",
   data: {  pedidoArray : arrayPedido, 
            nota: $(".notas-adicionales").val()
          },
   success: function(data) {
    console.log(data);
    alert("Pedido enviado con exito!");
  }
});

  $("#btnConfirmarPedido").hide();
  $("#btnOtroPedido").show();

  console.log(arrayPedido);

});

});	