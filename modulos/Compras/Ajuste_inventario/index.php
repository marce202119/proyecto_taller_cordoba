
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Compras | Ajuste inventario</title>
    <?php include "{$_SERVER['DOCUMENT_ROOT']}/taller/importCSS.php"; ?>
    <style>
        .list-group-item:hover {
            background-color: #1f91f3;
            color: white;
        }
    </style>
</head>

<body class="theme-blue">

    <?php include "../../../opciones.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Formulario de Ajuste de inventario</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="ajus_nro" value="" class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="sucu_cod" value="<?php echo $u['sucu_cod'] ?>" class="form-control" disabled>
                                            <input type="text" id="Sucursal" value="<?php echo $u['sucu_nombre'] ?> 
                                            <label class="form-label">Sucursal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <input type="text" id="funcio_cod" value="" class="form-control" disabled>
                                            <label class="form-label">Codigo de funcionario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="datetime" id="ajus_fecha" value="<?php date('d/m/Y h:m:s') ?>" class="form-control datetimepicker" disabled>
                                            <label class="form-label">Fecha de ajuste</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="ajus_esatdo" class="form-control" disabled>
                                            <label class="form-label">Estado de ajuste</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-demo text-center">
                                    <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                    <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="anular();">ANULAR</button>
                                    <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                    <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                                </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="header">
                            <h2>Detalles del ajuste</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion_det" value="1">
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="ajus_nro" value="0">
                                            <input type="text" id="ajus_nro" class="form-control editableDet" onclick="getProducto()">
                                            <label class="form-label">Ajuste numero</label>
                                            <div id="listaProductos" style="display: none;">
                                                <ul class="list-group" id="ulProductos"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="items_precio" class="form-control editableDet">
                                            <label class="form-label">Precio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" id="pdet_cantidad" class="form-control editableDet">
                                            <label class="form-label">Cantidad</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="button-demo text-center">
                                        <button type="button" class="btn btn-success waves-effect btnOperacion2" onclick="agregarDetalle(1);">AGREGAR</button>
                                        <button type="button" class="btn btn-info waves-effect btnOperacion2" onclick="agregarDetalle(2);">MODIFICAR</button>
                                        <button type="button" class="btn btn-danger waves-effect btnOperacion4" onclick="agregarDetalle(3);">ELIMINAR</button>
                                        <!--- <button type="button" class="btn btn-danger waves-effect btnOperacion4" onclick="agregarDetalle(3);">EDITAR</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_detalles">
                                    </tbody>
                                    <tfoot id="pie_detalles">

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                AJUSTES DE INVENTARIO REGISTRADOS <small>Lista de ajustes de inventario Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_datos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php include "{$_SERVER['DOCUMENT_ROOT']}/taller/importJS.php"; ?>
    <script src="metodo.js"></script>

</body>

</html>