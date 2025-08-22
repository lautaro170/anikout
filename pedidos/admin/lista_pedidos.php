<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pedidos
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Pedido</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" ng-app="ui.bootstrap.demo">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info" ng-controller="ArtesanaCtrl" ng-init="getAllPedidos()">

    <div class="box-body">
      <div class="table-responsive">
        <label>Buscar: <input ng-model="search"></label>
        <table class="table table-striped">
          <thead>
            <tr>
              <th ng-click="orderByField='name'; reverseSort = !reverseSort">Usuario</th>      
              <th ng-click="orderByField='date'; reverseSort = !reverseSort">Fecha</th>      
              <th ng-click="orderByField='cantidad'; reverseSort = !reverseSort">Cantidad Productos</th>

              <th>Armado</th>      
              <th>Borrar</th>      
            </tr>
          </thead>
          <tbody>
              <tr ng-repeat="ped in peds track by $index | orderBy:orderByField:reverseSort| filter: search">
                <td>{{ped.name}}</td>             
                <td>{{ped.date}}</td>
                <td>{{ped.cantidad}}</td>
                <td>{{ped.ready}}</td>
                <td><a class="borrar-pedido" data-id="{{ped.id}}" href="#">Borrar</a></td>
              </tr>             
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="crear_pedido.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Pedido</a>
      <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
    </div><!-- /.box-footer -->


    <?php 

    include("footer.php");
    ?>