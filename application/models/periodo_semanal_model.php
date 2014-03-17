<?php

class periodo_semanal_model extends MY_Model{
    var $list= "periodo_semanal";
    var $table = "periodo_semanal";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
      
    function cbo_semanal($opInicial ="", $periodo_mensual_id=0, $orden="asc"){
        $periodo_mensual_id = (int)$periodo_mensual_id;
        return $this->get_cbo($this->table,"id, concat(nombre,' (',codigo,')') as nombre",array('ifnull(borrado,0)' => 0,'periodo_mensual_id'=>$periodo_mensual_id)
                               ,"codigo $orden ",$opInicial);
    }
}
