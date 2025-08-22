var sessionPedido = sessionStorage.getItem("anikout-arraypedido");
var arrayPedido = sessionPedido === null ? [] : JSON.parse(sessionPedido);


$(document).ready(function () {
  $("#btnOtroPedido").hide();
  $("#btnOtroPedido").click(function () {

    location.href = location.pathname;
  });

  $("#pedido-lista").on("click", ".removeaction", function () {
    var prodid = $(this).data("id");
    var medida = $(this).data("medida");
    let ele = $(`input[data-id='${prodid}'][data-medida='${medida}`);
    ele.val(0);
    removeProductFromList(prodid, medida);
    actualizarList();
  });

  $("#btnRegistrarme").click(function () {
    window.location = "register.php";
  });

  $("#btnIngresar").click(function () {
    window.location = "login.php";
  });

  $(".cant-field").on("change", function () {
    var prodid = $(this).data("id");
    var prodname = $(this).data("prod");
    var prodmedida = $(this).data("medida");
    var prodprice = Math.floor($(this).data("price"));

    var cantidad = $(this).val();

    if (cantidad == 0) {
      removeProductFromList(prodid, prodmedida);
    } else {
      var subprice = prodprice * cantidad;

      addProductToList(
        prodid,
        prodname,
        cantidad,
        prodmedida,
        prodprice,
        subprice
      );
    }
    actualizarList();
  });

  $("#notas-adicionales").on("change", function () {
    var notasAdicionales = $(this).val();

    sessionStorage.setItem("notas-adicionales", notasAdicionales);
  });


  //Check to see if the window is top if not then display button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".scrollToBottom").fadeIn();
      $(".scrollToTop").fadeIn();
    } else {
      $(".scrollToBottom").fadeOut();
      $(".scrollToTop").fadeOut();
    }
  });



  $(".scrollToTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 800);
    return false;
  });

  $(".scrollToBottom").click(function () {
    let coso = $(".wrapper-col-resumen-pedido").offset().top;  
    $("html, body").animate({ scrollTop: coso }, 800);
    return false;
  });

  $("#btnConfirmarPedido").click(function () {
    console.log(arrayPedido);
    $("#msgPedido").html("Estamos procesando tu pedido...");
    $("#modalProcesandoPedido").modal("show");

    $("#resultado-pedido").fadeIn("slow");
    $.get({
      url: "validarid.php",
      data: {},
      success: function (ret) {
        if (ret > 0) {
          if ($("#zonaenvio").val() == 0) {
            alert("Seleccione una zona de envío");
            return;
          }
          $.ajax({
            type: "POST",
            url: "enviarpedido.php",
            data: {
              pedidoArray: arrayPedido,
              nota: $(".notas-adicionales").val(),
              zonaEnvio: $("#zonaenvio").val(),
            },
            success: function (data) {
              $("#modalProcesandoPedido").modal("hide");
              $("#modalPedidoEnviadoConExito").modal("show");
              $("#msgPedido").html("Pedido enviado con exito!");
              sessionStorage.removeItem("notas-adicionales");
              sessionStorage.removeItem("anikout-arraypedido");
              arrayPedido= null;
              actualizarList();
            },
            error: function (request, status, error) {
              $("#modalProcesandoPedido").modal("hide");
              $("#modalPedidoEnviadoError").modal("show");
            },
          });
        }
      },
    });

    $("#btnToggleModalConfirmarPedido").hide();
    $("#modalConfirmarPedido").modal("hide");
    $("#btnOtroPedido").show();

  });

  $("#zonaenvio").change(function (e) {
    var optionSelected = $("option:selected", this)[0].innerText;
    console.log(optionSelected);
    var valueSelected = this.value;
    var precioEnvio = $("option:selected", this)[0].getAttribute("data-precio");
    //alert(optionSelected + valueSelected + precioEnvio);

    $("#nombre-zona-envio").text(optionSelected);
    $("#precio-envio").text(precioEnvio);
    $("#txtDelivery").val(precioEnvio);
    $("#idZonaEnvio").val(valueSelected);
    $("#btnToggleModalConfirmarPedido").prop("disabled", false);
    $("#textoSeleccionarZonaEnvio").hide();

    actualizarList();
  });

  $(".button-substract-qty").click(decrementValue);
  $(".button-add-qty").click(incrementValue);
  
  $('[data-fancybox="gallery"]').fancybox({
    loop:false,
    infobar: false,
    touch: false, // disables touch navigation
    keyboard: false, // disables keyboard navigation
    arrows: false, // hides navigation arrows
    clickSlide: "close", // closes the lightbox when the slide itself is clicked
    buttons: [
        "close"
    ],
  });


  initializateSplideSlider();
  actualizarCantidades();
  initializateAccordions();
  openAccordionForSearchSection();
  autoconfirmarPedido();
});



