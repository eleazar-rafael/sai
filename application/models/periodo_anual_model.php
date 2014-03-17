<?php

class periodo_anual_model extends MY_Model{
    var $list= "periodo_anual";
    var $table = "periodo_anual";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
      
    function cbo_anual($opInicial ="", $iglesia_id=0, $orden="desc"){
        $iglesia_id = (int)$iglesia_id;
        return $this->get_cbo($this->table,"id,codigo as nombre",array('ifnull(borrado,0)' => 0, 'iglesia_id'=>$iglesia_id),
                              "codigo $orden ",$opInicial);        
    }
}    
