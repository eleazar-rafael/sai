<?php

class sis_perfil extends Admin_Controller{
    var $list= "sis_perfil";
    public function __construct()
    {
        parent::__construct();        
        $this->load->model("sis_perfil_model");
        $this->load->model("sis_accion_model");
        $this->load->model("sis_recurso_model");
    }
    
    public function index($page=0)
    {        
        if($_POST['filter']) set_filter ($this->list, $_POST['filter']);
        if($_GET['sort']) set_sort($this->list, $_GET['sort'], $_GET['order']);
        set_page($this->list,$page);
                
        $this->getlist();
    }
    
    public function insert($page=0)
    {     
        set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) { 
            $recursos = $this->input->post('sis_perfil');
            
            $id = $this->sis_perfil_model->insert( $recursos );            
            $this->sis_perfil_model->save_perfil_recurso($id);
            
            if( (int)$id > 0 )
                $_SESSION['success'] = "Perfil Agregado";                
            else
                $_SESSION['error'] = "Error al Crear Perfil";
          
            $page = get_page($this->list); 
            redirect("admin/sis_perfil/index/$page");
        }

        $this->getform();
        
    }
    
    public function update($page=0)
    {        
        set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) {  
            $perfil = $this->input->post('sis_perfil');
            //$recursos['acciones'] = $this->config_json_accion();
            $this->sis_perfil_model->update($perfil);
            $this->sis_perfil_model->save_perfil_recurso($perfil['id']);
            $_SESSION['success'] = "Perfil Editado";
            $page = get_page($this->list);            
            redirect("admin/sis_perfil/index/$page/");
        }
        $this->getform();        
    }
   
    
    public function delete($page=0)
    {        
        $resp = $this->sis_perfil_model->delete( $this->input->get('id') );
        if((int)$resp >0)
            $_SESSION['success'] = "Se borr&oacute; el registro solicitado";
        else
            $_SESSION['error'] = "Cuidado: el registro no existe o se gener&oacute; un error";   
        redirect("admin/sis_perfil/index/$page");   
    }
    
    function getlist(){
        $this->data['heading_title'] = "Listado de Perfiles ";
        //PAGE, SORT Y ORDER        
        $this->data['list'] =  $this->list;
        $this->data['page'] =  get_page($this->list);        
        $_sort= get_sort($this->list);   
        
        $this->data['sort'] = ( $_sort['sort'] )? $_sort['sort'] : 'id';
        $this->data['order'] = ($_sort['order'])? $_sort['order'] : 'ASC';
                
        //LINK PARA COLUMNAS
        $url_order = ( $this->data['order'] == 'ASC')? '&order=DESC': '&order=ASC';
        $pre_url = "admin/sis_perfil/index?";
        $this->data['sort_id']   = site_url($pre_url."sort=id").$url_order;
        $this->data['sort_nombre']   = site_url($pre_url."sort=nombre").$url_order;
                
        //DATOS PARA SELECCION DE FILTROS
            
        //PAGINACION
        $this->data['total'] = $total = $this->sis_perfil_model->get_total();
        $config = paginator_config($total,site_url("admin/sis_perfil/index"));
        $this->pagination->initialize( $config );
        $this->data['links'] = "<div class='pagination'>".$this->pagination->create_links()."</div>";
        $data = array('limit' => $config['per_page'],'start'=> (int)$this->data['page']);
        
        //DATOS A DESPLEGAR
        $this->data['arrInfo'] = $this->sis_perfil_model->get_data_list($data);
        
        $this->layout->view('admin/sis_perfil/index', $this->data);
    }
    
    function getform(){
        $page = get_page($this->list);             
        $this->data['heading_title'] ="Formulario de Perfil / ";
        $this->data['sis_perfil'] = $this->sis_perfil_model->get_data( $this->input->get('id') );        
        $this->data['sis_perfil_recurso'] =null;
        //$this->data['cbo_padre'] = $this->sis_perfil_model->cbo_recurso("-- Seleccione --",$this->data['sis_perfil']['id']);
        
        $id = isset($this->data['sis_perfil']['id'])? (int)$this->data['sis_perfil']['id'] : 0;
        if($id == 0){
            $this->data['action'] = "admin/sis_perfil/insert/$page/";
            $this->data['heading_title'] .= "Nuevo Registro";
        }else{
            $this->data['sis_perfil_recurso'] = $this->sis_perfil_model->get_recursos( $id );
            $this->data['action'] = "admin/sis_perfil/update/$page/?id=$id"; 
            $this->data['heading_title'] .= "Editar Registro";
        }
        $this->data['cancel'] = site_url("admin/sis_perfil/index/".$page);
        
        
        $this->data['opciones'] = $this->sis_recurso_model->get_opciones();
        $this->data['sis_acciones'] = $this->sis_accion_model->get_list();
        
        $this->layout->view('admin/sis_perfil/form', $this->data);
    }
    
    function validateForm(){
        return true;
    }
    
    
    function test_menu(){
        //$this->load->model('menu_model');
        
        echo $this->menu_model->get_menu_principal(true);
    }
    
}