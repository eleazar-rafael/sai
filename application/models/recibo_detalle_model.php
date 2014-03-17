<?php

class recibo_detalle_model extends MY_Model{
    var $list= "recibo_detalle";
    var $table = "recibo_detalle";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function set_list($list){
        $this->list = $list;
    }
    
    function get_data($id="")
    {        
        $sql = "SELECT rdet.*
                       ,otipo.nombre as ofrenda_tipo_nombre
                       ,gtipo.nombre as gasto_tipo_nombre  
                       ,idepto.nombre as iglesia_departmento_nombre
                FROM  ".$this->table ." rdet 
                LEFT JOIN ofrenda_tipo otipo on otipo.id = rdet.ofrenda_tipo_id
                LEFT JOIN gasto_tipo gtipo on gtipo.id = rdet.gasto_tipo_id
                LEFT JOIN iglesia_departamento idepto on idepto.id = rdet.iglesia_departmento_id
                WHERE ifnull(rdet.borrado,0) = 0  and rdet.id = ".(int)$id; 
        
        $query = $this->db->query($sql);
        return $query->row_array();
    }
            
    function get_data_list($recibo_id=0)
    {
        $query = $this->db->query("SELECT rdet.* FROM ".$this->table ." rdet 
                                   WHERE ifnull(rdet.borrado,0)=0  and rdet.recibo_id = ".(int)$recibo_id);
        return $query->result_array();             
    }

    function insert($post)
    {        
        if($post){       
            if(isset($post['ofrenda_tipo_id']) and  !$post['ofrenda_tipo_id']) unset($post['ofrenda_tipo_id']);
            if(isset($post['gasto_tipo_id']) and  !$post['gasto_tipo_id']) unset($post['gasto_tipo_id']);
            if(isset($post['iglesia_departmento_id']) and  !$post['iglesia_departmento_id']) unset($post['iglesia_departmento_id']);
            $post['fecha_alta'] = date("Y-m-d H:i:s");
            $this->db->insert($this->table ,$post);
            return  $this->db->insert_id();
        }
        
    }

    function update($post)
    {
        if(is_array($post)){            
            if(isset($post['ofrenda_tipo_id']) and  !$post['ofrenda_tipo_id']) $post['ofrenda_tipo_id']=null;
            if(isset($post['gasto_tipo_id']) and  !$post['gasto_tipo_id']) $post['gasto_tipo_id']=null;
            if(isset($post['iglesia_departmento_id']) and  !$post['iglesia_departmento_id']) $post['iglesia_departmento_id']=null;
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
