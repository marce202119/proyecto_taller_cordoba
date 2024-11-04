<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['sucursal'];
$filtro1 = $_POST['mercaderia'];

$sql = "select 
pvd.*,
i.items_nro ,i.items_precio, i.items_desc ||' | Stock: '||s.stock_cantidad as mercaderia,
s.depo_nro, s.stock_min, s.stock_max, s.stock_cantidad,
s2.id_sucursal, s2.sucu_nombre as sucursal
from pedidos_ventas_det as pvd
inner join items as i on pvd.items_nro = i.items_nro 
inner join stock as s on i.items_nro = s.items_nro
inner join deposito as d on s.depo_nro = d.depo_nro
inner join sucursal as s2 on d.id_sucursal = s2.id_sucursal
where s2.id_sucursal = $filtro and pvd.pedido_nro = $filtro1;";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>