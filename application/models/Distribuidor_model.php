<?php
class Distribuidor_model extends CI_Model
{

    public function getDistribuidores()
    {
        $this->db->where("estado", "1");
        $resultados = $this->db->get("distribuidor");
        return $resultados->result();
    }

    public function guardarDist($data)
    {
        return $this->db->insert("distribuidor", $data);
    }
    public function getDistribuidor($id_distribuidor)
    {
        $this->db->where("id_distribuidor", $id_distribuidor);
        $resultado = $this->db->get("distribuidor");
        return $resultado->row();
    }
    public function actualizar($id_distribuidor, $data)
    {
        $this->db->where("id_distribuidor", $id_distribuidor);
        return $this->db->update("distribuidor", $data);
    }
}
