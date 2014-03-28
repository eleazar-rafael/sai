<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Informes extends Admin_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        //$this->load->database();
        //$this->load->helper('url');
        /* ------------------ */ 
 
        //$this->load->library('grocery_CRUD');
        //$this->load->library( 'nativesession' );
 
    }
 
    public function index()
    {
    	$iglesia_id = $_SESSION['sai_conf']['iglesia_id'];//$this->nativesession->get( 'iglesia_id' );
        $output = array(
        				'title'=>'Informe de Diezmos y Ofrendas',
        				'iglesia_id' => $iglesia_id,
        				'xml' => 'informe.diezmos.y.ofrendas.xml',
        			);
        $this->layout->view('admin/reports/informes', $output);
    }    
    
}
