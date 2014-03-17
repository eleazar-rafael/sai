<?php

class Sis_usuario extends Admin_Controller{
    var $list= "sis_usuario";
    var $error = 0;
    public function __construct()
    {
        parent::__construct();       
        
        $this->load->model("sis_usuario_model");
        $this->load->model("sis_perfil_model");
        $this->load->model("iglesia_model");
        
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
            $recursos = $this->input->post('sis_usuario');
            $id = $this->sis_usuario_model->insert( $recursos );            
            
            if( (int)$id > 0 )
                $_SESSION['success'] = "Usuario Agregado";                
            else
                $_SESSION['error'] = "Error al Crear Usuario";
          
            $page = get_page($this->list); 
            redirect("admin/sis_usuario/index/$page");
        }

        $this->getform();
        
    }
    
    public function update($page=0)
    {        
        set_page($this->list,$page);
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm() ) {  
            $sis_usuario = $this->input->post('sis_usuario');            
            $this->sis_usuario_model->update($sis_usuario);
            
            $_SESSION['success'] = "Usuario Editado";
            $page = get_page($this->list);            
            redirect("admin/sis_usuario/index/$page/");
        }
        $this->getform();        
    }   
    
    public function delete($page=0)
    {        
        $resp = $this->sis_usuario_model->delete( $this->input->get('id') );
        if((int)$resp >0)
            $_SESSION['success'] = "Se borr&oacute; el registro solicitado";
        else
            $_SESSION['error'] = "Cuidado: el registro no existe o se gener&oacute; un error";   
        redirect("admin/sis_usuario/index/$page");   
    }
    
    function getlist(){
        $this->data['heading_title'] = "Listado de Usuarios ";
        //PAGE, SORT Y ORDER        
        $this->data['list'] =  $this->list;
        $this->data['page'] =  get_page($this->list);        
        $_sort= get_sort($this->list);   
        
        $this->data['sort'] = ( $_sort['sort'] )? $_sort['sort'] : 'id';
        $this->data['order'] = ($_sort['order'])? $_sort['order'] : 'ASC';
                
        //LINK PARA COLUMNAS
        $url_order = ( $this->data['order'] == 'ASC')? '&order=DESC': '&order=ASC';
        $pre_url = "admin/sis_usuario/index?";
        $this->data['sort_id']   = site_url($pre_url."sort=id").$url_order;
        $this->data['sort_nombre']   = site_url($pre_url."sort=nombre").$url_order;
        $this->data['sort_email']   = site_url($pre_url."sort=email").$url_order;
        $this->data['sort_perfil']   = site_url($pre_url."sort=perfil").$url_order;
                
        //DATOS PARA SELECCION DE FILTROS
            
        //PAGINACION
        $this->data['total'] = $total = $this->sis_usuario_model->get_total();
        $config = paginator_config($total,site_url("admin/sis_usuario/index"));
        $this->pagination->initialize( $config );
        $this->data['links'] = "<div class='pagination'>".$this->pagination->create_links()."</div>";
        $data = array('limit' => $config['per_page'],'start'=> (int)$this->data['page']);
        
        //DATOS A DESPLEGAR
        $this->data['arrInfo'] = $this->sis_usuario_model->get_data_list($data);
        
        $this->layout->view('admin/sis_usuario/index', $this->data);
    }
    
    function getform(){
        $page = get_page($this->list);             
        $this->data['heading_title'] ="Formulario de Usuario / ";
        
        if(!$this->data['sis_usuario'])
            $this->data['sis_usuario'] = $this->sis_usuario_model->get_data( $this->input->get('id') );        
        
        $this->data['cbo_perfil'] = $this->sis_perfil_model->cbo_perfil("-- Seleccione --");
        $this->data['cbo_iglesia'] = $this->iglesia_model->cbo_iglesia("-- Seleccione --");
        
        $id = isset($this->data['sis_usuario']['id'])? (int)$this->data['sis_usuario']['id'] : 0;
        if($id == 0){
            $this->data['action'] = "admin/sis_usuario/insert/$page/";
            $this->data['heading_title'] .= "Nuevo Registro";
        }else{            
            $this->data['action'] = "admin/sis_usuario/update/$page/?id=$id"; 
            $this->data['heading_title'] .= "Editar Registro";
        }
        $this->data['cancel'] = site_url("admin/sis_usuario/index/".$page);
        
        $this->layout->view('admin/sis_usuario/form', $this->data);
    }
    
    function validateForm(){
        $data = $_POST['sis_usuario'];
        
        $id = (int)$data['id'];
        $this->error = 0;
        if(!$data['username']){
            $this->data['error_warning'] ="Teclee el nombre de sis_usuario";
            $this->error = 1;
        }
        
        if($id ==0 ){
            $existe = $this->sis_usuario_model->get_exist_new($data['username']);                            
        }else{
            $existe = $this->sis_usuario_model->get_exist_update($id,$data['username']);            
        }
        
        if($existe){
            if($this->data['error_warning']) $this->data['error_warning'] .="<br>";
            $this->data['error_warning'] .= "El sis_usuario \"".$data['username']."\" ya existe";
            $this->error = 1;
        }
            
        if($this->error == 1){
            $this->data['sis_usuario'] = $data;
            return false;
        }
            
        return true;
    }
    
    
    function test(){
        pre($_SESSION['permisos'],'--PERMISOS--');
    }
}    
