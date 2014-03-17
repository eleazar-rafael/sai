<?php

class iglesia_departamento_model extends MY_Model{
    var $list= "iglesia_departamento";
    var $table = "iglesia_departamento";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function cbo_iglesia_departamento($opInicial =""){
        return $this->get_cbo($this->table,"id,nombre",array('ifnull(borrado,0)' => 0),"nombre asc",$opInicial);        
    }
}    
