<?php

class Compras extends BaseController
{

    function __construct()
    {

        parent::__construct();
        $this->load->model("Compras_model");
    }

    public function index()
    {
        $data = array(
            'compras' => $this->Compras_model->getCompras(),
        );


        $this->loadView('Compra', '/form/admin/compras/list', $data);
    }

    public function add()
    {
        $data = array(
            "productos" => $this->Compras_model->getProductosTodos(),
            "empleados" => $this->Empleado_model->getEmpleados(),
        );
        $this->loadView('Compra', '/form/admin/compras/add', $data);
    }
    public function getProductos()
    {
        $valor = $this->input->post("valor");
        $productos = $this->Compras_model->getProductos($valor);
        echo json_encode($productos);
    }
    public function getProductosCodigo()
    {
        $valor = $this->input->post("valor");
        $productos = $this->Ventas_model->getProductosCodigo($valor);
        echo json_encode($productos);
    }
    public function guardar()
    {
        $id_empleados = $this->input->post('id_empleados');
        $id_usuario = $this->session->userdata('id_usuarios');
        $estado_producto = $this->input->post('estado_producto');
        $fecha = $this->input->post('fecha');
        $precio_transportadora = $this->input->post('precio_transportadora');
        $iva_total = $this->input->post('iva_total');
        $total_compra = $this->input->post('total_compra');
        //detalle
        $id_productos = $this->input->post('id_productos');
        $precio_origen = $this->input->post('precio_origen');
        $transporte = $this->input->post('transporte');
        $iva = $this->input->post('iva');
        $stock = $this->input->post('stock');
        $precio_unitario = $this->input->post('precio_unitario');
        $total = $this->input->post('total');
        $observaciones = $this->input->post('observaciones');


        $this->form_validation->set_rules('id_empleados', 'id_empleados', 'required');

        if ($this->form_validation->run()) {
            //Se obtione el id de los datos de la empresa que este en vigencia.
            $datosEmpresa = $this->Empresa_model->getEmpresa();
            if (isset($datosEmpresa)) {
                $id_empresa = $datosEmpresa->id_empresa;
                $data = array(
                    'id_empresa' => $id_empresa,
                    'id_empleados' => $id_empleados,
                    'id_usuarios' => $id_usuario,
                    'fecha' => $fecha,
                    'precio_transportadora' => $precio_transportadora,
                    'iva_total' => $iva_total,
                    'estado_producto' => $estado_producto,
                    'total_compra' => $total_compra,
                    'estado' => '1',
                );

                if ($this->Compras_model->guardarCompras($data)) {

                    $idCompra = $this->Compras_model->ultimoID();
                    $this->guardar_detalle($id_productos, $idCompra, $precio_origen, $transporte, $iva, $stock, $precio_unitario, $total, $observaciones);

                    redirect(base_url() . 'Movimientos/Compras');
                } else {
                    redirect(base_url() . 'Movimientos/Compras/add');
                }
            } else {
                $this->session->set_flashdata('error', 'Tiene que configurar los datos de la empresa primero!');
                redirect(base_url() . 'Movimientos/Compras/add');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(base_url() . 'Movimientos/Compras/add');
        }
    }
    public function editar($id_compras)
    {
        $data = array(

            "productos" => $this->Compras_model->getProductosTodos(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "compra" => $this->Compras_model->getCompra($id_compras),
            "detalle_compra" => $this->Compras_model->getDetalle($id_compras),
        );
        $this->loadView('Compra', '/form/admin/compras/editar', $data);
    }
    public function actualizar()
    {
        $idCompra = $this->input->post('id_compras');
        $id_empleados = $this->input->post('id_empleados');
        $id_usuario = $this->session->userdata('id_usuarios');
        $estado_producto = $this->input->post('estado_producto');
        $fecha = $this->input->post('fecha');
        $precio_transportadora = $this->input->post('precio_transportadora');
        $iva_total = $this->input->post('iva_total');
        $total_compra = $this->input->post('total_compra');
        //detalle
        $id_productos = $this->input->post('id_productos');
        $precio_origen = $this->input->post('precio_origen');
        $transporte = $this->input->post('transporte');
        $stock = $this->input->post('stock');
        $iva = $this->input->post('iva');
        $precio_unitario = $this->input->post('precio_unitario');
        $total = $this->input->post('total');
        $observaciones = $this->input->post('observaciones');



        $this->form_validation->set_rules('id_empleados', 'id_empleados', 'required');



        if ($this->form_validation->run()) {




            $data = array(

                'id_empleados' => $id_empleados,
                'id_usuarios' => $id_usuario,
                'fecha' => $fecha,
                'precio_transportadora' => $precio_transportadora,
                'iva_total' => $iva_total,
                'estado_producto' => $estado_producto,
                'total_compra' => $total_compra,
                'estado' => '1',
            );

            if ($this->Compras_model->actualizarCompras($idCompra, $data)) {
                $this->borrar_detalle($idCompra);
                $this->guardar_detalle($id_productos, $idCompra, $precio_origen, $transporte, $iva, $stock, $precio_unitario, $total, $observaciones);
              
                    
                redirect(base_url() . 'Movimientos/Compras');
            } else {
                redirect(base_url() . 'Movimientos/Compras/editar/' + $idCompra);
            }
        }
    }


    protected function borrar_detalle($idCompra)
    {
        $detalle_actual = $this->Ventas_model->getDetalle($idCompra);
        foreach ($detalle_actual as $detalle) {
            $this->actualizarProducto($detalle->id_productos, $detalle->stock);
           
        }
        $this->Ventas_model->borrar_detalle_completo($detalle->id_detalle_ventas);
    }
    protected function reponerProducto($id_producto, $stock)
    {
        $productoActual = $this->Productos_model->getProducto($id_producto); 
        $data = array(
            'stock' => $productoActual->stock + $stock,
           
        );
        $this->Productos_model->actualizar($id_producto, $data);
    }
   
    
    protected function actualizarProducto($id_producto, $stock)
    {
        $productoActual = $this->Productos_model->getProducto($id_producto);
  
        $data = array(
            'stock' => $productoActual->stock - $stock,
        );
        $this->Productos_model->actualizar($id_producto, $data);
    }
  
    
    

    protected function guardar_detalle($id_productos, $idCompra, $precio_origen, $transporte, $iva, $stock, $precio_unitario, $total, $observaciones)
    {
        for ($i = 0; $i < count($id_productos); $i++) {
            $data = array(
                'id_productos' => $id_productos[$i],
                'id_compras' => $idCompra,
                'precio_origen' => $precio_origen[$i],
                'transporte' => $transporte[$i],
                'iva' => $iva[$i],
                'stock' => $stock[$i],
                'precio_unitario' => $precio_unitario[$i],
                'total' => $total[$i],
                'observaciones' => $observaciones[$i],

            );
            $this->Compras_model->guardar_detalle($data);
            $this->reponerProducto($id_productos[$i], $stock[$i]);
          
        }
    }
}
