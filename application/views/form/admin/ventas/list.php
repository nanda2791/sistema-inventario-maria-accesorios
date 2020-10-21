 <!-- page content -->
 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3>Ventas</h3>
             </div>

             <div class="title_right">
             </div>
         </div>

         <div class="clearfix"></div>

         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <h2>Lista de Ventas</h2>
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
                         <div class="form-group">
                             <a href="<?php echo base_url(); ?>Movimientos/Ventas/add">

                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                     <button type="submit" id="agregar" class="btn btn-success">Crear una nueva venta</button>
                             </a>

                         </div>
                         <br>
                         <br>
                         <hr>
                         <div class="row">

                             <div class="col-md-12">
                                 <table id="example1" class="table table-bordered btn-hover">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Fecha</th>
                                             <th>Estado Ventas</th>
                                             <th>Saldo</th>
                                             <th>Total Venta</th>
                                             <th>Opciones</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if (!empty($ventas)) : ?>
                                             <?php foreach ($ventas as $venta) : ?>
                                                 <tr>
                                                     <td><?php echo $venta->id_ventas; ?></td>
                                                     <td><?php echo $venta->fecha; ?></td>
                                                     <td><?php echo $venta->estado_venta; ?></td>
                                                     <td><?php echo $venta->saldo; ?></td>
                                                     <td><?php echo $venta->total_venta; ?></td>
                                                     <td>
                                                         <button title="Vista del proyecto" type="button" class="btn btn-info btn-view-ventas" data-toggle="modal" data-target="#modal-default" value="<?php echo $venta->id_ventas ?>"><span class="fa fa-file-text-o"></span></button>
                                                         <a title="Editar" href="<?php echo base_url() ?>Movimientos/Ventas/editar/<?php echo $venta->id_ventas; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                         <button title="Borrar" type="button" value="<?php echo $venta->id_ventas; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         <?php endif; ?>

                                     </tbody>
                                 </table>
                             </div>
                         </div>

                         <!-- /.box -->
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /page content -->

 <div class="modal fade" id="modal-default">

     <div class="modal-dialog modal-lg">

         <div class="modal-content">

             <div class="modal-header">

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title">Informacion de la venta</h4>

             </div>

             <div class="modal-body">



             </div>

             <div class="modal-footer">


                 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                 <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>


             </div>

         </div>

         <!-- /.modal-content -->

     </div>
 </div>
 <!-- /.modal-dialog -->

 </div>
 <!-- /.modal -->