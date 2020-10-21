<!-- page content -->
<div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Editar Distribuidores</h3>
          </div>

          <div class="title_right">
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Distribuidor</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <?php if ($this->session->flashdata("error")): ?>
                     <div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dissmiss="alert" aria-hidden="true">$times;</button>
                         <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error");?></p>

                     </div>
                    <?php endif;?>

                
                 <form method="POST" action="<?php echo base_url();?>Mantenimiento/Distribuidor/actualizarDistribuidor" id="distribuidor" class="form-horizontal form-label-left">
                     <input type="hidden" value="<?php echo $distribuidor->id_distribuidor;?>" name= "id_distribuidor">
                    <div class="form-group <?php echo !empty(form_error("nombre"))?'has-error':'';?>">
                         <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                         <div class="col-md-4 col-sm-6 col-xs-12">
                             <input type="text" name="nombre" id=nombre value="<?php echo !empty(form_error("nombre"))? set_value("nombre"):$distribuidor->nombre ?>" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del Distribuidor">
                             <?php echo form_error("nombre","<span class='help-block col-md-4 cols-xs-12 '>","</span>");?>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="pagina_web" class="control-label col-md-3 col-sm-3 col-xs-12">Pagina Web <span class="required">*</span></label>
                         <div class="col-md-4 col-sm-6 col-xs-12">
                             <input type="text" name="pagina_web" id="pagina_web" value="<?php echo $distribuidor->pagina_web ?>" required="required" class="form-control col-md-7 col-xs-12" placeholder="Pagina web">

                         </div>
                     </div>



                     <div class="form-group">

                         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             <a class="btn btn-primary btn-flat" href="<?php echo site_url("Mantenimiento/Distribuidor")?>" type="button">Volver</a>
                             <button type="submit" id="guardar" class="btn btn-success">Editar</button> 
                            
                         </div>
                     </div>

                 </form>

                 <hr>
                 
                 <!-- /.box -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->