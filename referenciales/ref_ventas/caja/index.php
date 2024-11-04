<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Referenciales | Proveedores</title>
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
                            <h2>Formulario de Proveedores</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="provee_cod" value="" class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="provee_name" class="form-control editable" disabled>
                                            <label class="form-label">Nombre</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="provee_ruc" class="form-control editable" disabled>
                                            <label class="form-label">RUC</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="provee_direc" class="form-control editable" disabled>
                                            <label class="form-label">Dirección</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" id="email" class="form-control editable" disabled>
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="telefono" class="form-control editable" disabled>
                                            <label class="form-label">Teléfono</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-demo text-center">
                                <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                <button type="button" class="btn btn-info waves-effect btnOperacion1" onclick="editar();">MODIFICAR</button>
                                <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="borrar();">ELIMINAR</button>
                                <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                PROVEEDORES REGISTRADOS <small>Lista de Proveedores Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>RUC</th>
                                            <th>Dirección</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
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