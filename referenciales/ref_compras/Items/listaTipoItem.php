<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = $_POST['mercaderia'];

$sql = "select tip_items_nro, tip_items_desc as mercaderia from tipo_items
        where tip_items_desc ilike '%$filtro%';";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>