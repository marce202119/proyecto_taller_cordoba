<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['impuesto'];

$sql = "select tip_impto_nro, tip_impto_desc as impuesto from tipo_impuesto
        where tip_impto_desc ilike '%$filtro%';";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>