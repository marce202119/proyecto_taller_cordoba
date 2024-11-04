<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if (isset($_POST['operacion'])) {

    $sql = "SELECT * FROM sp_tipo_items(
        {$_POST['tip_items_nro']},
        '{$_POST['tip_items_desc']}'
    ) AS ultcod;";

    $resultado = pg_query($conexion, $sql);

    if (!$resultado) {
        echo json_encode(array(
            "mensaje" => pg_last_error($conexion),
            "tipo" => "error"
        ));
    } else {
        $ultcod = pg_fetch_assoc($resultado);
        echo json_encode(array(
            "mensaje" => pg_last_notice($conexion),
            "tipo" => "success",
            "ultcod" => $ultcod['ultcod']
        ));
    }

} else {
    $sql = "SELECT * FROM tipo_items";
    $resultado = pg_query($conexion, $sql);

    if (!$resultado) {
        echo json_encode(array(
            "mensaje" => pg_last_error($conexion),
            "tipo" => "error"
        ));
    } else {
        $datos = pg_fetch_all($resultado);
        echo json_encode($datos);
    }
}
?>
