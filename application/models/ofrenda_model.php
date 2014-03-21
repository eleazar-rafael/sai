<?php
class ofrenda_model extends MY_Model{
        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_anual($id=0){        
        $query = $this->db->query("select id, nombre from periodo_anual where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    function get_mensual($id=0){        
        $query = $this->db->query("select id, nombre,periodo_anual_id from periodo_mensual where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    function get_semanal($id=0){        
        $query = $this->db->query("select id, codigo,nombre,periodo_mensual_id from periodo_semanal where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    function get_recibo($id=0){        
        $query = $this->db->query("select * from recibo where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    function get_recibo_detalle($id=0){        
        $query = $this->db->query("select * from recibo_detalle where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    function get_recibo_tipo($id=0){        
        $query = $this->db->query("select * from recibo_tipo where id = ".(int)$id." and borrado=0");
        return $query->row_array();
    }
    
    function path_anual(){
        //$str = anchor("admin/ofrenda/anual","Anuales");
        $str = anchor("admin/periodo_anual/index","Anuales");
        return $str;
    }    
    function path_mensual($anual_id=0){                
        $anual = $this->get_anual($anual_id);        
        $str = anchor("admin/periodo_anual/index","Anuales");
        $str .= " / ".$anual['nombre']." "; //anchor("admin/ofrenda/mensual/".$anual['id'],)
        return $str;        
    }
    function path_semanal($mensual_id=0){                
        $mensual = $this->get_mensual($mensual_id);
        $anual = $this->get_anual($mensual['periodo_anual_id']);
        
        $str = anchor("admin/periodo_anual/index","Anuales");        
        $str .= " / ".anchor("admin/periodo_mensual/index/".$anual['id'],$anual['nombre']);
        $str .= " / ".$mensual['nombre'];
        //$str .= " / ".anchor("admin/ofrenda/semanal/".$mensual['id'],$mensual['nombre'])." / Recibos";
        return $str; 
    }
    
    function path_recibo($semanal_id=0,$recibo_tipo=0){
        $str_tipo="OFRENDA";
        if($recibo_tipo==2) $str_tipo="GASTO";
        
        $semanal = $this->get_semanal($semanal_id);
        $mensual = $this->get_mensual($semanal['periodo_mensual_id']);
        $anual = $this->get_anual($mensual['periodo_anual_id']);
        
        $str = anchor("admin/periodo_anual/index","Anuales");
        $str .= " / ".anchor("admin/periodo_mensual/index/".$anual['id'],$anual['nombre']);
        $str .= " / ".anchor("admin/periodo_semanal/index/".$mensual['id'],$mensual['nombre']);
        $str .= " / ".$str_tipo." - ".$semanal['nombre']." (".$semanal['codigo'].")";
        return $str; 
    }
    
    function path_recibo_detalle($recibo_id=0){
                
        $recibo = $this->get_recibo($recibo_id);
        $semanal = $this->get_semanal($recibo['periodo_semanal_id']);
        $mensual = $this->get_mensual($semanal['periodo_mensual_id']);
        $anual = $this->get_anual($mensual['periodo_anual_id']);
        $tipo = $this->ofrenda_model->get_recibo_tipo($recibo['recibo_tipo_id']);
        $str = anchor("admin/periodo_anual/index","Anuales");
        $str .= " / ".anchor("admin/periodo_mensual/index/".$anual['id'],$anual['nombre']);
        $str .= " / ".anchor("admin/periodo_semanal/index/".$mensual['id'],$mensual['nombre']);
        $str .= " / ".anchor("admin/periodo_recibo/index/".$tipo['id']."/".$semanal['id'],$tipo['nombre']." - ".$semanal['nombre']." (".$semanal['codigo'].")");
        $str .= " / Recibo ".$recibo['recibo_numero']." - ".$recibo['descripcion'];
        
        return $str;
    }
}    
