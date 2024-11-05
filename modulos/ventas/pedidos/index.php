<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ventas | Pedidos de Ventas</title>
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
                            <h2>Formulario de Pedidos</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_nro" value="<?php echo "001" ?>" class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="id_sucursal" value="<?php echo $u['id_sucursal'] ?>" class="form-control" disabled>
                                            <input type="text" id="sucursal" value="<?php echo $u['sucu_nombre'] ?>" class="form-control" disabled>
                                            <label class="form-label">Sucursal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="funcio_cod" value="<?php echo $u['funcio_cod'] ?>" class="form-control" disabled>
                                            <input type="text" id="funcionario" value="<?php echo $u['funcio_nombre'] ?> <?php echo $u['funcio_apellido'] ?>" class="form-control" disabled>
                                            <label class="form-label">Funcionario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="client_nro" value="0">
                                            <input type="text" id="cliente" class="form-control editable" onkeyup="getClientes()">
                                            <label class="form-label">Cliente</label>
                                            <div id="listaClientes" style="display: none;">
                                                <ul class="list-group" id="ulClientes"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="datetime" id="pedido_fecha_f" value="<?= date('d/m/Y h:m:s') ?>" class="form-control datetimepicker" disabled>
                                            <label class="form-label">Fecha de Registro</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_fecha_pedido_f" class="form-control datetimepicker editable" disabled>
                                            <label class="form-label">Fecha de Pedido</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_fecha_tope_f" class="form-control datetimepicker editable" disabled>
                                            <label class="form-label">Fecha Tope</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_fecha_cancel_f" class="form-control datetimepicker" disabled>
                                            <label class="form-label">Fecha de Cancelación</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_obs" class="form-control editable" disabled>
                                            <label class="form-label">Observación</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_estado" class="form-control" disabled>
                                            <label class="form-label">Estado</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-demo text-center">
                                    <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                    <button type="button" class="btn btn-info waves-effect btnOperacion1" onclick="editar();">MODIFICAR</button>
                                    <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="anular();">ANULAR</button>
                                    <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                    <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="header">
                            <h2>Detalles del Pedido</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion_det" value="1">
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="items_nro" value="0">
                                            <input type="text" id="mercaderia" class="form-control editableDet" onkeyup="getProducto()">
                                            <label class="form-label">Producto</label>
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
                                            <input type="number" id="pedido_cantidad" class="form-control editableDet">
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
                                            <th>Descripción</th>
                                            <th>Precio Unitario</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_detalles">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                PEDIDOS REGISTRADOS <small>Lista de Pedidos Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cliente</th>
                                            <th>Ruc</th>
                                            <th>Fecha de Pedido</th>
                                            <th>Fecha de Tope</th>
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