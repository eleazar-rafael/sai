<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class cuenta_actividad extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();        
        $this->load->library('grocery_CRUD'); 
    }
    
    public function index()
    {   
        $this->grocery_crud->set_table('cuenta_actividad');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output); 
        $this->layout->view('admin/catalogo/output',$output);     
    }
}    
