<?php

class recibo_model extends MY_Model{
    var $list= "recibo";
    var $table = "recibo";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function get_data($id=""){
        
        $sql = "SELECT r.*,   pm.nombre as periodo_semanal_nombre 
                FROM  ".$this->table ." r 
                LEFT JOIN periodo_mensual pm on pm.id = r.periodo_semanal_id
                WHERE ifnull(r.borrado,0) = 0  and r.id = ".(int)$id; 
        
        $query = $this->db->query($sql);
        return $query->row_array();
    }
            
    function get_data_list($data = array()){        
        
        $sql = "SELECT r.*,
                pm.nombre as periodo_semanal_nombre                 
                FROM ".$this->table ." r    
                LEFT JOIN periodo_mensual pm on pm.id = r.periodo_semanal_id                
                WHERE ifnull(p.borrado,0)=0  ";
        //, p.cotizacion_id                    
        //LEFT JOIN apl_catalogo estatus on estatup.id = p.estatus_id and ifnull(estatup.borrado,0)=0
        $filter = get_filter($this->list);
        $sort = get_sort($this->list);      
        
        if( $filter or $sort or $data ){
            if (!empty($filter['id'])) $sql .= " AND r.id LIKE '%" . $filter["id"] . "%'";            
            if (!empty($filter['iglesia_id'])) $sql .= " AND r.iglesia_id = '" . $filter["iglesia_id"] . "'"; 
            if (!empty($filter['periodo_semanal_id'])) $sql .= " AND r.periodo_semanal_id = '" . $filter["periodo_semanal_id"] . "'";
            if (!empty($filter['periodo_semanal'])) $sql .= " AND pm.nombre like '%" . $filter["periodo_semanal"] . "%'";
            if (!empty($filter['recibo_tipo_id'])) $sql .= " AND r.recibo_tipo_id = '" . $filter["recibo_tipo_id"] . "'";
            if (!empty($filter['fecha'])) $sql .= " AND r.fecha LIKE '%" . $filter["fecha"] . "%'";
            if (!empty($filter['recibo_numero'])) $sql .= " AND r.recibo_numero LIKE '%" . $filter["fecha_final"] . "%'";
            if (!empty($filter['persona_id'])) $sql .= " AND r.persona_id = '" . $filter["persona_id"] . "'";
            if (!empty($filter['descripcion'])) $sql .= " AND r.descripcion LIKE '%" . $filter["descripcion"] . "%'";
                        
            $sort_data = array('id','iglesia_id','periodo_semanal','periodo_semanal_id','recibo_tipo_id','fecha','recibo_numero','persona_id','descripcion');
            if (isset($sort['sort']) && in_array($sort['sort'], $sort_data)) {                                
                $tsort = "r.".$sort['sort'];
                if($sort['sort']=="periodo_semanal") $tsort = "pm.nombre";
                
                
                $sql .= " ORDER BY " . $tsort; 
            } else {
                $sql .= " ORDER BY r.id ";
            }
            
            if ( isset($sort['order']) && ($sort['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                        $data['start'] = 0;
                }
                if ($data['limit'] < 1) {
                        $data['limit'] = 20;
                }
                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }
        }else{
            $sql .= "order by r.id asc";
        }
        
        $query = $this->db->query($sql);
        return $query->result_array();             
    }

    function get_total(){       
        $sql = "SELECT COUNT(DISTINCT r.id) AS total              
                FROM ".$this->table ." r 
                LEFT JOIN periodo_mensual pm on pm.id = r.periodo_semanal_id        
                WHERE ifnull(r.borrado,0)=0   ";
        
        $filter = get_filter($this->list);
        if (!empty($filter['id'])) $sql .= " AND r.id LIKE '%" . $filter["id"] . "%'";            
        if (!empty($filter['iglesia_id'])) $sql .= " AND r.iglesia_id = '" . $filter["iglesia_id"] . "'"; 
        if (!empty($filter['periodo_semanal_id'])) $sql .= " AND r.periodo_semanal_id = '" . $filter["periodo_semanal_id"] . "'";
        if (!empty($filter['periodo_semanal'])) $sql .= " AND pm.nombre like '%" . $filter["periodo_semanal"] . "%'";
        if (!empty($filter['recibo_tipo_id'])) $sql .= " AND r.recibo_tipo_id = '" . $filter["recibo_tipo_id"] . "'";
        if (!empty($filter['fecha'])) $sql .= " AND r.fecha LIKE '%" . $filter["fecha"] . "%'";
        if (!empty($filter['recibo_numero'])) $sql .= " AND r.recibo_numero LIKE '%" . $filter["fecha_final"] . "%'";
        if (!empty($filter['persona_id'])) $sql .= " AND r.persona_id = '" . $filter["persona_id"] . "'";
        if (!empty($filter['descripcion'])) $sql .= " AND r.descripcion LIKE '%" . $filter["descripcion"] . "%'";
        

        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row['total'];
    }

    function insert($post)
    {        
        if($post){       
            if(isset($post['persona_id']) and  !$post['persona_id']) unset($post['persona_id']);
            $post['fecha_alta'] = date("Y-m-d H:i:s");
            $this->db->insert($this->table ,$post);
            return  $this->db->insert_id();
        }
        
    }

    function update($post){
        if(is_array($post)){            
            if(isset($post['persona_id']) and  !$post['persona_id']) $post['persona_id']=null;
            $this->db->where("id",(int)$post['id']);
            $this->db->update($this->table ,$post);
            return true;            
        }
    }
    
    function delete($id)
    {        
        $id = (int)$id;
        if($id >0 ){
            $post['borrado'] = 1;
            $this->db->where("id",(int)$id);
            $this->db->update($this->table ,$post);
            $affected = $this->db->affected_rows();
            return $affected;
        }        
    }
    
    /*function cbo_proyecto($opInicial =""){
        return $this->get_cbo($this->table,"id,nombre",array('ifnull(borrado,0)' => 0),"nombre asc",$opInicial);        
    }*/
    
    
}    