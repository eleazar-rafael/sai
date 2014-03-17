<?php

class gasto_tipo_model extends MY_Model{
    var $list= "gasto_tipo";
    var $table = "gasto_tipo";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function cbo_gasto_tipo($opInicial =""){
        return $this->get_cbo($this->table,"id,nombre",array('ifnull(borrado,0)' => 0),"nombre asc",$opInicial);        
    }
}    
