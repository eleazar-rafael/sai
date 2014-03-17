<?php

class ofrenda_tipo_model extends MY_Model{
    var $list= "ofrenda_tipo";
    var $table = "ofrenda_tipo";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function cbo_ofrenda_tipo($opInicial =""){
        return $this->get_cbo($this->table,"id,nombre",array('ifnull(borrado,0)' => 0),"nombre asc",$opInicial);        
    }
}    
