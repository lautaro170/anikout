<?php 

include_once("header.php");

?>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
  <script src="plugins/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Categoria
      <small>Editar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Categoria</a></li>
      <li class="active">Editar</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <?php

    if(isset($_GET["categoriaid"]))
    {
      $conn =conectar();   
      $cdquery="SELECT * from categoria where CategoriaId = " . $_GET["categoriaid"] . ";";

      $cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error());

      $cdrow=mysqli_fetch_array($cdresult);
      $nombre = $cdrow["Nombre"];
      $aclaracion = $cdrow["Aclaracion"];
      $cid = $cdrow["CategoriaId"];
      $precio = $cdrow["Precio"];

      $imagenes_categoria = getImagenesCategoria($cid);
      $krajeeArrays = generateKrajeeInitialArrays($imagenes_categoria);
      $krajeeInitialPreview = $krajeeArrays['initialPreview'];
      $krajeeInitialPreviewConfig = $krajeeArrays['initialPreviewConfig'];

      ?>
      <div class="box box-warning col-xs-12">
        <div class="box-body">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
            <input type="hidden" name="categoriaid" value="<?php echo $cid; ?>" />
            <div class="form-group">
              <label>Nombre:</label>
              <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="version" placeholder="Ingrese el nombre..." />
            </div>        
            <div class="form-group">
              <label>Aclaraci&oacute;n:</label><br />

              <input class="form-control" type="textarea" value="<?php echo $aclaracion; ?>" name="aclaracion" id="descripcion" placeholder="Ingrese una aclracion..." />
            </div> 
            <div class="form-group">
              <label>Precio</label><br />
              <input class="form-control" type="textarea" value="<?php echo $precio; ?>" name="precio" id="descripcion" placeholder="Ingrese el precio..." />
            </div> 

            <div class="form-group">
            <label>Imagenes Categoría</label><br />
            <input id="input-id" type="file" class="file" multiple data-preview-file-type="text">
            </div> 

            
            <input  type="submit" name="submit" value="Editar Categoria" class="btn btn-default " />
          </form>

        </div><!-- /.box -->
      </div><!-- /.box -->

      <script>
        //add categoria_id as a parameter to the upload script

        $("#input-id").fileinput({
          uploadUrl: "upload-imagenes-categoria.php",
          deleteUrl: "borrar_imagenes_categoria.php",
          initialPreview: <?php echo json_encode($krajeeInitialPreview); ?>,
          initialPreviewConfig: <?php echo json_encode($krajeeInitialPreviewConfig); ?>,
          uploadExtraData: function() {
            return {
              categoria_id: <?php echo $cid; ?>
            };
          },
          allowedFileExtensions: ["jpg", "png", "gif"],
          overwriteInitial: false,
          maxFileSize: 1000,
          maxFilesNum: 10,
          //allowedFileTypes: ['image', 'video', 'flash'],
          slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
          },
          fileActionSettings:{
            showZoom: true,
            showDrag: true,
            showUpload: false,
            showDelete: true,
            showDownload: false,
            showRemove: false,
            showRotate: false,
          }
        })
        .on('filesorted', function(event, params) {
          let sortedIDs = params.stack.map( (img) => img.key);
          console.log(sortedIDs);

          $.ajax({
            url: 'ordenar_imagenes_categoria.php',
            type: 'POST',
            data: {
              sortedIDs: sortedIDs
            },
            success: function(response) {
              console.log(response);
            }
          });
        })

      </script>
      <?php 
    }
    editar_categoria();
    include("footer.php");
    ?>
