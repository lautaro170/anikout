<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Clientes
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Clientes</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content"  ng-app="ui.bootstrap.demo">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info" ng-controller="ArtesanaCtrl" ng-init="getAllClients()">

    <div class="box-body">
      <div class="table-responsive">
          <label>Buscar: <input ng-model="search"></label>
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>      
            <th>Apellido</th>      
          
            <th>Lugar de Residencia</th>      
            <th>Preferencias</th>      
            
            <th>Actualizar</th>           
            <th>Borrar</th>           
          </tr>
        </thead>
        <tbody>
        
            <tr ng-repeat="cli in clis | orderBy:orderByField:reverseSort | filter: search">
              <td>{{cli.name}}</td>
              <td>{{cli.apellido}}</td>
             
              <td>{{cli.direccion}}</td>
              <td>{{cli.datos}}</td>

              <td><a href="editar_cliente.php?usuarioid={{cli.id}}">Editar</a></td>
              <td><a href="borrar_usuario.php?usuarioid={{cli.id}}">Borrar</a></td>
            </tr>
         
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_usuario.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Usuario</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->


  <?php 

  include("footer.php");
  ?>