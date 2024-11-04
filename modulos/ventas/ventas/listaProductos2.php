<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro2 = $_POST['sucursal'];
$filtro3 = $_POST['mercaderia'];

$sql = "select 
        i.items_nro ,i.items_precio, i.items_desc ||' | Stock: '||s.stock_cantidad as mercaderia,
        d.depo_nro,
        s2.id_sucursal 
        from items as i 
        inner join stock as s on i.items_nro = s.items_nro
        inner join deposito as d on s.depo_nro = d.depo_nro
        inner join sucursal as s2 on d.id_sucursal = s2.id_sucursal  
        where i.items_desc ilike '%$filtro3%' and s2.id_sucursal = $filtro2;";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>