<?php
class Productos_model extends CI_Model
{

    public function getProductos()
    {
        $this->db->select("p.*, c.nombre as categoria");
        $this->db->from("productos p");
        $this->db->join("categorias c", "p.id_categorias = c.id_categorias");
        $this->db->where("p.estado", "1");
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function guardarProd($data)
    {
        return $this->db->insert("productos", $data);
    }
    public function getProducto($id_producto)
    {
        $this->db->select("p.*, c.nombre as categoria");
        $this->db->from("productos p");
        $this->db->join("categorias c", "p.id_categorias = c.id_categorias");
        $this->db->where("p.id_productos", $id_producto);
        $resultado = $this->db->get();
        return $resultado->row();
    }
    public function actualizar($id_producto, $data)
    {
        $this->db->where("id_productos", $id_producto);
        return $this->db->update("productos", $data);
    }
    public function valorInventario()
    {
        $this->db->select(' sum(stock) as items_almacen');
        $this->db->where('estado','1');
        return $this->db->get('productos')->row_array();
    }
    public function promedioProducto($id_producto)
    {
        $this->db->select("id_productos, avg(precio_unitario) as Precio_promedio");
        $this->db->from("detalle_compra");
        $this->db->where("id_productos", $id_producto);
        $this->db->group_by('id_productos');
        return $this->db->get()->row();
    }
}
