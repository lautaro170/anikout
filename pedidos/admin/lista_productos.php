<?php 
 include_once("header.php");
 ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Productos
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content"  ng-app="ui.bootstrap.demo">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info" ng-controller="ArtesanaCtrl" ng-init="getAllProductos()">

    <div class="box-body">
      <div class="table-responsive">
        <label>Buscar: <input ng-model="search"></label>
        <table class="table table-striped" id="prodTable">
          <thead>
            <tr>  
              <th ng-click="orderByField='nombre'; reverseSort = !reverseSort">Nombre</th>                
              <th ng-click="orderByField='categoria'; reverseSort = !reverseSort">Categoria</th>      

              <th ng-click="orderByField='activo'; reverseSort = !reverseSort">Activo</th>      
              <th ng-click="orderByField='activo_proxima_semana'; reverseSort = !reverseSort">Activo Proxima</th>      

              <th>Orden</th>           
              <th>Actualizar</th>           
              <th>Eliminar</th>           

            </tr>
          </thead>
          <tbody>

            <tr ng-repeat="prod in prods | orderBy:orderByField:reverseSort | filter: search">
              <td>{{prod.nombre}}</td>             
              <td>{{prod.categoria}}</td>
              
              <td><input type="checkbox" data-id="{{prod.id}}" class="chk-active" ng-checked=" {{prod.activo}}" ng-true-value="1" ng-false-value="0" /></td>
              <td><input type="checkbox" data-id="{{prod.id}}" class="chk-active-proxima" ng-checked=" {{prod.activo_proxima_semana}}" ng-true-value="1" ng-false-value="0" /></td>

              <td><input type="text" data-id="{{prod.id}}" ng-model="prod.orden" /><input type="button" ng-click="guardarProdOrden(prod.orden,prod.id)" value="Guardar orden" /></td>

              <td><a href="editar_producto.php?productoid={{prod.id}}">Editar</a></td>
              <td><a href="borrar_producto.php?productoid={{prod.id}}">Borrar</a></td>
              
            </tr>

          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="crear_producto.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Producto</a>
      <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
    </div><!-- /.box-footer -->


    <?php 

    include("footer.php");
    ?>