<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ingresos extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        //$this->load->database();
        //$this->load->helper('url');
        /* ------------------ */ 
 
        //$this->load->library('grocery_CRUD');
        $this->load->library( 'nativesession' );
    }
 
    public function index()
    {
    	//$iglesia_id = $this->nativesession->get( 'iglesia_id' );
        $iglesia_id = $_SESSION['sai_conf']['iglesia_id'];
    	$output = array(
    			'title'=>'Reporte De Diezmos y Ofrendas',
    			'iglesia_id' => $iglesia_id,
    			'xml' => 'ingresos.xml',
    	);
        $this->layout->view('admin/reports/ingresos',$output);
    }    
    
}
