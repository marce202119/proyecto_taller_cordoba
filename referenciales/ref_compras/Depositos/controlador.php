<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if (isset($_POST['operacion'])) {

    $sql = "select * from sp_deposito(
        {$_POST['depo_nro']},
        '{$_POST['depo_desc']}',
        '{$_POST['id_sucursal']}'
        {$_POST['operacion']}
    ) as ultcod;";

    $resultado = pg_query($conexion, $sql);

    if (!$resultado) {
        echo json_encode(
            array(
                "mensaje" => pg_last_error($conexion),
                "tipo" => "error"
            )
        );
    } else {
        $ultcod = pg_fetch_assoc($resultado);
        echo json_encode(
            array(
                "mensaje" => pg_last_notice($conexion) ?: "Operación completada exitosamente",
                "tipo" => "success",
                "ultcod" => $ultcod['ultcod'] ?? null
            )
        );
    }
    
} else {
    
    $sql = "SELECT 
                d.depo_nro,
                d.depo_desc,
                s.id_sucursal,
                s.sucu_desc AS sucursal";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);

    echo json_encode($datos);
}

?>
