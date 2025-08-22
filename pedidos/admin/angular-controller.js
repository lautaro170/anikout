angular.module('ui.bootstrap.demo', ['ui.bootstrap']);
angular.module('ui.bootstrap.demo').controller('ArtesanaCtrl', function ($scope,$http) {


//$scope.getProductsBySubId(1);
$scope.orderByField = 'name';
$scope.reverseSort = false;

$scope.getAllPedidosPorCocinero = function(){
  var pedidosPorCocinero_array = [];

  $http.get('get_pedidos_cocinero.php').success((response)=>{
    console.log('pedidosPorCocinero', response);
    //console.log('pedidosPorCocinero', response.data.items);

    $scope.pedidosPorCocinero = pedidosPorCocinero = response.data.items;

    console.log('length', pedidosPorCocinero.length);

    var slidescount = $scope.pedidosPorCocinero.length;

    for(var i=0; i<=slidescount -1; i++){
      if(pedidosPorCocinero[i] != false){
        var item = JSON.parse(pedidosPorCocinero[i]);
        item.isVianda = (item.catid == 1);
        pedidosPorCocinero_array.push(item);
      }
    };

    $scope.pedidos = pedidosPorCocinero_array;

    console.log(pedidosPorCocinero_array);
  })
}



$scope.getAllClientes = function(){

  var clients_array = [];

  $http.get('getClientes.php').success(function(response){
    console.log('clientes',response.data.items);
    
    $scope.clients = clientes = response.data.items;
    
    console.log("lengh",clientes.length);

    var slidescount = $scope.clients.length;
    for (var i = 0; i <= slidescount - 1; i++) {
      if(clientes[i] != false){
        clients_array.push(JSON.parse(clientes[i]));
      }
    };

    $scope.clis = clients_array;
    
    console.log(clients_array);
  });
  $scope.myInterval = 5000;

}

$scope.getAllProductos = function(){

  var products_array = [];

  $http.get('getProductos.php').success(function(response){
    console.log("lista",response.data.items);
    
    $scope.products = productos = response.data.items;
    
    var slidescount = $scope.products.length;
    console.log("slidesCount",slidescount);  
    for (var i = 0; i <= slidescount - 1; i++) {    
      if(productos[i] != false){
        products_array.push(JSON.parse(productos[i]));
      }
    };
    $scope.prods = products_array;
    console.log(products_array);
  });
  $scope.myInterval = 5000;

}

$scope.getAllClients = function(){
    var clients_array = [];

  $http.get('getClientes.php').success(function(response){
    console.log("lista",response.data.items);
    
    $scope.clients = clients = response.data.items;
    
    var slidescount = $scope.clients.length;
    console.log("slidesCount",slidescount);  
    for (var i = 0; i <= slidescount - 1; i++) {    
      if(clients[i] != false){
        clients_array.push(JSON.parse(clients[i]));
      }
    };
    $scope.clis = clients_array;
    console.log(clients_array);
  });
  $scope.myInterval = 5000;
}

$scope.guardarProdOrden = function(orden,productid){
  
  //alert(orden + ' - ' + productid);
  $.ajax({
      url:"actualizar_producto_orden.php",
      data: { orden: orden, pid: productid },
      type: "GET",
    }).success(function(data){       
      alert("Orden acualizado con exito!")
    });
}

$scope.getAllPedidos = function(){
  console.log("test 32113");
  var orders_array = [];

  $http.get('getPedidos.php').success(function(response){
    
    console.log('listaPedidos',response);
    console.log('listaPedidos',response.data.items);
    
    $scope.orders = pedidos = response.data.items;
    
    console.log("lengh",pedidos.length);
    var slidescount = $scope.orders.length;
    for (var i = 0; i <= slidescount - 1; i++) {
      if(pedidos[i] != false){
        orders_array.push(JSON.parse(pedidos[i]));
      };
    }

    $scope.peds = orders_array;
    console.log(orders_array);
  });
  $scope.myInterval = 5000;

}

});