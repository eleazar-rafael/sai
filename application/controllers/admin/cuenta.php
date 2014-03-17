<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class cuenta extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();        
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index()
    {   
        $this->grocery_crud->set_table('cuenta');        
        //$this->grocery_crud->display_as('name','Nombre')->display_as('description','Descripcion');
        //$this->grocery_crud->columns('name','description');        
        //$this->grocery_crud->fields('name','description');
        $output = $this->grocery_crud->render();
        
        $this->layout->view('admin/catalogo/output',$output);         
    }
}    
