<?php include_once("header.php"); ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Precio Viandas
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Precio Viandas</a></li>
            <li class="active">Editar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

<?php
editar_precios();

$conn = conectar();
$cdquery = "SELECT * from preciotamanio;";

$cdresult = mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: " . mysql_error());

$precio_chico = 0;
$precio_mediano = 0;
$precio_grande = 0;
$precio_premium_chico = 0;
$precio_premium_mediano = 0;
$precio_premium_grande = 0;

while ($cdrow = mysqli_fetch_array($cdresult)) {
    $tam = $cdrow["PrecioTamanioId"];
    switch ($tam) {
        case '1':
            $precio_chico = $cdrow["Precio"];
            break;
        case '2':
            $precio_mediano = $cdrow["Precio"];
            break;
        case '3':
            $precio_grande = $cdrow["Precio"];
            break;
        case '4':
            $precio_premium_chico = $cdrow["Precio"];
            break;
        case '5':
            $precio_premium_mediano = $cdrow["Precio"];
            break;
        case '6':
            $precio_premium_grande = $cdrow["Precio"];
            break;

    }

}
?>
    <div class="box box-warning col-xs-12">
        <div class="box-body">
            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  method="post" class="form-horizontal">

                <div class="form-group">
                    <label>Precio vianda chica:
                    <input class="form-control" type="number" value="<?php echo $precio_chico; ?>" name="precio_chico"
                           placeholder="Ingrese el precio viando chica..."/>
                    </label>
                </div>
                <div class="form-group">
                    <label>Precio vianda mediana:
                        <input class="form-control" type="number" value="<?php echo $precio_mediano; ?>"
                               name="precio_mediano" placeholder="Ingrese el precio vianda mediana..."/>
                    </label>
                </div>
                <div class="form-group">
                    <label>Precio vianda grande:
                        <input class="form-control" type="number" value="<?php echo $precio_grande; ?>"
                               name="precio_grande" placeholder="Ingrese el precio vianda grande..."/>
                    </label>
                </div>
                <div class="form-group">
                    <label>Precio vianda premium chica:
                        <input class="form-control" type="number" value="<?php echo $precio_premium_chico; ?>"
                               name="precio_premium_chico" placeholder="Ingrese el precio viando chica..."/>
                    </label>
                </div>
                <div class="form-group">
                    <label>Precio vianda premium mediana:
                        <input class="form-control" type="number" value="<?php echo $precio_premium_mediano; ?>"
                               name="precio_premium_mediano" placeholder="Ingrese el precio vianda mediana..."/>
                    </label>
                </div>
                <div class="form-group">
                    <label>Precio vianda premium grande:
                        <input class="form-control" type="number" value="<?php echo $precio_premium_grande; ?>" name="precio_premium_grande" placeholder="Ingrese el precio vianda grande..."/>
                    </label>
                </div>

                <input type="submit" name="submit" value="Editar Precios" class="btn btn-default"/>
            </form>
        </div><!-- /.box -->
    </div><!-- /.box -->
<?php

include("footer.php");
?>