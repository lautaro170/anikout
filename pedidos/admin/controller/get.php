<?php

///////////////////////////INICIO METODOS GET LISTADO////////////////////////////////////



function getAllClientes(){
	$conn = conectar();   
	$sql="SELECT * FROM usuario where Permiso = 'usuario' order by Nombre;";
	$resultado=mysqli_query($conn,$sql);	
	
	return $resultado;
}


function getAllProductos(){
	$conn = conectar();   
	$cdquery="SELECT p.productoid, p.imagen, p.nombre as prod, c.nombre as cat, p.activo, p.activo_proxima_semana, p.orden from producto p inner join categoria c on p.categoriaid = c.CategoriaId order by p.activo, p.activo_proxima_semana, c.CategoriaId;";
	$cdresult=mysqli_query($conn,$cdquery);
	return $cdresult;
}

function getAllPedidos(){
	$conn = conectar();

    $cdquery="SELECT p.pedidoid,u.Nombre, u.Apellido, p.fecha,p.armado, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, ANY_VALUE(pr.categoriaid) AS categoriaid   FROM pedido p 
	inner join usuario u on p.usuarioid = u.UsuarioId
	inner join productopedido pp on pp.pedidoid = p.pedidoid
	inner join producto pr on pp.productoid = pr.productoid
	group by p.pedidoid order by fecha desc;";

	$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
	return $cdresult;
}

