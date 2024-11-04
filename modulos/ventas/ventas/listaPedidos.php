<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['pedidos'];

$sql = "select 
pvc.*,
pvc.pedido_nro ||' -- '|| c.client_razon_social as pedidos
from pedidos_ventas_cab as pvc
inner join cliente as c on pvc.client_nro = c.client_nro 
where pvc.client_nro = $filtro;";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>