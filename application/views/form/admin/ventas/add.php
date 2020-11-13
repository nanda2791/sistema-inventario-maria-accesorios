<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Registrar una nueva venta</h3>
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Formulario de Ventas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ($this->session->flashdata("error")) : ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dissmiss="alert" aria-hidden="true"></button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>

                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">

                                <form action="<?php echo base_url(); ?>Movimientos/Ventas/guardar" method="POST" class="form-horizontal">
                                    <div class="form-group">


                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-3">
                                            <label for="">Cliente:</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id_clientes" id="id_clientes">
                                                <input type="text" class="form-control" readonly="readonly" required id="idcliente">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-clientes"><span class="fa fa-search"></span> Buscar</button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </div>
                                       
                                        <div class="col-md-3">
                                            <label for="">Empleado:</label>
                                            <div class="input-group">
                                                <input type="hidden" name="id_empleados" id="id_empleados">
                                                <input type="text" class="form-control" readonly="readonly" required id="idempleado">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-empleados"><span class="fa fa-search"></span> Buscar</button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="">Fecha:</label>
                                            <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="fecha" name="fecha">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estado_venta" class="">Estado de la Ventas</label>
                                            <select name="estado_venta" id="estado_venta" requiered='requiered' class="form-control col-md-7 col-xs-12">
                                                <option value=""></option>
                                                <option value="Cancelado">Cancelado </option>
                                                <option value="Debe">Debe</option>


                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="proyecto">Adelanto:</label>
                                            <input type="number" name="adelanto" id="adelanto" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="proyecto">Descuento:</label>
                                            <input type="number" name="descuento" id="descuento" class="form-control">
                                        </div>

                                    </div>

                                    <hr>
                                    <label for="Productos" class="col-md-12">Buscar y agregar un distribuidor</label>
                                    <br></br>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label for="">&nbsp;</label>
                                            <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" data-toggle="modal" data-target="#modal-productos"><span class="fa fa-plus"></span> Agregar</button>
                                        </div>
                                    </div>
                                    <br></br>

                                    <table id="tbventas" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Marca</th>
                                                <th>Precio Unitario.</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <th>Precio Promedio</th>
                                                <th>Observaciones</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>


                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="input-group has-feedback">
                                                <span class="input-group-addon">Saldo:</span>
                                                <input type="text" class="form-control" placeholder="" id="saldo" value="0.00" name="saldo" readonly="readonly">
                                                <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group has-feedback">
                                                <span class="input-group-addon">Total Venta:</span>
                                                <input type="text" class="form-control" placeholder="" id="total_venta" value="0.00" name="total_venta" readonly="readonly">
                                                <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Ventas") ?>" type="button">Volver</a>
                                            <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<div class="modal fade" id="modal-productos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Productos</h4>
            </div>
            <div class="modal-body">
                <table id="tablaProductos" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Lugar Almacenamiento</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Marca</th>
                            <th>Precio Promedio</th>
                            <th>Fecha ingreso</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)) : ?>
                            <?php foreach ($productos as $producto) : ?>
                                <tr>
                                    <td><?php echo $producto->codigo; ?></td>
                                    <td><?php echo $producto->nombre; ?></td>
                                    <td><?php echo $producto->lugar_almacenado; ?></td>
                                    <td><?php echo $producto->color; ?></td>
                                    <td><?php echo $producto->talla; ?></td>
                                    <td><?php echo $producto->marca; ?></td>
                                    <td><?php echo number_format($producto->Precio_promedio,2); ?></td>
                                    <td><?php echo $producto->fecha_registro; ?></td>

                                    <?php $dataproducto = $producto->id_productos . "*" . $producto->codigo . "*" . $producto->nombre . "*" . $producto->lugar_almacenado . "*" . $producto->color . "*" . $producto->talla . "*" . $producto->marca . "*" . $producto->Precio_promedio . "*" . $producto->fecha_registro; ?>

                                    <td>
                                        <button type="button" class="btn btn-success btn-check-producto" value="<?php echo $dataproducto ?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-clientes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de clientes</h4>
            </div>
            <div class="modal-body">
                <table id="tabla-empleado" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo Cliente</th>
                            <th>CI</th>
                            <th>Telefono</th>
                            <th>Departamento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr>
                                    <td><?php echo $cliente->id_clientes; ?></td>
                                    <td><?php echo $cliente->nombres; ?></td>
                                    <td><?php echo $cliente->id_tipo_cliente; ?></td>
                                    <td><?php echo $cliente->num_documento; ?></td>
                                    <td><?php echo $cliente->telefono; ?></td>
                                    <td><?php echo $cliente->departamento; ?></td>
                                    <?php $datacliente = $cliente->id_clientes . "*" . $cliente->id_tipo_cliente . "*" . $cliente->nombres . "*" . $cliente->num_documento . "*" . $cliente->telefono . "*" . $cliente->departamento; ?>

                                    <td>
                                        <button type="button" class="btn btn-success btn-check-cliente" value="<?php echo $datacliente ?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="modal-cliente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de clientes</h4>
            </div>
            <div class="modal-body">
                <table id="tabla-empleado" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo Cliente</th>
                            <th>CI</th>
                            <th>Telefono</th>
                            <th>Departamento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($clientes)) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr>
                                    <td><?php echo $cliente->id_clientes; ?></td>
                                    <td><?php echo $cliente->nombres; ?></td>
                                    <td><?php echo $cliente->id_tipo_cliente; ?></td>
                                    <td><?php echo $cliente->num_documento; ?></td>
                                    <td><?php echo $cliente->telefono; ?></td>
                                    <td><?php echo $cliente->departamento; ?></td>
                                    <?php $datacliente = $cliente->id_clientes . "*" . $cliente->id_tipo_cliente . "*" . $cliente->nombres . "*" . $cliente->num_documento . "*" . $cliente->telefono . "*" . $cliente->departamento; ?>

                                    <td>
                                        <button type="button" class="btn btn-success btn-check-departamento" value="<?php echo $datacliente ?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->

<div class="modal fade" id="modal-empleados">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Empleados</h4>
            </div>
            <div class="modal-body">
                <table id="tabla-empleado" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Documento</th>
                            <th>Numero</th>
                            <th>Telefono</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($empleados)) : ?>
                            <?php foreach ($empleados as $empleado) : ?>
                                <tr>
                                    <td><?php echo $empleado->id_empleados; ?></td>
                                    <td><?php echo $empleado->nombre; ?></td>
                                    <td><?php echo $empleado->apellidos; ?></td>
                                    <td><?php echo $empleado->tipodocumento; ?></td>
                                    <td><?php echo $empleado->num_documento; ?></td>
                                    <td><?php echo $empleado->telefono_01; ?></td>
                                    <?php $dataempleado = $empleado->id_empleados . "*" . $empleado->nombre . "*" . $empleado->apellidos . "*" . $empleado->tipodocumento . "*" . $empleado->num_documento . "*" . $empleado->telefono_01 . "*" . $empleado->direccion; ?>

                                    <td>
                                        <button type="button" class="btn btn-success btn-check-empleado" value="<?php echo $dataempleado ?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->