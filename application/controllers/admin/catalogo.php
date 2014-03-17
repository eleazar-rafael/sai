<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Catalogo extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        //$this->load->database();
        //$this->load->helper('url');
        /* ------------------ */ 
 
        $this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
        //echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        //$this->load->view('admin/template',array());  
        $this->layout->view('admin/catalogo/output',$output);
    }
 
    public function cuenta()
    {
        //$this->grocery_crud->set_theme('datatables');
        $this->grocery_crud->set_table('cuenta');        
        //$this->grocery_crud->display_as('name','Nombre')->display_as('description','Descripcion');
        //$this->grocery_crud->columns('name','description');        
        //$this->grocery_crud->fields('name','description');
        $output = $this->grocery_crud->render();
        
        //$this->load->view('admin/template',$output); 
        $this->layout->view('admin/catalogo/output',$output);
        
    }
    
    public function cuenta_tipo()
    {        
        $this->grocery_crud->set_table('cuenta_tipo');        
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function cuenta_accion_tipo()
    {        
        $this->grocery_crud->set_table('cuenta_accion_tipo');        
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output); 
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function cuenta_actividad()
    {        
        $this->grocery_crud->set_table('cuenta_actividad');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output); 
        $this->layout->view('admin/catalogo/output',$output);
    }
            
    public function gasto_tipo()
    {        
        $this->grocery_crud->set_table('gasto_tipo');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output); 
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function iglesia()
    {        
        $this->grocery_crud->set_table('iglesia');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function iglesia_departamento()
    {        
        $this->grocery_crud->set_table('iglesia_departamento');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function persona()
    {        
        $this->grocery_crud->set_table('persona');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);  
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function persona_tipo()
    {        
        $this->grocery_crud->set_table('persona_tipo');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);  
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function ofrenda_tipo()
    {        
        $this->grocery_crud->set_table('ofrenda_tipo');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    public function periodo_estatus_tipo()
    {        
        $this->grocery_crud->set_table('periodo_estatus_tipo');
        $output = $this->grocery_crud->render();        
        //$this->load->view('admin/template',$output);
        $this->layout->view('admin/catalogo/output',$output);
    }
    
    
    
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */
 