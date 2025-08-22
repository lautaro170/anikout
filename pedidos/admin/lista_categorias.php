<?php include_once("header.php"); ?>
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categorias
      <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Categorias</a></li>
      <li class="active">Listado</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

   <!-- TABLE: LATEST ORDERS -->
   
   <div class="box box-info">

    <div class="box-body">
      <div class="table-responsive">
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>      
            <th>Aclaracion</th>
              <th>Activo</th>
            <th>Actualizar</th>           
            <th>Borrar</th>           
          </tr>
        </thead>
        <tbody>
          <?php 
          $conn=conectar();   
          $cdquery="SELECT * from categoria;";

          $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

          while ($cdrow=mysqli_fetch_array($cdresult, MYSQLI_ASSOC)) {
            $nombre = $cdrow["Nombre"];
            $aclaracion = $cdrow["Aclaracion"];
            $isActivo = $cdrow["Activo"];
            $cid = $cdrow["CategoriaId"];
            ?>
            <tr>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $aclaracion; ?></td>
                <td>
                    <label>
                        <input type="checkbox" onChange="updateCategoriaEstado(<?php echo $cid?>)" data-id="<?php echo $cid; ?>" class="chk-active" <?php if($isActivo == 1) echo "checked"; ?> />
                    </label>
                </td>

              <td><a href="editar_categoria.php?categoriaid=<?php echo $cid; ?>">Editar</a></td>
              <td><a href="borrar_categoria.php?categoriaid=<?php echo $cid; ?>">Borrar</a></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="crear_categoria.php" class="btn btn-sm btn-info btn-flat pull-left">Nuevo Categoria</a>
    <a href="index.php" class="btn btn-sm btn-default btn-flat pull-right">Inicio</a>
  </div><!-- /.box-footer -->

    <script>
        function updateCategoriaEstado(id)
        {
            $.ajax({
                type: "POST",
                url: "actualizar_categoria_estado.php",
                data: {
                    categoriaid: id,
                }
            }).done(function( msg ) {
                console.log(msg);
            });
        }

    </script>

  <?php 

  include("footer.php");
  ?>