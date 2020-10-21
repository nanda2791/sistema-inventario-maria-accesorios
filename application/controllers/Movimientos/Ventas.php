<?php

class Ventas extends BaseController
{

    function __construct()
    {

        parent::__construct();
        $this->load->model("Ventas_model");
    }

    public function index()
    {
        $data = array(
            'ventas' => $this->Ventas_model->getVentas(),
        );


        $this->loadView('Ventas', '/form/admin/ventas/list', $data);
    }

    public function add()
    {
        $data = array(
            "clientes" => $this->Clientes_model->getClientes(),
            "productos" => $this->Ventas_model->getProductosTodos(),
            "empleados" => $this->Empleado_model->getEmpleados(),
        );
        $this->loadView('Ventas', '/form/admin/ventas/add', $data);
    }
    public function getProductos()
    {
        $valor = $this->input->post("valor");
        $productos = $this->Ventas_model->getProductos($valor);
        echo json_encode($productos);
    }
   
    public function guardar()
    {
        $id_clientes = $this->input->post('id_clientes');
        $idusuario = $this->session->userdata('id_usuarios');
        $id_empleados = $this->input->post('id_empleados');
        $fecha = $this->input->post('fecha');
        $estado_venta = $this->input->post('estado_venta');
        $descuento = $this->input->post('descuento');
        $adelanto = $this->input->post('adelanto');
        $saldo = $this->input->post('saldo');
        $total_venta = $this->input->post('total_venta');
        
      //detalle venta
        $id_productos = $this->input->post('id_productos');
        $precio_unitario = $this->input->post('precio_unitario');
        $cantidad = $this->input->post('cantidad');
        $total = $this->input->post('total');
        $observaciones = $this->input->post('observaciones');

       
        $this->form_validation->set_rules('id_clientes', 'id_clientes', 'required');
        $this->form_validation->set_rules('id_empleados', 'id_empleados', 'required');



        if ($this->form_validation->run()) {
            //Se obtione el id de los datos de la empresa que este en vigencia.
            $datosEmpresa = $this->Empresa_model->getEmpresa();
            if (isset($datosEmpresa)) {
                $id_empresa = $datosEmpresa->id_empresa;
                $data = array(
                    'id_usuarios' => $idusuario,
                    'id_clientes' => $id_clientes,
                    'id_empresa' => $id_empresa,
                    'id_empleados' => $id_empleados,
                    'fecha' => $fecha,
                    'estado_venta' =>$estado_venta,
                    'adelanto' => $adelanto,
                    'descuento' => $descuento,
                    'saldo' => $saldo,
                    'total_venta' => $total_venta,
                    'estado' => '1',
                );

                if ($this->Ventas_model->guardarVentas($data)) {

                    $idVenta = $this->Ventas_model->ultimoID();
                    $this->guardar_detalle($id_productos, $idVenta, $precio_unitario, $cantidad, $total, $observaciones);
                    redirect(base_url() . 'Movimientos/ventas');
                } else {
                    redirect(base_url() . 'Movimientos/ventas/add');
                }
            } else {
                $this->session->set_flashdata('error', 'Tiene que configurar los datos de la empresa primero!');
                redirect(base_url() . 'Movimientos/ventas/add');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(base_url() . 'Movimientos/ventas/add');
        }
    }
    
    
    protected function guardar_detalle($id_productos, $idVenta, $precio_unitario, $cantidad, $total, $observaciones)
    {
        for ($i = 0; $i < count($id_productos); $i++) {
            $data = array(
                'id_ventas' => $idVenta,
                'id_productos' => $id_productos[$i],
                'precio_unitario' => $precio_unitario[$i],
                'cantidad' => $cantidad[$i],
                'total' => $total[$i],
                'observaciones' => $observaciones[$i],
            );
            $this->Ventas_model->guardar_detalle($data);
            $this->actualizarProducto($id_productos[$i], $cantidad[$i]);
        }
    }

    public function editar($id_ventas)
    {
        $data = array(
            
            "clientes" => $this->Clientes_model->getClientes(),
            "productos" => $this->Ventas_model->getProductosTodos(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "venta" => $this->Ventas_model->getVenta($id_ventas),
            "detalle_ventas" => $this->Ventas_model->getDetalle($id_ventas),
        );
        $this->loadView('Ventas', '/form/admin/ventas/editar', $data);
    }
    public function actualizar()
    {
        $idVenta = $this->input->post('id_ventas');
        $id_clientes = $this->input->post('id_clientes');
        $idusuario = $this->session->userdata('id_usuarios');
        $id_empleados = $this->input->post('id_empleados');
        $fecha = $this->input->post('fecha');
        $estado_venta = $this->input->post('estado_venta');
        $descuento = $this->input->post('descuento');
        $adelanto = $this->input->post('adelanto');
        $saldo = $this->input->post('saldo');
        $total_venta = $this->input->post('total_venta');
        
      //detalle venta
        $id_productos = $this->input->post('id_productos');
        $precio_unitario = $this->input->post('precio_unitario');
        $cantidad = $this->input->post('cantidad');
        $total = $this->input->post('total');
        $observaciones = $this->input->post('observaciones');

       
        $this->form_validation->set_rules('id_clientes', 'id_clientes', 'required');
        $this->form_validation->set_rules('id_empleados', 'id_empleados', 'required');



        if ($this->form_validation->run()) {
            //Se obtione el id de los datos de la empresa que este en vigencia.
            $datosEmpresa = $this->Empresa_model->getEmpresa();
            if (isset($datosEmpresa)) {
                $id_empresa = $datosEmpresa->id_empresa;
            $data = array(

                'id_usuarios' => $idusuario,
                    'id_clientes' => $id_clientes,
                    'id_empresa' => $id_empresa,
                    'id_empleados' => $id_empleados,
                    'fecha' => $fecha,
                    'estado_venta' =>$estado_venta,
                    'adelanto' => $adelanto,
                    'descuento' => $descuento,
                    'saldo' => $saldo,
                    'total_venta' => $total_venta,
                    'estado' => '1',
            );

            if ($this->Ventas_model->actualizarVentas($idVenta, $data)) {

                $this->borrar_detalle($idVenta);
                $this->guardar_detalle($id_productos, $idVenta, $precio_unitario, $cantidad, $total, $observaciones);
                redirect(base_url() . 'Movimientos/ventas');
            } else {
                redirect(base_url() . 'Movimientos/Ventas/editar');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que configurar los datos de la empresa primero!');
            redirect(base_url() . 'Movimientos/ventas/editar');
        }
    } else {
        $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
        redirect(base_url() . 'Movimientos/ventas/editar');
    }
}
          
    protected function borrar_detalle($idVenta)
    {
        $detalle_actual = $this->Ventas_model->getDetalle($idVenta);
        foreach ($detalle_actual as $detalle) {
            $this->reponerProducto($detalle->id_productos, $detalle->cantidad);
           
        }
        $this->Ventas_model->borrar_detalle_completo($detalle->id_detalle_ventas);
    }
    protected function reponerProducto($id_producto, $cantidad)
    {
        $productoActual = $this->Productos_model->getProducto($id_producto);
        $data = array(
            'stock' => $productoActual->stock + $cantidad,
        );
        $this->Productos_model->actualizar($id_producto, $data);
    }
   
    
    protected function actualizarProducto($id_producto, $cantidad)
    {
        $productoActual = $this->Productos_model->getProducto($id_producto);
        $data = array(
            'stock' => $productoActual->stock - $cantidad,
        );
        $this->Productos_model->actualizar($id_producto, $data);
    }
    
   
    public function vista()
    {
        $id_venta = $this->input->post('id');
        $data = array(
            "venta" => $this->Ventas_model->getVenta($id_venta),
            "detalles" => $this->Ventas_model->getDetalle($id_venta),
            'Configuracion' => $this->Empresa_model->getEmpresa(),
            'encargado' => $this->Ventas_model->getEncargado($id_venta),
        );
        $this->load->view('form/admin/ventas/view', $data);
    }
}
