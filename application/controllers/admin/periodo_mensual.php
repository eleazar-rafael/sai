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
        if((int)$_SESSION['sai_conf']['iglesia_id'] ==0){
            $_SESSION['error'] = "Por favor seleccione la Iglesia o contacte al Administrador";
            redirect("admin/app/index");
        }
        
        $anual_id = (int)$anual_id;
        if($anual_id == 0) $anual_id = (int)$_SESSION['sai_conf']['periodo_anual_id'];
        $crud = new grocery_CRUD();
        
        $crud->where('periodo_mensual.iglesia_id',$_SESSION['sai_conf']['iglesia_id']);
        if($anual_id > 0)$crud->where('periodo_anual_id',$anual_id);
        
        $crud->set_table('periodo_mensual');
        $crud->set_subject('Mensual');
        $crud->display_as('periodo_anual_id','Periodo Anual')->set_relation('periodo_anual_id','periodo_anual','codigo', array('borrado'=>0,'periodo_anual.iglesia_id'=>$_SESSION['sai_conf']['iglesia_id'] ));
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_anual_id','periodo_estatus_tipo_id','codigo','nombre','fecha_inicial','fecha_final');
        $crud->unset_delete();
        $crud->unset_read();
        $crud->add_action('Detalles del mes', base_url().'public/images/icons/folder_table.png', 'admin/periodo_semanal/index','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = ($anual_id > 0)? $this->ofrenda_model->path_mensual($anual_id) : "";
        $output->frm_titulo ="LISTADOS DE PERIODOS MENSUALES ";
        
        $output->iglesia_id = $_SESSION['sai_conf']['iglesia_id'];
        $output->periodo_anual_id = $anual_id;
        $this->layout->view('admin/ofrenda/mensual',$output);          
    }
}    
