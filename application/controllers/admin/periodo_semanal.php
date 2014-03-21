<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class periodo_semanal extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->model('ofrenda_model'); 
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index($mensual_id=0)
    {
        if((int)$_SESSION['sai_conf']['iglesia_id'] ==0){
            $_SESSION['error'] = "Por favor seleccione la Iglesia o contacte al administrador";
            redirect("admin/app/index");
        }
        
        $mensual_id = (int)$mensual_id;
        if($mensual_id ==0 ) $mensual_id = $_SESSION['sai_conf']['periodo_mensual_id'];
        $crud = new grocery_CRUD();
        if($mensual_id) $crud->where('periodo_mensual_id',(int)$mensual_id);
        $crud->where('periodo_semanal.iglesia_id',$_SESSION['sai_conf']['iglesia_id']);
        $crud->set_table('periodo_semanal');
        $crud->set_subject('Semanal');
        $crud->display_as('periodo_mensual_id','Periodo Mensual')->set_relation('periodo_mensual_id','periodo_mensual','nombre', array('borrado'=>0,'periodo_mensual.iglesia_id'=>$_SESSION['sai_conf']['iglesia_id']));
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_mensual_id','periodo_estatus_tipo_id','codigo','nombre','fecha_inicial','fecha_final');
        $crud->unset_delete();
        $crud->unset_read();
        $crud->add_action('Gastos de la semana', base_url().'public/images/icons/money_delete.png', 'admin/recibo_gasto/index','btn-detalle');
        $crud->add_action('Ofrendas de la semana', base_url().'public/images/icons/coins_add.png', 'admin/recibo_ofrenda/index','btn-detalle');
                
        $output = $crud->render();
        $output->path_navegador = ($mensual_id)? $this->ofrenda_model->path_semanal($mensual_id) : "";
        $output->frm_titulo ="LISTADO DE PERIODOS SEMANALES ";
        
        $output->iglesia_id = $_SESSION['sai_conf']['iglesia_id'];
        $output->periodo_mensual_id = $mensual_id;
        
        $this->layout->view('admin/ofrenda/semanal',$output);           
    }
}    
