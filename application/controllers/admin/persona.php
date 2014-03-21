<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class persona extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();        
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index()
    {        
        if((int)$_SESSION['sai_conf']['iglesia_id'] ==0){
            $_SESSION['error'] = "Por favor seleccione la Iglesia o contacte al Administrador";
            redirect("admin/app/index");
        }        
        $this->grocery_crud->where('iglesia_id',$_SESSION['sai_conf']['iglesia_id']);
        $this->grocery_crud->set_table('persona');
        $this->grocery_crud->display_as('miembro_tipo_id','Tipo miembro');
        $this->grocery_crud->set_relation('miembro_tipo_id','persona_tipo','nombre', array('borrado'=>0));
        $this->grocery_crud->columns('miembro_tipo_id','nombre','apellido_paterno','apellido_materno','nombre_alias','correo_electronico','telfono_fijo','telefono_movil');
        $this->grocery_crud->unset_delete();
        
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $output->iglesia_id = $_SESSION['sai_conf']['iglesia_id'];
        $this->layout->view('admin/catalogo/persona',$output);        
    }
}    
