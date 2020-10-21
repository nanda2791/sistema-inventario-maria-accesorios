    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">

          </div>

          <div class="title_right">
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Dashboard Maria Accesorios</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <div class="row tile_count">
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Inventario Actual</span>
                    <div class="count green"><?php echo $valor_inventario['items_almacen'] ?>  Items</div>
                   
                    
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Valor de inventario Compras</span>
                    <div class="count red"><?php echo number_format($valor_total_compra['total_compras'],2,'.',',')  ?> Bs</div>
                    <span class="count_bottom"><i class=""><i class=""></i><?php echo $valor_items_compra['items_compras'] ;?> </i> Cantidad items</span>
                   
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Valor de inventario Ventas</span>
                    <div class="count red"><?php echo number_format($valor_total_venta['total_ventas'],2,'.',',')  ?> Bs</div>
                    <span class="count_bottom"><i class=""><i class=""></i><?php echo $valor_items_venta['items_ventas'] ;?> </i> Cantidad items</span>
                   
                  </div>
                  
                
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content" style="display:none">
              

                </div>
               
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->


    <div class="modal fade" id="modal-default">

      <div class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">

            
          </div>

          <div class="modal-body">



          </div>

         
        </div>

        <!-- /.modal-content -->

      </div>

      <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->