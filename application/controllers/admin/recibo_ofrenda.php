<?php
class recibo_ofrenda extends Recibo_Controller {
        
    public function __construct(){
        parent::__construct();        
        $this->recibo_tipo_id = RECIBO_OFRENDAS;
        $this->controller = "recibo_ofrenda";
    }

    function insert($semanal_id = 0) {
        parent::insert($semanal_id);
    }
    
    public function update($page = 0) {
        parent::update($page);
    }
    
    public function add_tr_detalle($recibo_tipo_id, $max_detalle) {
        parent::add_tr_detalle($recibo_tipo_id, $max_detalle);
    }
}
