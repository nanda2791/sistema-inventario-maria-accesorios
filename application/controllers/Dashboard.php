<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }


    public function index()
    {

        $data = array(
            'productos' => $this->Productos_model->getProductos(),
            'valor_inventario' => $this->Productos_model->valorInventario(),
            'valor_total_compra' => $this->Compras_model->valorTotalCompras(),
            'valor_total_venta' => $this->Ventas_model-> valorTotalVentas(),
            'valor_items_venta' => $this->Ventas_model-> valorTotalItemsVentas(),
            'valor_items_compra' => $this->Compras_model-> valorTotalItemsCompras(),
            

        );
       
      
         $this->loadView("Dashboard", "Dashboard", $data);
    }
}
