<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class periodo_mensual extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->model('ofrenda_model'); 
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index($anual_id=0)
    {
        
        $anual_id = (int)$anual_id;
        $crud = new grocery_CRUD();
        if($anual_id > 0)$crud->where('periodo_anual_id',$anual_id);
        
        $crud->set_table('periodo_mensual');
        $crud->set_subject('Mensual');
        $crud->display_as('periodo_anual_id','Periodo Anual')->set_relation('periodo_anual_id','periodo_anual','codigo', array('borrado'=>0));
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_anual_id','periodo_estatus_tipo_id','codigo','nombre','fecha_inicial','fecha_final');
        $crud->add_action('Detalles del mes', base_url().'public/images/icons/folder_table.png', 'admin/periodo_semanal/index','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = ($anual_id > 0)? $this->ofrenda_model->path_mensual($anual_id) : "";
        $output->frm_titulo ="LISTADOS DE PERIODOS MENSUALES ";
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
}    
