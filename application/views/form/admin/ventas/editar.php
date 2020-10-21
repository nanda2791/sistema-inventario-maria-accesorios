 <!-- page content -->
 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3>Editar Ventas</h3>
             </div>

             <div class="title_right">
             </div>
         </div>

         <div class="clearfix"></div>

         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <h2>Formulario Ventas</h2>
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

                                 <form action="<?php echo base_url(); ?>Movimientos/Ventas/actualizar" method="POST" class="form-horizontal">
                                     <div class="form-group">
                                         <input type="number" hidden="hidden" name="id_ventas" id="id_ventas" value="<?php echo $venta->id_ventas ?>">
                                     </div>
                                     <div class="form-group">
                                         <div class="col-md-3">
                                             <label for="">Cliente:</label>
                                             <div class="input-group">
                                                 <input type="hidden" name="id_clientes" value="<?php echo $venta->id_clientes ?>" id="id_clientes">
                                                 <input type="text" class="form-control" readonly="readonly" value="<?php echo $venta->nombre_cliente; ?>" required id="idcliente">
                                                 <span class="input-group-btn">
                                                     <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-clientes"><span class="fa fa-search"></span> Buscar</button>
                                                 </span>
                                             </div><!-- /input-group -->
                                         </div>
                                         <div class="col-md-3">
                                             <label for="">Empleado a cargo:</label>
                                             <div class="input-group">
                                                 <input type="hidden" name="id_empleados" value="<?php echo $venta->id_empleados ?>" id="id_empleados">
                                                 <input type="text" class="form-control" value="<?php echo $venta->nombre_empleado . ' ' . $venta->apellidos_empleado ?>" readonly="readonly" required id="idempleado">
                                                 <span class="input-group-btn">
                                                     <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-empleados"><span class="fa fa-search"></span> Buscar</button>
                                                 </span>
                                             </div><!-- /input-group -->
                                         </div>


                                     </div>
                                     <div class="form-group">
                                         <div class="col-md-3">
                                             <label for="">Fecha:</label>
                                             <input type="date" value="<?php echo $venta->fecha; ?>" class="form-control" name="fecha" required>
                                         </div>
                                         <div class="col-md-3">
                                             <label for="estado_venta" class="">Estado Ventas</label>
                                             <select name="estado_venta" id="estado_venta" requiered='requiered' class="form-control col-md-7 col-xs-12">

                                                 <option value="">Seleccione...</option>
                                                 <option value="Cancelado" <?php echo ($venta->estado_venta == 'Cancelado') ? 'selected' : ''; ?>> Cancelado</option>
                                                 <option value="Debe" <?php echo ($venta->estado_venta == 'Debe') ? 'selected' : ''; ?>>Debe</option>
                                             </select>
                                         </div>
                                         <div class="col-md-3">
                                             <label for="">Adelanto:</label>
                                             <input type="number" id="adelanto" value="<?php echo $venta->adelanto; ?>" class="form-control" name="adelanto" required>
                                         </div>
                                         <div class="col-md-3">
                                             <label for="">Descuento:</label>
                                             <input type="number" id="descuento" value="<?php echo $venta->descuento; ?>" class="form-control" name="descuento" required>
                                         </div>


                                     </div>

                                     <label for="Productos" class="col-md-12">Buscar y agregar productos o servicios</label>
                                     <br></br>
                                     <div class="form-group">

                                         <div class="col-md-2">
                                             <label for="">&nbsp;</label>
                                             <button id="btn-agregar" class="btn btn-primary btn-flat btn-block" type="button" data-toggle="modal" data-target="#modal-productos"><span class="fa fa-search"></span>Agregar</button>
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
                                                 <th>Observaciones</th>
                                                 <th></th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php if (!empty($detalle_ventas)) : ?>
                                                 <?php foreach ($detalle_ventas as $detalle_venta) : ?>
                                                     <tr>
                                                         <td><input type='hidden' class='id_productos' name='id_productos[]' value='<?php echo $detalle_venta->id_productos ?>'><?php echo $detalle_venta->codigo ?></td>
                                                         <td><?php echo $detalle_venta->nombre; ?></td>
                                                         <td><?php echo $detalle_venta->marca; ?></td>
                                                         <td><input type='number' class='precio_unitario form-control' name='precio_unitario[]' value='<?php echo $detalle_venta->precio_unitario ?>'></td>
                                                         <td><input type='number' class="cantidad" name='cantidad[]' min='0' value='<?php echo $detalle_venta->cantidad ?>'></td>
                                                         <td><input type='number' class='total form-control' readonly name='total[]' value='<?php echo $detalle_venta->total ?>'>
                                                         </td>
                                                         <td><input type='text' class='observaciones form-control' name='observaciones[]' value='<?php echo $detalle_venta->observaciones ?>'><?php echo $detalle_venta->observaciones ?></td>
                                                         <td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>
                                                     </tr>

                                                 <?php endforeach; ?>
                                             <?php endif; ?>
                                         </tbody>
                                     </table>

                                     <div class="form-group">
                                         <div class="col-md-3">
                                             <div class="input-group">
                                                 <span class="input-group-addon">Saldo:</span>
                                                 <input type="number" class="form-control" id="saldo" placeholder="" value="<?php echo $venta->saldo; ?>" name="saldo" readonly="readonly">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="input-group">
                                                 <span class="input-group-addon">Total Venta:</span>
                                                 <input type="number" class="form-control" id="total_venta" placeholder="" value="<?php echo $venta->total_venta; ?>" name="total_venta" readonly="readonly">
                                             </div>
                                         </div>


                                     </div>

                                     <div class="form-group">
                                         <div class="col-md-12">
                                             <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Ventas") ?>" type="button">Volver</a>
                                             <button type="submit" class="btn btn-success btn-flat">Editar</button>
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


 <div class="modal fade" id="modal-clientes">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Lista de Clientes</h4>
             </div>
             <div class="modal-body">
                 <table id="tabla_empleado" class="table table-bordered table-striped table-hover">
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

 <div class="modal fade" id="modal-productos">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Lista de Productos</h4>
             </div>
             <div class="modal-body">
                 <table id="tablaProdcutos" class="table table-bordered table-striped table-hover">
                     <thead>
                         <tr>
                             <th>Codigo</th>
                             <th>Nombre</th>
                             <th>Lugar Almacenamiento</th>
                             <th>Color</th>
                             <th>Talla</th>
                             <th>Marca</th>
                             <th>Fecha ingreso</th>
                             <th>Opcion</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php if (!empty($productos)) : ?>
                             <?php foreach ($productos as $producto) : ?>
                                 <tr>
                                     <<td><?php echo $producto->codigo; ?></td>
                                         <td><?php echo $producto->nombre; ?></td>
                                         <td><?php echo $producto->lugar_almacenado; ?></td>
                                         <td><?php echo $producto->color; ?></td>
                                         <td><?php echo $producto->talla; ?></td>
                                         <td><?php echo $producto->marca; ?></td>
                                         <td><?php echo $producto->fecha_registro; ?></td>

                                         <?php $dataproducto = $producto->id_productos . "*" . $producto->codigo . "*" . $producto->nombre . "*" . $producto->lugar_almacenado . "*" . $producto->color . "*" . $producto->talla . "*" . $producto->marca . "*" . $producto->fecha_registro; ?>

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
                 <table id="example1" class="table table-bordered table-striped table-hover">
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