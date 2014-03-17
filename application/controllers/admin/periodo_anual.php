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
        
        $crud = new grocery_CRUD();
        $crud->set_table('periodo_anual');
        $crud->set_subject('Anual');
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_estatus_tipo_id','codigo','nombre','descripcion','fecha_inicial','fecha_final');
        $crud->add_action('Detalles del año', base_url().'public/images/icons/folder_table.png', 'admin/periodo_mensual/index','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = $this->ofrenda_model->path_anual();
        $output->frm_titulo ="LISTADO DE PERIODOS ANUALES ";
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
}    
