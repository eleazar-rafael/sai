<?php
class recibo_gasto extends Recibo_Controller {
        
    public function __construct(){
        parent::__construct();        
        $this->recibo_tipo_id = RECIBO_GASTOS;
        $this->controller = "recibo_gasto";
    }
    function index($semanal_id=0) {
        parent::index($semanal_id);
    }

    function insert($page = 0) {
        parent::insert($page);
    }
    
    function update($page = 0) {
        parent::update($page);
    }
    
    public function add_tr_detalle($recibo_tipo_id, $max_detalle) {
        parent::add_tr_detalle($recibo_tipo_id, $max_detalle);
    }
}