function getPedidosUltimasTresSemanas(){
	$conn = conectar();
	$cdquery="SELECT p.pedidoid,u.Nombre, u.Apellido, p.fecha,p.armado, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, ANY_VALUE(pr.categoriaid) AS categoriaid   FROM pedido p 
	inner join usuario u on p.usuarioid = u.UsuarioId
	inner join productopedido pp on pp.pedidoid = p.pedidoid
	inner join producto pr on pp.productoid = pr.productoid
	where p.fecha > DATE_SUB(NOW(), INTERVAL 28 DAY)
	group by p.pedidoid, p.fecha_entrega order by p.fecha_entrega desc;";

	$cdresult=mysqli_query($conn,$cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
	return $cdresult;
}

function getPedidosPorCocinero(){
	$today = date("Y-m-d");
	$conn = conectar(); 
	//cambio
	$sql = "SELECT pr.productoid, pr.nombre, u.Nombre as cook, u.UsuarioId as cookid, p.fecha as fecha, pr.categoriaid as catid FROM pedido p 
	inner join productopedido pp 
	on p.pedidoid = pp.pedidoid
	inner join producto pr
	on pp.productoid = pr.productoid
	inner join usuario u 
	on pr.cocineroid = u.UsuarioId and u.Permiso = 'cocinero'";
	//WHERE p.fecha BETWEEN '" . getPedidoStartDate($today) . "' AND  '" . date("Y-m-d") . "' group by pr.productoid,pr.nombre order by pr.cocineroid,";
	
	if(($result = mysqli_query($conn,$sql)) === false) {
		echo "Error running query: " . mysqli_error($conn) . "\n";
	}
	return $result;
}

function getCantidadPedidos($userid){
	$conn = conectar();
	$sql = "SELECT COUNT(pedidoid) as cantidad
	FROM pedido
	WHERE usuarioid =" . $userid . ";";
	$resultado=mysqli_query($conn,$sql);		
	$cdrow = mysqli_fetch_array($resultado);	
	return $cdrow["cantidad"];
}	

function getMisPedidos($userid){
	$conn = conectar();
	$sql = "SELECT pr.nombre, pp.chico, pp.mediano, pp.grande, pp.cantidad,p.pedidoid as pid, p.fecha FROM pedido p inner join productopedido pp on pp.pedidoid = p.pedidoid inner join producto pr on pp.productoid = pr.productoid where p.usuarioid = " . $userid . " order by p.fecha desc;";
	//$resultado=mysqli_query($conn,$sql);		
	return $sql;
	//return $resultado;
}


function getViandasPreciosForCategoria($categoriaId){

	$preciosViandas = [];
	$preciosViandas["preciochico"] = getViandaPrecio(1,$categoriaId);
	$preciosViandas["preciomediano"] = getViandaPrecio(2,$categoriaId);
	$preciosViandas["preciogrande"] = getViandaPrecio(3,$categoriaId);
	return $preciosViandas;
}

function getViandaPrecio($tamanio, $categoriaid){
	$conn = conectar();
	$sql = "SELECT Precio  FROM `preciotamanio` WHERE tamanio = $tamanio AND CategoriaId = $categoriaid;";
	$resultado=mysqli_query($conn,$sql);

	return mysqli_fetch_array($resultado)["Precio"];
}

function getUsuarioDireccion($userid){
	$conn = conectar();
//	$sql = "SELECT Direccion as address, PrecioDelivery as delivery, ZonaEnvio as zonaenvio from usuario where UsuarioId = " . $userid . ";";
	
	$sql = "SELECT usuario.PrecioDelivery, usuario.Direccion, ze.Nombre, gze.precio
            FROM usuario
            LEFT JOIN zonas_envio as ze ON usuario.ZonaEnvio= ze.ZonaId
            LEFT JOIN grupo_zonas_envio as gze ON ze.grupo_zona_envio_id = gze.id
            where UsuarioId = ". $userid.";";
            
	$resultado=mysqli_query($conn,$sql);		
	return $resultado;
}


function getPedidoDetalle($pedidoid){
	$conn = conectar();
	$sql = "SELECT pp.pedidoid,pp.productoid,p.nombre as prod, c.Nombre as cat, c.CategoriaId as catid, p.vegano, p.singluten, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad
	FROM productopedido pp 
	INNER JOIN producto p 
	on pp.productoid = p.productoid 
	inner join categoria c 
	on p.categoriaid = c.CategoriaId
	where pp.pedidoid = " . $pedidoid . "
	group by pp.productoid
	order by catid;";
	$resultado=mysqli_query($conn,$sql);		
	return $resultado;
}

function getTop5(){
	$conn = conectar();
	$sql = "SELECT p.nombre, SUM(pp.chico + pp.mediano + pp.grande) as suma from productopedido pp inner join producto p on pp.productoid = p.productoid
	group by pp.productoid
	order by suma desc LIMIT 5;";
	$resultado=mysqli_query($conn,$sql);		
	return $resultado;	
}

function getTotalProductosPedidos(){
	$conn = conectar();
	$sql = "SELECT SUM(pp.chico + pp.mediano + pp.grande) as suma from productopedido pp inner join producto p on pp.productoid = p.productoid
	having suma;";
	$resultado=mysqli_query($conn,$sql);		
	$cdrow = mysqli_fetch_array($resultado);	
	return $cdrow["suma"];
}

function getPedidoActualxCocinero($cocineroid)
{
	$today = date("Y-m-d");
	$conn = conectar();
	/*$sql = "SELECT pr.productoid, pr.nombre, SUM(pp.chico) as chico, SUM(pp.mediano) as mediano, SUM(pp.grande) as grande, SUM(pp.cantidad) as cantidad, c.Nombre as cat, c.CategoriaId as catid, pr.descripcion
	FROM pedido p 
	inner join productopedido pp 
	on p.pedidoid = pp.pedidoid 
	inner join producto pr 
	on pp.productoid = pr.productoid 
	inner join categoria c 
	on pr.categoriaid = c.CategoriaId
	WHERE pr.cocineroid = " . $cocineroid . " and fecha BETWEEN '" . getPedidoStartDate($today) . "' AND  '" . $today . "' group by pr.productoid,pr.nombre order by pr.categoriaid,pr.orden";
*/
	$sql ="SELECT pr.productoid, pr.nombre, SUM(pp.chico) AS chico, SUM(pp.mediano) AS mediano, SUM(pp.grande) AS grande, SUM(pp.cantidad) AS cantidad, u.Nombre AS cook, u.UsuarioId AS cookid, p.fecha_entrega AS fecha_entrega , pr.descripcion, pr.categoriaid AS catid FROM pedido p 
        INNER JOIN productopedido pp 
        ON p.pedidoid = pp.pedidoid
        INNER JOIN producto pr
        ON pp.productoid = pr.productoid
        INNER JOIN usuario u 
        ON pr.cocineroid = u.UsuarioId and u.Permiso = 'cocinero'
        WHERE pr.cocineroid = " . $cocineroid . " and p.fecha BETWEEN '" . getPedidoStartDate($today) . "' AND  '" . $today."'
        GROUP BY pr.cocineroid, p.fecha_entrega, pr.productoid ORDER BY  fecha_entrega, pr.cocineroid,pr.categoriaid,   pr.nombre";
	return mysqli_query($conn,$sql);

}

function getCantidadPorCategoriaPorPedido($pid,$catid,$tipo){
	$conn = conectar();
	$sql = "";
	if($tipo == 1){
		$sql = "SELECT (SUM(chico)) as cant FROM productopedido pp inner join producto p on pp.productoid = p.productoid where pedidoid = ". $pid ." and CategoriaId = " . $catid . ";";
	}
	else if($tipo == 2){	
		$sql = "SELECT (SUM(mediano)) as cant FROM productopedido pp inner join producto p on pp.productoid = p.productoid where pedidoid = ". $pid ." and CategoriaId = " . $catid . ";";
	}
	else if($tipo == 3){	
		$sql = "SELECT ( SUM(grande)) as cant FROM productopedido pp inner join producto p on pp.productoid = p.productoid where pedidoid = ". $pid ." and CategoriaId = " . $catid . ";";
	}
	else if($tipo == 4){	
		$sql = "SELECT (SUM(cantidad)) as cant FROM productopedido pp inner join producto p on pp.productoid = p.productoid where pedidoid = ". $pid ." and CategoriaId = " . $catid . ";";
	}

	$resultado=mysqli_query($conn,$sql);	
	$cdrow = mysqli_fetch_array($resultado);	
	return $cdrow["cant"];
}


function getPedidoActualNombre(){
	$dt = new DateTime();
	$fechaPedido =  $dt->format('Y-m-d H:i:s');
	$fecha = getFechaEntrega($fechaPedido);	
	$nameOfMonth = date('M', strtotime($fecha));
	$day = date('d', strtotime($fecha));
	return "Entrega " . $day . " de " . $nameOfMonth;

}


function getPedidoNombre($fechaPedido,$pedidoid){
	$fecha = getFechaEntrega($fechaPedido);	
	$nameOfMonth = date('M', strtotime($fecha));
	$day = date('d', strtotime($fecha));

	//return "Entrega " . $day . " de " . $nameOfMonth;
	$pedidonombre = "Entrega " . $day . " de " . $nameOfMonth;
	$pedidonombreid = "Entrega " . $day . " de " . $nameOfMonth . $pedidoid;
	return array($pedidonombreid,$pedidonombre);

}

/*Los pedidos realizados de viernes a domingo, se incluyen en el viernes de la siguiente semana. Los hechos de Lunes A jueves en el de la próxima semana.*/

function getFechaEntrega($today){

	$nameOfDay = date('D', strtotime($today));
	$startDate = $today;
	switch($nameOfDay) {
		case 'Mon':
		$startDate = get_date(+11,$today);
		break;
		case 'Tue':
		$startDate = get_date(+10,$today);
		break;
		case 'Wed':
		$startDate = get_date(+9,$today);
		break;
		case 'Thu':
		$startDate = get_date(+8,$today);
		break;
		case 'Fri':
		$startDate = get_date(+7,$today);
		break;
		case 'Sat':
		$startDate = get_date(+6,$today);
		break;
		case 'Sun':
		$startDate = get_date(+5,$today);
		break;
	}
	return $startDate;
}


function getPedidoStartDate($date){
	$nameOfDay = date('D', strtotime($date));
	$startDate = $date;
	switch($nameOfDay) {
		case 'Mon':
		$startDate = get_date(-7, $date);
		break;
		case 'Tue':
		$startDate = get_date(-8, $date);
		break;
		case 'Wed':
		$startDate = get_date(-9, $date);
		break;
		case 'Thu':
		$startDate = get_date(-10, $date);
		break;
		case 'Fri':
		$startDate = get_date(-11, $date);
		break;
		case 'Sat':
		$startDate = get_date(-5, $date);
		break;
		case 'Sun':
		$startDate = get_date(-6, $date);
		break;
	}
	return $startDate;
}

function get_date($cantDays, $date)
{
	return date('Y-m-d', strtotime($cantDays . ' day', strtotime($date) ));
}

function getAllCategorias()
{
	$conn = conectar();
	$sql = "SELECT * FROM categoria;";
	$resultado=mysqli_query($conn,$sql);
	return $resultado;
}

function getActiveCategorias()
{
	$conn = conectar();
	$sql = "SELECT * FROM categoria where Activo = 1;";
	$resultado=mysqli_query($conn,$sql);
	return $resultado;
}



function getProductsByCategory($catid){
	$conn = conectar();
	$sql = "SELECT * FROM producto where categoriaid = $catid and activo = 1 order by orden;";
	$resultado=mysqli_query($conn,$sql);

	$products = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	return $products;	
}

function traer_usuario($usuarioid)
{
	$conn = conectar();
	$sql = "SELECT * FROM usuario where UsuarioId = " . $usuarioid . " ;";
	$resultado=mysqli_query($conn,$sql);
	return mysqli_fetch_array($conn, $resultado);	
}


function getZonasEnvio()
{
	$conn = conectar();
	$sql = "SELECT ze.Nombre , ze.ZonaId, gze.nombre as nombre_grupo, gze.precio, gze.precio as Precio
            FROM zonas_envio as ze 
            INNER JOIN grupo_zonas_envio as gze
            ON ze.grupo_zona_envio_id = gze.id
            ORDER BY ze.Nombre;";
	$resultado=mysqli_query($conn,$sql);
	$zonas_envio = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	return $zonas_envio;
}

function getZonasEnvioAdmin()
{
	$conn = conectar();
	$sql = "SELECT ze.Nombre , ze.ZonaId, gze.nombre as nombre_grupo, gze.precio, gze.precio as Precio
            FROM zonas_envio as ze 
            INNER JOIN grupo_zonas_envio as gze
            ON ze.grupo_zona_envio_id = gze.id
            ORDER BY gze.nombre ASC;";
	$resultado=mysqli_query($conn,$sql);
	return $resultado;
}

function getUserZonaEnvio($u_id)
{
	$conn = conectar();
	$sql = "SELECT ZonaEnvio FROM usuario WHERE UsuarioId = ".$u_id.";";
	$resultado=mysqli_query($conn,$sql)->fetch_object()->ZonaEnvio;
	return $resultado;
}

function getGruposZonasEnvio()
{
	$conn = conectar();
	$sql = "SELECT * FROM grupo_zonas_envio ORDER BY nombre;";
	$resultado=mysqli_query($conn,$sql);
	return $resultado;
}


function getZonaEnvioById($zona_envio_id){
    
    $conn = conectar();
	$sql = "SELECT *
            FROM zonas_envio as ze 
            WHERE ze.ZonaId = '$zona_envio_id'
";
	$resultado=mysqli_query($conn,$sql);
	return $resultado->fetch_assoc();   
}

function getImagenesCategoria($categoriaid){
	$conn = conectar();
	$sql = "SELECT * FROM categoria_imagen where categoria_id = $categoriaid ORDER BY image_order ASC;";
	$resultado=mysqli_query($conn,$sql);
	$imagenes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	return $imagenes;
}

function getImagenCategoria($imagenid){
	$conn = conectar();
	$sql = "SELECT * FROM categoria_imagen where id = $imagenid;";
	$resultado=mysqli_query($conn,$sql);
	$imagen = mysqli_fetch_array($resultado);
	return $imagen;
}

function getPedidosByUser($userid){
	$conn = conectar();
	$sql = "SELECT pr.nombre, pp.chico, pp.mediano, pp.grande, pp.cantidad,p.pedidoid as pid, p.fecha FROM pedido p inner join productopedido pp on pp.pedidoid = p.pedidoid inner join producto pr on pp.productoid = pr.productoid where p.usuarioid = $userid order by p.fecha DESC, p.pedidoid DESC;";
	$resultado = mysqli_query($conn,$sql);	

	$productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
	
	$pedidos = [];
	foreach($productos as $producto){
		$pid = $producto['pid'];
        if (!isset($pedidos[$pid])) {
            $pedidos[$pid] = [
                'fecha' => $producto['fecha'],
                'products' => []
            ];
        }
		$pedidos[$pid]['products'][] = [
            'nombre' => $producto['nombre'],
            'chico' => $producto['chico'],
            'mediano' => $producto['mediano'],
            'grande' => $producto['grande'],
            'cantidad' => $producto['cantidad']
        ];
	}
	
	return $pedidos;

}

function getPedidoProductosPrecio($pedidoId)
{
	$conn = conectar();

	$sql = "SELECT (
           COALESCE(SUM(pp.grande *
               (select Precio from preciotamanio where Tamanio = 3 AND preciotamanio.CategoriaId = c.CategoriaId)), 0) +
           COALESCE(SUM(pp.mediano *
               (select Precio from preciotamanio where Tamanio = 2 AND preciotamanio.CategoriaId = c.CategoriaId)), 0) +
           COALESCE(SUM(pp.chico *
               (select Precio from preciotamanio where Tamanio = 1 AND preciotamanio.CategoriaId = c.CategoriaId)), 0) +
           COALESCE(SUM(pp.cantidad * COALESCE(NULLIF(pr.precio, 0), c.Precio)), 0)
           ) as precioTotal
		FROM pedido p
         inner join productopedido pp
                    on p.pedidoid = pp.pedidoid
         inner join producto pr
                    on pr.productoid = pp.productoid
         inner join categoria c
                    on c.CategoriaId = pr.categoriaid
		where p.pedidoid = $pedidoId;";

	$resultado = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($resultado);

	return $row["precioTotal"];
}

