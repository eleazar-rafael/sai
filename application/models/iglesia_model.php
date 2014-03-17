<?php

class iglesia_model extends MY_Model{
    var $list= "iglesia";
    var $table = "iglesia";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function cbo_iglesia($opInicial =""){
        return $this->get_cbo($this->table,"id,nombre",array('ifnull(borrado,0)' => 0),"nombre asc",$opInicial);        
    }
}    
