<?php
class Compras_model extends CI_Model
{
    //Totas estas funciones son de Ventas
    public function getCompras()
    {
        $this->db->select('c.*');
        $this->db->from('compras c');
        $this->db->where('c.estado','1');
        $resultado = $this->db->get()->result_array();

        if (count($resultado) > 0) {
            return $resultado;
        } else {
            return false;
        }
    }
    
    public function getProductos($valor)
    {
        $this->db->select("id_productos, codigo, nombre as label");
        $this->db->from("productos");
        $this->db->like("nombre", $valor);

        $resultado = $this->db->get();
        return $resultado->result_array();
    }
    public function getProducto($id_productos)
    {
        $this->db->select("p.*, c.nombre as categoria");
        $this->db->from("productos p");
        $this->db->join("categorias c", "p.id_categorias = c.id_categorias");
        $this->db->where("p.id_productos", $id_productos);
        $resultado = $this->db->get();
        return $resultado->row();
    }
    public function getProductosTodos()
    {
        $this->db->select('p.*, c.nombre as categoria');
        $this->db->from('productos p');
        $this->db->join('categorias c', 'c.id_categorias = p.id_categorias');
        $this->db->where('p.estado', '1');
        return $this->db->get()->result();
    }
    
    public function actualizar($id_producto, $data)
    {
        $this->db->where("id_productos", $id_producto);
        return $this->db->update("detalle_compra", $data);
    }
     
    public function guardarCompras($data)
    {
        return $this->db->insert('compras', $data);
    }
  
    public function ultimoID()
    {
        return $this->db->insert_id();
    }
  
    public function guardar_detalle($data)
    {
        $this->db->insert('detalle_compra', $data);
    }
   
    public function getCompra($id)
    {
        $this->db->select('c.*,e.nombre as nombre_empleado, e.apellidos as apellidos_empleado');
        $this->db->from('compras c');
        $this->db->join('empleados e', 'c.id_empleados = e.id_empleados');
        $this->db->where("c.id_compras", $id);
        $resultado = $this->db->get();
        return $resultado->row();
    }
    public function getDetalle($id)
    {
        $this->db->select('dt.*, p.codigo, p.nombre, p.marca');
        $this->db->from('detalle_compra dt');
        $this->db->join('productos p', 'dt.id_productos=p.id_productos');
        $this->db->where("dt.id_compras", $id);
        $resultados = $this->db->get();
        return $resultados->result();
    }
    public function actualizarCompras($id_compras, $data)
    {
        $this->db->where('id_compras', $id_compras);
        return $this->db->update('compras', $data);
    }
    public function borrar_detalle($id_detalle_compra)
    {
        $this->db->where('id_detalle_compra', $id_detalle_compra);
        $this->db->delete('detalle_compra');
    }
    public function valorTotalCompras()
    {
        $this->db->select(' sum(total_compra) as total_compras');
        $this->db->where('estado','1');
        return $this->db->get('compras')->row_array();
    }
    public function valorTotalItemsCompras()
    {
        $this->db->select(' sum(stock) as items_compras');
        return $this->db->get('detalle_compra')->row_array();
    }
   
}
