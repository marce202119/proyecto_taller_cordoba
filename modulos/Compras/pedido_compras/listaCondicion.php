<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['condicion'];

$sql = "select tip_fac_nro, tip_fac_desc as condicion from tipo_factura
where tip_fac_desc ilike '%$filtro%';";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>