function actualizarList() {
  var lista = $("#pedido-lista");
  lista.html("");
  var amount = 0;
  var rowPedido = "";

  $.map(arrayPedido, function (elementOfArray, indexInArray) {
    rowPedido += "<div class='row separacion'>";
    rowPedido +=
      "<div class='col-1 text-right'><span>" + elementOfArray.cantidad + "</span></div>";
    rowPedido +=
      "<div class='col-4'><span class='item-pedido'>" +
      elementOfArray.nombre +
      "</span></div>";
    rowPedido +=
      "<div class='col-3'><span class='item-pedido'>" +
      elementOfArray.tamanio +
      "</span></div>";
    rowPedido +=
      "<div class='col-3'><span>$ " +
      elementOfArray.subtprice +
      "</span></div>";
    rowPedido +=
      "<div class='col-1'><i class='fa fa-trash trash-can removeaction' data-id='" +
      elementOfArray.productoid +
      "'  data-medida='" +
      elementOfArray.tamanio +
      "' aria-hidden='true'></i></div></div>";
    amount += elementOfArray.subtprice;
  });
  lista.append(rowPedido);
  //lista.append("<div class='col-12'>TOTAL: " + amount + "</div>");
  lista.append(
    "<div class='col-12 separacion'><span>Subtotal</span><div class='pull-right'><span>$ " +
      amount +
      "</span></div></div>"
  );
  if ($("#txtDelivery").val() === "") {
    $("#txtTotalTotal").html("$" + amount + " + envío");
    $("#btnToggleModalConfirmarPedido").prop("disabled", true);
    $("#textoSeleccionarZonaEnvio").show();
  } else {
    $("#txtTotalTotal").html(
      "$ " + (parseInt($("#txtDelivery").val()) + parseInt(amount))
    );
  }
  if (lista.html() == "") {
    lista.html("<p>Todavia no agrego ningun producto a la lista</p>");
  }
}

function actualizarCantidades() {
  $.map(arrayPedido, function (pedido, indexInArray) {
    let ele = $(
      `input[data-id='${pedido.productoid}'][data-medida='${pedido.tamanio}`
    );
    ele.val(pedido.cantidad);
    console.log(ele);
  });
  let notasAdicionales = sessionStorage.getItem("notas-adicionales");

  $("#notas-adicionales").val(notasAdicionales);

  actualizarList();
}

function addProductToList(prodid, name, cant, medida, price, subprice) {
  var added = false;

  $.map(arrayPedido, function (elementOfArray, indexInArray) {
    if (
      elementOfArray.productoid == prodid &&
      elementOfArray.tamanio == medida
    ) {
      elementOfArray.cantidad = cant;
      elementOfArray.precio = price;
      elementOfArray.subtprice = subprice;
      added = true;
    }
  });
  if (!added) {
    arrayPedido.push({
      cantidad: cant,
      productoid: prodid,
      nombre: name,
      tamanio: medida,
      precio: price,
      subtprice: subprice,
    });
  }
  sessionStorage.setItem("anikout-arraypedido", JSON.stringify(arrayPedido));
}

function removeProductFromList(prodid, medida) {
  $.each(arrayPedido, function (index, elementOfArray) {
    if (elementOfArray != undefined) {
      if (
        elementOfArray.productoid == prodid &&
        elementOfArray.tamanio == medida
      ) {
        arrayPedido.splice(index, 1);
      }
    }
  });
  sessionStorage.setItem("anikout-arraypedido", JSON.stringify(arrayPedido));
}


function initializateAccordions(){
var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      toggleAccordion(this);
    })
  }
}

function toggleAccordion(accordion){
  accordion.classList.toggle("active-accordion");
  var panel = accordion.nextElementSibling;
  togglePanel(panel);
}

function togglePanel(panel){
  if (panel.style.maxHeight) {
    panel.style.maxHeight = null;
  } else {
    //panel.style.maxHeight = panel.scrollHeight + "px";
    panel.style.maxHeight = "4000px";
  }
};

function incrementValue(e) {
  e.preventDefault();
  let inputField = $(e.target).prev();
  let currentVal = parseInt(inputField.val());

  inputField.val(currentVal ? currentVal + 1 : 1);
  inputField.trigger("change");
}

function decrementValue(e) {
  e.preventDefault();
  let inputField = $(e.target).next();
  let currentVal = parseInt(inputField.val());
  
  inputField.val(currentVal > 0 ? currentVal - 1 : 0);
  inputField.trigger("change");
}
function initializateSplideSlider(){
  var splides = document.querySelectorAll('.splide');

  splides.forEach(function (splide) {
    new Splide(splide, {
      type: 'loop',
      perPage: 2,
      perMove: 1,
      autoplay: true,
      breakpoints: {
        600: {
          perPage: 1,
        },
      },
    }).mount();
  });
}

function openAccordionForSearchSection(){

  let hash = window.location.hash;
  if (hash) {
      let accordion = document.querySelector(hash);
      if (accordion) {
          toggleAccordion(accordion)
      }
  }
}


function removeParam(key, sourceURL) {
  let rtn = sourceURL.split("?")[0],
      param,
      params_arr = [],
      queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
  if (queryString !== "") {
      params_arr = queryString.split("&");
      for (let i = params_arr.length - 1; i >= 0; i -= 1) {
          param = params_arr[i].split("=")[0];
          if (param === key) {
              params_arr.splice(i, 1);
          }
      }
      rtn = rtn + "?" + params_arr.join("&");
  }
  return rtn;
}

function getUrlParamAndRemoveIt(key){

  let urlParams = new URLSearchParams(window.location.search);
  let paramValue = urlParams.get(key);

  let url = window.location.href;
  let newUrl = removeParam(key, url);
  window.history.pushState({}, '', newUrl);

  return paramValue;
}

function autoconfirmarPedido(){
  console.log("array pedido ac", arrayPedido )

  let autoConfirmar = getUrlParamAndRemoveIt('autoConfirmar');
  
  if(arrayPedido == null || arrayPedido.length == 0 || $("#txtDelivery").val() === "") return;


  if (autoConfirmar === 'true') {
      document.querySelector('#btnConfirmarPedido').click();
  }

}