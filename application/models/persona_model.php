<?php

class persona_model extends MY_Model{
    var $list= "persona";
    var $table = "persona";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function cbo_persona($opInicial =""){
        $nombre = " trim(concat( ifnull( nombre ,'') , ' ', ifnull( apellido_paterno ,'') , ' ', ifnull( apellido_materno ,''))) ";
        return $this->get_cbo($this->table,"id, $nombre as nombre ",
                              array('ifnull(borrado,0)' => 0), ' nombre , apellido_paterno , apellido_materno asc' ,$opInicial);       
        //concat( nombre , apellido_paterno , apellido_materno )
    }
}