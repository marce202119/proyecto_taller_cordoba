<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_proveedor(
        {$_POST['p_codigo']},
        '{$_POST['p_nombre']}',
        '{$_POST['p_ruc']}',
        '{$_POST['p_direccion']}',
        '{$_POST['p_email']}',
        '{$_POST['p_telefono']}'
    ) as ultcod;";

    $resultado = pg_query($conexion,$sql);

    if(!$resultado){
        echo json_encode(
            array(
                "mensaje"=>pg_last_error(),
                "tipo"=>"error"
            )
        );
    }else{
        $ultcod = pg_fetch_assoc($resultado);
        echo json_encode(
            array(
                "mensaje"=>pg_last_notice($conexion),
                "tipo"=>"success",
                "ultcod"=>$ultcod['ultcod']
            )
        );
    }

}else{
    $sql = "SELECT * FROM proveedor";
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