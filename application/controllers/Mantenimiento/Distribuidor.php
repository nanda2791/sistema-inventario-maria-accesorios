<?php

class Distribuidor extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'distribuidores' => $this->Distribuidor_model->getDistribuidores(),
        );

        $this->loadView('Distribuidor', '/form/admin/distribuidores/list', $data);
    }
    public function guardarDistribuidor()
    {
        $nombre = $this->input->post("nombre");
        $pagina_web = $this->input->post("pagina_web");
        $this->form_validation->set_rules("nombre", "Nombre", "required|is_unique[categorias.nombre]");
        if ($this->form_validation->run()) {


            $data = array(
                'nombre' => $nombre,
                'pagina_web' => $pagina_web,
                'estado' => "1"
            );

            if ($this->Distribuidor_model->guardarDist($data)) {
                redirect(base_url() . "Mantenimiento/distribuidor");
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar la informacion");
            }
        } else {
            $this->index();
        }

        echo $nombre . " " . $pagina_web;
    }
    public function editar($id_distribuidor)
    {

        $data = array(
            'distribuidor' => $this->Distribuidor_model->getDistribuidor($id_distribuidor),
        );
        $this->loadView('Distribuidor', '/form/admin/distribuidores/editar', $data);
    }
    public function actualizarDistribuidor()
    {
        $id_distribuidor = $this->input->post("id_distribuidor");
        $nombre = $this->input->post("nombre");
        $pagina_web = $this->input->post("pagina_web");
        $distribuidorActual=$this->Distribuidor_model->getDistribuidor($id_distribuidor);
        if ($nombre==$distribuidorActual->nombre) {
            $unique='';

        }
        else{
            $unique='|is_unique[distribuidor.nombre]';
        }

        $this->form_validation->set_rules("nombre", "Nombre", "required".$unique);
        if ($this->form_validation->run()) {

            $data = array(
                'nombre' => $nombre,
                'pagina_web' => $pagina_web,
                'estado' => "1"
            );
            if ($this->Distribuidor_model->actualizar($id_distribuidor, $data)) {
                redirect(base_url() . "Mantenimiento/distribuidor");
            } else {
                $this->session->set_flashdata("error", "No se pudo actualizar la informacion");
                redirect(base_url() . "Mantenimiento/distribuidores/editar" . $id_distribuidor);
            }
        }
        else {
            $this->editar($id_distribuidor);
        }

        
    }
    
    public function borrar($id_distribuidor)
    {
        $data = array(
            'estado' => "0",

        );
        $this->Distribuidor_model->actualizar($id_distribuidor, $data);
        echo "Mantenimiento/Distribuidor";
    }
}