function getZonaEnvioPrecioForPedido($pedidoId)
{
	$conn = conectar();

	$sql = "SELECT gze.precio FROM pedido p 
	INNER JOIN usuario u on p.usuarioid = u.UsuarioId 
	INNER JOIN zonas_envio ze on u.ZonaEnvio = ze.ZonaId 
	INNER JOIN grupo_zonas_envio AS gze ON ze.grupo_zona_envio_id = gze.id 
	WHERE pedidoid = " . $pedidoId . ";";

	$resultado2 = mysqli_query($conn, $sql);
	$row2 = mysqli_fetch_array($resultado2);

	return $row2["precio"] ?? 0;
}

function getPedidoPrecioTotal($pedidoId)
{
	$precio1 = getPedidoProductosPrecio($pedidoId);
	$precio2 = getZonaEnvioPrecioForPedido($pedidoId);

	return $precio1 + $precio2;
}

function getFechaEntregaMasCercana($date){
	//return the nearest date that is friday
	$day = date('D', strtotime($date));
	$startDate = $date;
	switch($day) {
		case 'Mon':
		$startDate = get_date(+4,$date);
		break;
		case 'Tue':
		$startDate = get_date(+3,$date);
		break;
		case 'Wed':
		$startDate = get_date(+2,$date);
		break;
		case 'Thu':
		$startDate = get_date(+1,$date);
		break;
		case 'Fri':
		$startDate = $date;
		break;
		case 'Sat':
		$startDate = get_date(+6,$date);
		break;
		case 'Sun':
		$startDate = get_date(+5,$date);
		break;
	}
	return $startDate;
}

///////////////////////////FIN METODOS GET LISTADO////////////////////////////////////

?>
