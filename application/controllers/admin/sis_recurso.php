<?php

class sis_recurso extends Admin_Controller{
    var $list= "sis_recurso";
    public function __construct()
    {
        parent::__construct();        
        $this->load->model("sis_recurso_model");
        $this->load->model("sis_accion_model");
        
        
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
            $recursos = $this->input->post('sis_recurso');
            $recursos['acciones'] = $this->config_json_accion();
            $id = $this->sis_recurso_model->insert( $recursos );            
            if( (int)$id > 0 ) 
                $_SESSION['success'] = "Recurso Agregado";
            else
                $_SESSION['error'] = "Error al Crear Recurso";
          
            $page = get_page($this->list); 
            redirect("admin/sis_recurso/index/$page");
        }

        $this->getform();
        
    }
    
    public function update($page=0)
    {        
        set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) {  
            $recursos = $this->input->post('sis_recurso');
            $recursos['acciones'] = $this->config_json_accion();
            $this->sis_recurso_model->update($recursos);            
            $_SESSION['success'] = "Recurso Editado";
            $page = get_page($this->list);            
            redirect("admin/sis_recurso/index/$page/");
        }
        $this->getform();        
    }
    
    function config_json_accion(){
        $acciones = $this->input->post('acciones');
        /*$tmp = array();
        if($acciones)
            foreach ($acciones as $kpos=> $accion){
                $tmp[] = $accion;
            }
        if(!$tmp) return null;*/
        //return json_encode($tmp);
        return json_encode($acciones);
    }
    
    public function delete($page=0)
    {
        $resp = $this->sis_recurso_model->delete( $this->input->get('id') );
        if((int)$resp >0)
            $_SESSION['success'] = "Se borr&oacute; el registro solicitado";
        else
            $_SESSION['error'] = "Cuidado: el registro no existe o se gener&oacute; un error";   
        redirect("admin/sis_recurso/index/$page");   
    }
    
    function getlist(){
        $this->data['heading_title'] = "Listado de Recursos ";
        //PAGE, SORT Y ORDER        
        $this->data['list'] =  $this->list;
        $this->data['page'] =  get_page($this->list);        
        $_sort= get_sort($this->list);   
        
        $this->data['sort'] = ( $_sort['sort'] )? $_sort['sort'] : 'orden';
        $this->data['order'] = ($_sort['order'])? $_sort['order'] : 'ASC';
                
        //LINK PARA COLUMNAS
        $url_order = ( $this->data['order'] == 'ASC')? '&order=DESC': '&order=ASC';
        $pre_url = "admin/sis_recurso/index?";
        $this->data['sort_id']   = site_url($pre_url."sort=id").$url_order;
        $this->data['sort_nombre']   = site_url($pre_url."sort=nombre").$url_order;
        $this->data['sort_link']  = site_url($pre_url."sort=link").$url_order;        
        $this->data['sort_orden'] = site_url($pre_url."sort=orden").$url_order;        
                
        //DATOS PARA SELECCION DE FILTROS
            
        //PAGINACION
        $this->data['total'] = $total = $this->sis_recurso_model->get_total();
        $config = paginator_config($total,site_url("admin/sis_recurso/index"));
        $this->pagination->initialize( $config );
        $this->data['links'] = "<div class='pagination'>".$this->pagination->create_links()."</div>";
        $data = array('limit' => $config['per_page'],'start'=> (int)$this->data['page']);
        
        //DATOS A DESPLEGAR
        $this->data['arrInfo'] = $this->sis_recurso_model->get_data_list($data);
        
        $this->layout->view('admin/sis_recurso/index', $this->data);
    }
    
    function getform(){
        $page = get_page($this->list);             
        $this->data['heading_title'] ="Formulario de Recursos / ";
        $this->data['sis_recurso'] = $this->sis_recurso_model->get_data( $this->input->get('id') );        
        
        $this->data['cbo_padre'] = $this->sis_recurso_model->cbo_recurso("-- Seleccione --",$this->data['sis_recurso']['id']);
        
        $id = isset($this->data['sis_recurso']['id'])? (int)$this->data['sis_recurso']['id'] : 0;
        if($id == 0){
            $this->data['action'] = "admin/sis_recurso/insert/$page/";
            $this->data['heading_title'] .= "Nuevo Registro";
        }else{
            $this->data['action'] = "admin/sis_recurso/update/$page/?id=$id"; 
            $this->data['heading_title'] .= "Editar Registro";
        }        
        $this->data['cancel'] = site_url("admin/sis_recurso/index/".$page);
        
        
        
        $this->data['sis_acciones'] = $this->sis_accion_model->get_list();
        
        $this->layout->view('admin/sis_recurso/form', $this->data);
    }
    
    function validateForm(){
        return true;
    }
    
}