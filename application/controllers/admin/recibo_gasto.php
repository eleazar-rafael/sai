<?php
class recibo_gasto extends Admin_Controller {
    var $list="recibo";
    var $recibo_tipo_id;
    var $controller;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('ofrenda_model'); 
        $this->load->model('ofrenda_tipo_model'); 
        $this->load->model('recibo_model'); 
        $this->load->model('recibo_detalle_model'); 
        $this->load->model('persona_model'); 
        $this->load->model('gasto_tipo_model');
        $this->load->model('iglesia_departamento_model');
        
        $this->recibo_tipo_id = RECIBO_GASTOS;
        $this->controller = "recibo_gasto";
    }
    
    public function index($semanal_id=0){
        
        if((int)$_SESSION['sai_conf']['iglesia_id'] ==0){
            $_SESSION['error'] = "Por favor seleccione la Iglesia o contacte al Administrador";
            redirect("admin/app/index");
        }
        
        $this->load->library('grocery_CRUD');        
        $crud = new grocery_CRUD();
        
        $recibo_tipo_id = (int)$this->recibo_tipo_id;
        $semanal_id = (int)$semanal_id;
        if($semanal_id == 0) $semanal_id = (int)$_SESSION['sai_conf']['periodo_semanal_id'];
        if($recibo_tipo_id==0 ) $recibo_tipo_id = 1;
        $controller = "recibo_ofrenda";
        if($recibo_tipo_id ==2 ) $controller ="recibo_gasto";
        
        $tipo = $this->ofrenda_model->get_recibo_tipo($recibo_tipo_id);
        $crud->where('recibo.iglesia_id',$_SESSION['sai_conf']['iglesia_id']);
        
        if($semanal_id > 0) $crud->where('periodo_semanal_id',$semanal_id);
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
        
                
        $output->path_navegador = ($semanal_id > 0)? $this->ofrenda_model->path_recibo($semanal_id,$recibo_tipo_id) : "";
        $this->layout->view('admin/ofrenda/recibo',$output);             
    }

    public function insert($page=0){
        set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) {
            $recibo = $this->input->post('recibo');   
            $recibo['monto_efectivo'] = str_replace(",", "", $recibo['monto_efectivo']);
            $recibo['monto_cheque'] = str_replace(",", "", $recibo['monto_cheque']);
            //$recibo['usuario_id']=$this->data['arrUser']['id'];
            
            $recibo_id = $this->recibo_model->insert( $recibo );
            $this->check_recibo_detalle($recibo_id);
            if( (int)$recibo_id > 0 ) 
                $_SESSION['success'] = "Recibo Agregado";
            else
                $_SESSION['error'] = "Error al crear recibo";
                        
            //redirect("admin/ofrenda/recibo/".(int)$recibo['recibo_tipo_id']."/".(int)$recibo['periodo_semanal_id']);
            redirect("admin/".$this->controller."/index/".(int)$recibo['periodo_semanal_id']);
        }

        $this->get_form();
    }

    public function update(){ //$page=0
        //set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) {
            $recibo = $this->input->post('recibo');  
            $this->recibo_model->update($recibo);
            
            $_SESSION['success'] = "Recibo Editado";

            //$page = get_page($this->list);            
            //redirect("admin/recibo/index/$page/");
            //redirect("admin/ofrenda/recibo");
            $recibo = $this->recibo_model->get_data( $recibo['id'] );
            redirect("admin/".$this->controller."/index/".(int)$recibo['periodo_semanal_id']);
        }

        $this->get_form();
    }
    
    private function check_recibo_detalle($recibo_id=0){
        $recibo_id = (int)$recibo_id;
        
        $recibo = $this->input->post('recibo');
        $detalle_id = $this->input->post('detalle_id');
        $detalle_ofrenda_tipo_id = $this->input->post('detalle_ofrenda_tipo_id');
        $detalle_gasto_tipo_id = $this->input->post('detalle_gasto_tipo_id');
        $detalle_iglesia_departmento_id = $this->input->post('detalle_iglesia_departmento_id');
        $detalle_monto = $this->input->post('detalle_monto');
        $detalle_borrar = $this->input->post('detalle_borrar');
        
        if( $recibo_id > 0 and $detalle_id){
            
            foreach($detalle_id as $pos => $id){
                $recibo_detalle = null;
                $recibo_detalle['iglesia_id'] = $recibo['iglesia_id'];
                $recibo_detalle['fecha'] = $recibo['fecha'];
                
                $recibo_detalle['recibo_id'] = $recibo_id;
                
                if($recibo['recibo_tipo_id']==1){
                    $recibo_detalle['ofrenda_tipo_id'] = $detalle_ofrenda_tipo_id[$pos];
                }elseif($recibo['recibo_tipo_id']==2){
                    $recibo_detalle['gasto_tipo_id'] = $detalle_gasto_tipo_id[$pos];
                    $recibo_detalle['iglesia_departmento_id'] = $detalle_iglesia_departmento_id[$pos];
                }
                
                $recibo_detalle['monto'] = (double)str_replace(",", "", $detalle_monto[$pos]);
                if($id > 0) $borrar = isset($detalle_borrar[$id])? (int)$detalle_borrar[$id] : 0; 
                    
                if( (int)$id == 0 and $recibo_detalle['monto'] > 0){ //Agregar
                    $this->recibo_detalle_model->insert($recibo_detalle);
                }else if($borrar == 1){ //Borrar
                    $this->recibo_detalle_model->delete($id);
                }else if( (int)$id > 0 ){ //Editar
                    $recibo_detalle['id'] = $id;
                    $this->recibo_detalle_model->update($recibo_detalle);
                }
            }
        
        }
        
    }
    
    public function delete(){
            
        $resp = $this->recibo_model->delete( $this->input->get('id') );
        if((int)$resp >0)
            $_SESSION['success'] = "Se borr&oacute; un registro de recibo";
        else
            $_SESSION['error'] = "Cuidado: el registro no existe o se gener&oacute; un error";   
        redirect("admin/".$this->controller."/index");        
    }
    
    public function get_form(){
       
        $page = get_page($this->list);             
        
        $id = (int)$this->uri->segment(4);
        
        $this->data['recibo'] = $this->recibo_model->get_data( $id ); //$this->input->get('id')
        $id = isset($this->data['recibo']['id'])? (int)$this->data['recibo']['id'] : 0;
        $this->data['recibo_detalle'] = $this->recibo_detalle_model->get_data_list( $id );        
        
                
        if($id == 0){            
            $semanal_id =  $this->input->get('periodo_semanal_id');
            if((int)$semanal_id == 0){
                $_SESSION['error'] = "Por favor seleccione el periodo semanal o contacte al Administrador";
                redirect("admin/app/index");
            }
            $this->data['recibo']['fecha'] = date("Y-m-d");
            $this->data['recibo']['recibo_tipo_id'] = $this->recibo_tipo_id; //$this->input->get('recibo_tipo_id');
            $this->data['recibo']['periodo_semanal_id'] = $this->input->get('periodo_semanal_id');
            
            $this->data['heading_title'] = "Creando Nuevo Recibo de ";   
            
            $this->data['action'] = "admin/".$this->controller."/insert/$page/";
        }else{            
            $this->data['heading_title'] = "Actualizando Recibo de ";   
            $this->data['action'] = "admin/".$this->controller."/update/$page/?id=$id";
        }
        
        if($this->data['recibo']['recibo_tipo_id']==1) $this->data['heading_title'] .=" Ofrenda";
        if($this->data['recibo']['recibo_tipo_id']==2) $this->data['heading_title'] .=" Gasto";      
        
        $this->data['controller'] = $this->controller;        
        //$this->data['cancel']   = "admin/ofrenda/recibo/".(int)$this->data['recibo']['recibo_tipo_id']."/".(int)$this->data['recibo']['periodo_semanal_id'];
        $this->data['cancel']   = "admin/".$this->controller."/index/".(int)$this->data['recibo']['periodo_semanal_id'];
        $this->data['cbo_persona'] = $this->persona_model->cbo_persona("--Seleccione--",$_SESSION['sai_conf']['iglesia_id']);
        $this->data['cbo_ofrenda_tipo'] = $this->ofrenda_tipo_model->cbo_ofrenda_tipo("--Seleccione--");
        $this->data['cbo_gasto_tipo'] = $this->gasto_tipo_model->cbo_gasto_tipo("--Seleccione--");        
        $this->data['cbo_iglesia_departamento'] = $this->iglesia_departamento_model->cbo_iglesia_departamento("--Seleccione--");
                
        $this->data['path_navegador'] = $this->ofrenda_model->path_recibo($this->data['recibo']['periodo_semanal_id'],$this->data['recibo']['recibo_tipo_id']);
                
        $this->layout->view('admin/recibo/form', $this->data );
    }

    private function validateForm(){
        return true;
    }

    private function validateDelete() {
        return true;
    }
    
    public function add_tr_detalle($recibo_tipo_id,$max_detalle){
        $tr['max_detalle'] = $max_detalle;
        if($recibo_tipo_id == 1){
            $tr['cbo_ofrenda_tipo'] = $this->ofrenda_tipo_model->cbo_ofrenda_tipo('--Seleccione--');
        }else if($recibo_tipo_id==2){
            $tr['cbo_gasto_tipo'] = $this->gasto_tipo_model->cbo_gasto_tipo("--Seleccione--");        
            $tr['cbo_iglesia_departamento'] = $this->iglesia_departamento_model->cbo_iglesia_departamento("--Seleccione--");        
        }
        $tr['detalle'] = array('recibo_tipo_id'=>$recibo_tipo_id);
        $this->load->view("admin/recibo/form_detalle",$tr);
    }
        
}


/*class recibo_gasto extends Recibo_Controller {
        
    public function __construct(){
        parent::__construct();        
        $this->recibo_tipo_id = RECIBO_GASTOS;
        $this->controller = "recibo_gasto";
    }
    function index($semanal_id=0) {
        parent::index($semanal_id);
    }

    function insert($page = 0) {
        parent::insert($page);
    }
    
    function update($page = 0) {
        parent::update($page);
    }
    
    public function add_tr_detalle($recibo_tipo_id, $max_detalle) {
        parent::add_tr_detalle($recibo_tipo_id, $max_detalle);
    }
}*/
