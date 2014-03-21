<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class iglesia_departamento extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();        
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index()
    {        
        $this->grocery_crud->set_table('iglesia_departamento');
        $this->grocery_crud->display_as('nombre','Nombre departamento');
        $this->grocery_crud->columns('nombre','descripcion');
        $this->grocery_crud->unset_delete();
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/departamento',$output);          
    }
}    
