<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();
$filtro = 1;//$_POST['timbrado'];

$sql = "SELECT timb_cod, timb_num_desde ||' - '|| timb_num_hasta as timbrado from timbrado
        where timb_num_desde ilike '%$filtro%';";
$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>