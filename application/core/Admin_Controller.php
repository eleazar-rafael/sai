<?php
class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
                
        $this->load->library("Layout");
        $this->layout->setLayout("admin/layout");        
        
        //Evalua si el usuario esta logeado
        $this->data['arrUser'] =  $this->session->userdata("arrUser");        
        $ajax = (isset($_GET['ajax']) )? (int)$_GET['ajax'] : 0;
        
        if(!$this->data['arrUser'] and $ajax < 1 ) redirect("app/index");
        
        $this->data['user_iglesia_id'] = (int)$this->data['arrUser']['iglesia_id'];
        
        
        
        
        if($_SESSION['msg']){
            $this->data['msg'] = $_SESSION['msg'];
            $_SESSION['msg'] = null;
        }
        
        //VARIABLES GENERALES
        $this->data['iglesia_id'] = $_SESSION['sai_conf']['iglesia_id'];
        
        //WARNING Y SUCCESS
        $this->data['error_warning'] = (isset($this->error['warning']))? $this->error['warning'] : null;        
        $this->data['success'] = '';
        
        if (isset($_SESSION['success'])) {
            $this->data['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }        
        if (isset($_SESSION['error'])) {
            $this->data['error_warning'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        
        //$this->admin_menu = $this->menu_model->get_menu_principal();        
        //$this->set_permisos();
    }
    
    
    
    function set_permisos(){
        
        $permiso = $_SESSION['permisos']['admin'][$this->controller];
        //$this->data['permiso'] = $_SESSION[$this->controller];
        $add = (!$permiso['insert'] and !$permiso['create'])? "display:none!important;":"";
        $edit = (!$permiso['update'])? "display:none!important;":"";
        $add_edit = (!$permiso['insert'] and !$permiso['update'])? "display:none!important;":"";
        $delete = (!$permiso['delete'])? "display:none!important;":"";
        $view = (!$permiso['view'])? "display:none!important;":"";
        $edit_view = (!$permiso['view'] and !$permiso['update'])? "display:none!important;":"";
        
        
        $this->data['permiso_css'] = "<style> .p-add{".$add."} .p-edit{".$edit."} .p-add-edit{".$add_edit."} .p-delete{".$delete."} .p-view{".$view."} .p-edit-view{".$edit_view."}</style>";        
        
    }
    
    

}
