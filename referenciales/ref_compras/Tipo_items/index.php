<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Referenciales | Tipo de Items</title>
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
                            <h2>Formulario de Tipo de Items</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="tip_items_nro" value="" class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="tip_items_desc" class="form-control editable" disabled>
                                            <label class="form-label">Descripción</label>
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
                                TIPOS DE ITEMS REGISTRADOS <small>Lista de Tipos de Items Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
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
