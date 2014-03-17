<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ofrenda extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->model('ofrenda_model'); 
        $this->load->library('grocery_CRUD'); 
    }
    
    function index(){
        $this->anual();
    }
    
    public function anual()
    {
        
        $crud = new grocery_CRUD();
        $crud->set_table('periodo_anual');
        $crud->set_subject('Anual');
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_estatus_tipo_id','codigo','nombre','descripcion','fecha_inicial','fecha_final');
        $crud->add_action('Detalles del año', base_url().'public/images/icons/folder_table.png', 'admin/ofrenda/mensual','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = $this->ofrenda_model->path_anual();
        $output->frm_titulo ="LISTADO DE PERIODOS ANUALES ";
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
    
    public function mensual($anual_id=0)
    {
        $anual_id = (int)$anual_id;
        $crud = new grocery_CRUD();
        $crud->where('periodo_anual_id',(int)$anual_id);
        
        $crud->set_table('periodo_mensual');
        $crud->set_subject('Mensual');
        $crud->display_as('periodo_anual_id','Periodo Anual')->set_relation('periodo_anual_id','periodo_anual','codigo', array('borrado'=>0));
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_anual_id','periodo_estatus_tipo_id','codigo','nombre','fecha_inicial','fecha_final');
        $crud->add_action('Detalles del mes', base_url().'public/images/icons/folder_table.png', 'admin/ofrenda/semanal','btn-detalle');
        $output = $crud->render();        
        $output->path_navegador = $this->ofrenda_model->path_mensual($anual_id);
        $output->frm_titulo ="LISTADOS DE PERIODOS MENSUALES ";
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
    
    public function semanal($mensual_id=0)
    {
        $mensual_id = (int)$mensual_id;
        $crud = new grocery_CRUD();
        $crud->where('periodo_mensual_id',(int)$mensual_id);
        $crud->set_table('periodo_semanal');
        $crud->set_subject('Semanal');
        $crud->display_as('periodo_mensual_id','Periodo Mensual')->set_relation('periodo_mensual_id','periodo_mensual','nombre', array('borrado'=>0));
        $crud->display_as('periodo_estatus_tipo_id','Estatus')->set_relation('periodo_estatus_tipo_id','periodo_estatus_tipo','nombre', array('borrado'=>0));
        $crud->columns('periodo_mensual_id','periodo_estatus_tipo_id','codigo','nombre','fecha_inicial','fecha_final');
        $crud->add_action('Gastos de la semana', base_url().'public/images/icons/money_delete.png', 'admin/ofrenda/recibo/2','btn-detalle');
        $crud->add_action('Ofrendas de la semana', base_url().'public/images/icons/coins_add.png', 'admin/ofrenda/recibo/1','btn-detalle');
        
        
        
        $output = $crud->render();        
        $output->path_navegador = $this->ofrenda_model->path_semanal($mensual_id);
        $output->frm_titulo ="LISTADO DE PERIODOS SEMANALES ";
        $this->layout->view('admin/ofrenda/anual',$output);          
    }
    
    
    function recibo($recibo_tipo_id=0,$semanal_id=0){
        
        $crud = new grocery_CRUD();
        if($recibo_tipo_id==0 ) $recibo_tipo_id = 1;
        $controller = "recibo_ofrenda";
        if($recibo_tipo_id ==2 ) $controller ="recibo_gasto";
        $tipo = $this->ofrenda_model->get_recibo_tipo($recibo_tipo_id);
        $crud->where('periodo_semanal_id',(int)$semanal_id);
        $crud->where('recibo_tipo_id',$recibo_tipo_id);
        $crud->set_table('recibo');
        $crud->set_subject(' '.$tipo['nombre']);
        //$crud->display_as('iglesia_id','Iglesia');        $crud->set_relation('iglesia_id','iglesia','nombre', array('borrado'=>0));
        $crud->display_as('persona_id','Persona');
        $crud->set_relation('persona_id','persona',"{nombre} {apellido_paterno} {apellido_materno}", array('borrado'=>0));
        //$crud->display_as('persona_id','Persona');
        
        $crud->columns('fecha','recibo_numero','persona_id','descripcion','monto_efectivo','monto_cheque','monto_banco','monto_cambio');
        $crud->fields('iglesia_id','periodo_semanal_id','recibo_tipo_id','fecha','recibo_numero','persona_id','descripcion','monto_efectivo','monto_cheque','monto_banco','monto_cambio');
        
        $crud->unset_delete();
        $crud->unset_edit();
        $crud->unset_read();
        $crud->add_action('Editar Recibo', base_url().'public/images/icons/pencil.png', 'admin/'.$controller.'/update','btn-detalle');
        //$crud->add_action('Detalles del recibo', base_url().'public/images/icons/folder_table.png', 'admin/ofrenda/recibo_detalle','btn-detalle');
        
                
        $output = $crud->render();  
        $output->iglesia_id =1;
        $output->semanal_id =$semanal_id;
        $output->recibo_tipo_id =$recibo_tipo_id;
        $output->controller = $controller; 
        $output->frm_titulo ="RECIBO DE ".$tipo['nombre'];
        
                
        $output->path_navegador = $this->ofrenda_model->path_recibo($semanal_id,$recibo_tipo_id);
        $this->layout->view('admin/ofrenda/recibo',$output); 
    }
    
    
    public function recibo_detalle($recibo_id = 0)
    {   
        $crud = new grocery_CRUD();
                  
        $recibo_id = (int)$recibo_id;
        $recibo = $this->ofrenda_model->get_recibo($recibo_id);
        $tipo = $this->ofrenda_model->get_recibo_tipo($recibo['recibo_tipo_id']);
        
        $crud->where('recibo_id',$recibo_id);        
        $crud->set_table('recibo_detalle');
        
        $crud->set_subject('Detalle del Recibo');
        $crud->display_as('ofrenda_tipo_id','Tipo Ofrenda');
        $crud->set_relation('ofrenda_tipo_id','ofrenda_tipo','nombre', array('borrado'=>0));
        
        $crud->display_as('gasto_tipo_id','Tipo Gasto');
        $crud->set_relation('gasto_tipo_id','gasto_tipo','nombre', array('borrado'=>0));
        
        $crud->display_as('iglesia_departmento_id','Departamento');
        $crud->set_relation('iglesia_departmento_id','iglesia_departamento','nombre', array('borrado'=>0));
        
        if($tipo['id']==1){
            $crud->columns('fecha','ofrenda_tipo_id','monto','comentario');
            $crud->fields('recibo_id','fecha','ofrenda_tipo_id','monto','comentario');
        }else if($tipo['id']==2){
            $crud->columns('fecha','gasto_tipo_id','iglesia_departmento_id','monto','comentario');
            $crud->fields('recibo_id','fecha','gasto_tipo_id','iglesia_departmento_id','monto','comentario');
        }
        
        $crud->callback_before_insert(array($this,'completar_recibo_detalle'));
        
        $output = $crud->render();  
        $output->recibo_id = $recibo_id;
        $output->frm_titulo ="DETALLE DEL RECIBO DE ".$tipo['nombre'];
        
        $output->path_navegador = $this->ofrenda_model->path_recibo_detalle($recibo_id);
        
        $this->layout->view('admin/ofrenda/recibo_detalle',$output);          
    }
    
    
    
}    
