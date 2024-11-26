<?php 
header('Content-type: application/json; charset=utf-8');
require_once "{$_SERVER['DOCUMENT_ROOT']}/taller/app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

// Obtener el filtro de la solicitud POST
$filtro = $_POST['sucursal'];

// Si el filtro está presente, se agrega a la consulta SQL
if ($filtro) {
    $sql = "SELECT id_sucursal, sucu_nombre, sucu_direccion, sucu_email, sucu_telefono, sucu_estado 
            FROM sucursal
            WHERE sucu_nombre LIKE '%$filtro%'";  // Filtro por nombre de sucursal
} else {
    $sql = "SELECT id_sucursal, sucu_nombre, sucu_direccion, sucu_email, sucu_telefono, sucu_estado 
            FROM sucursal";
}

$resultado = pg_query($conexion, $sql);
$datos = pg_fetch_all($resultado);
echo json_encode($datos);
?>
