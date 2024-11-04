<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['cliente'];

$sql = "select 
c.client_nro,
c.client_razon_social ||' | Ruc: '|| c.client_ruc as cliente,
c.client_estado 
from cliente as c
where client_ruc ilike '%$filtro%' 
or client_razon_social ilike '%$filtro%';";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>