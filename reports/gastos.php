<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Gastos extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        $this->data['arrUser'] =  $this->session->userdata("arrUser");
        if(!$this->data['arrUser']){
            redirect("app/login");
        }
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */ 
 
        //$this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
        //echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        $this->load->view('gastos',array());
    	//$this->layout->view('gastos',array());
    }
 

}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */
