<?php

class periodo_mensual_model extends MY_Model{
    var $list= "periodo_mensual";
    var $table = "periodo_mensual";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
      
    function cbo_mensual($opInicial ="", $periodo_anual_id = 0, $orden="desc"){
        $periodo_anual_id = (int)$periodo_anual_id;
        return $this->get_cbo($this->table,"id,codigo as nombre",array('ifnull(borrado,0)' => 0, 'periodo_anual_id'=>$periodo_anual_id)
                              ,"codigo $orden ",$opInicial);        
    }
}    
