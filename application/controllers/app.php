<?php

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("sis_usuario_model");
        $this->load->model("sis_perfil_model");
        
    }
    
    public function index()
    {     
        $this->data['arrUser'] =  $this->session->userdata("arrUser");
        if(!$this->data['arrUser']){            
            $this->login();
        }else{
            redirect("admin/app/index",$this->data); //rect $this->layout->view('admin/app/index', $this->data);            
        }         
    }
    
    function login(){
        $post = $this->input->post('login');
        if($post['username'] and $post['password'])
        {  
            $this->load->model("iglesia_model");
            $arrUser =  $this->sis_usuario_model->get_user($post['username'],$post['password']);
           
            if($arrUser){
                $this->session->set_userdata("arrUser",$arrUser);
                unset($_SESSION['sai_conf']);
                $iglesia = $this->iglesia_model->get_data($arrUser['iglesia_id']);
                $_SESSION['sai_conf']['iglesia_id'] = $arrUser['iglesia_id'];
                $_SESSION['sai_conf']['iglesia_nombre'] = $iglesia['nombre'];
                //$this->load->library( 'nativesession' );
                //$this->nativesession->set( 'iglesia_id', 1 );
                redirect("admin/app/index");				
            }
        }        
        $this->load->view('login', $this->data);
    }    
    /*public function login()
    {        
        $post = $this->input->post('login');
        if($post){
            if( $post['username'] =="admin" and $post['password'] =="caracol" ){
                $usuario = array('user'=>'1');
                $this->session->set_userdata("arrUser", $usuario);
                redirect("admin/app/index");
            }
            
            $this->data['error_warning'] = 'Nombre de usuario o password incorrecto ';
        }        
        $this->load->view('login', $this->data);        
    }*/
    
    
    public function logout()
    {        
        if(isset($_SESSION['iglesia_id'])) unset($_SESSION['iglesia_id']);
    	if(isset($_SESSION['run_ok'])) unset($_SESSION['run_ok']);
        unset($_SESSION['sai_conf']);        
        
        $this->session->set_userdata("arrUser", null);
        $this->load->view('login');
    }
    
}    
