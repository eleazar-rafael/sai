<?php

class App extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("periodo_anual_model");
        $this->load->model("periodo_mensual_model");
        $this->load->model("periodo_semanal_model");
        $this->load->model("iglesia_model");
        $this->data['conf'] = $_SESSION['sai_conf'];
    }
    
    public function index()
    { 
        $conf = $this->data['conf'];
        
        $this->data['cbo_iglesia'] = $this->iglesia_model->cbo_iglesia("--seleccione--");
        $this->data['cbo_periodo_anual'] = $this->periodo_anual_model->cbo_anual("--Seleccione--",$conf['iglesia_id']);
        $this->data['cbo_periodo_mensual'] = $this->periodo_mensual_model->cbo_mensual("--Seleccione--",$conf['periodo_anual_id']);
        $this->data['cbo_periodo_semanal'] = $this->periodo_semanal_model->cbo_semanal("--Seleccione--",$conf['periodo_mensual_id']);        
        $this->layout->view('admin/app/index',$this->data);
    }
    
    public function update(){
        if( $this->input->server('REQUEST_METHOD') == 'POST' ){
            $_SESSION['sai_conf']['iglesia_id'] = $this->input->post("iglesia_id");
            $_SESSION['sai_conf']['periodo_anual_id'] = $this->input->post("periodo_anual_id");
            $_SESSION['sai_conf']['periodo_mensual_id'] = $this->input->post("periodo_mensual_id");
            $_SESSION['sai_conf']['periodo_semanal_id'] = $this->input->post("periodo_semanal_id");
            
            $_SESSION['success'] = "Datos Establecidos";
        }else{
            $_SESSION['error'] = "Error no se recibieron datos";
        }
        redirect("admin/app/index");
    }
    
    public function ajax_cbo_periodo_anual($iglesia_id=0){        
        $cbo_periodo_anual = $this->periodo_anual_model->cbo_anual("--Seleccione--",$iglesia_id);
        echo form_dropdown("periodo_anual_id",$cbo_periodo_anual,0, " id='periodo_anual_id' onchange='check_periodo_mensual();' ");
    }
    
    public function ajax_cbo_periodo_mensual($anual_id=0){
        $cbo_periodo_mensual = $this->periodo_mensual_model->cbo_mensual("--Seleccione--",$anual_id);        
        echo form_dropdown("periodo_mensual_id",$cbo_periodo_mensual,0," id='periodo_mensual_id' onchange='check_periodo_semanal();' ");        
    }
    
    public function ajax_cbo_periodo_semanal($mensual_id=0){
        $cbo_periodo_semanal = $this->periodo_semanal_model->cbo_semanal("--Seleccione--",$mensual_id);        
        echo form_dropdown("periodo_semanal_id",$cbo_periodo_semanal,0," id='periodo_semanal_id' ");        
    }
    /*public function logout()
    {        
        $this->session->set_userdata("arrUser", null);
        redirect("app/index");
    }*/
}    
