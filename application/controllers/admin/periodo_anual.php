<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class periodo_anual extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->model('ofrenda_model'); 
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index()
    {
        
        if((int)$_SESSION['sai_conf']['iglesia_id'] ==0){
            $_SESSION['error'] = "Por favor seleccione la Iglesia o contacte al Administrador";
            redirect("admin/app/index");
        }
        
        $crud = new grocery_CRUD();
        $crud->where('iglesia_id',$_SESSION['sai_conf']['iglesia_id']);
        $crud->set_table('periodo_anual');
        $crud->set_subject('Anual');
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_estatus_tipo_id','codigo','nombre','descripcion','fecha_inicial','fecha_final');
        $crud->unset_delete();
        $crud->unset_read();
        $crud->add_action('Detalles del a&ntilde;o', base_url().'public/images/icons/folder_table.png', 'admin/periodo_mensual/index','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = $this->ofrenda_model->path_anual();
        $output->frm_titulo ="LISTADO DE PERIODOS ANUALES ";
        $output->iglesia_id = $_SESSION['sai_conf']['iglesia_id'];
        
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
}    
