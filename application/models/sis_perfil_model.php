<?php
class sis_perfil_model extends MY_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_data($id)
    {
        $query = $this->db->query("SELECT * FROM sis_perfil WHERE id = '".(int)$id."' and ifnull(borrado,0) = 0 ");
        return $query->row_array();
    }

    function get_data_list($data = array())
    {	
        $perfil_id =(int)$this->user['perfil_id'];   
        if($perfil_id > 1) $sWhere = " and id not in(1) ";
        $sql = "SELECT * FROM sis_perfil WHERE ifnull(borrado,0) = 0 $sWhere ";

        if( $data ){
            if (!empty($data['filter_nombre'])) $sql .= " AND LCASE(nombre) LIKE '%" . $data["filter_nombre"] . "%'";                        

            $sort_data = array('nombre');
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $tsort = $data['sort'];
                $sql .= " ORDER BY " . $tsort;
            } else {
                $sql .= " ORDER BY pos, nombre ";
            }
            if (isset($data['order']) && ($data['order'] == 'DESC')) {
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
            $sql .= "order by pos, nombre asc ";
        }
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_total($data = array())
    {
        $sql ="Select COUNT(DISTINCT id) AS total from sis_perfil where ifnull(borrado,0) = 0 ";

        if (!empty($data['filter_nombre'])) $sql .= " AND LCASE(nombre) LIKE '%" . $data["filter_nombre"] . "%'";            
        
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row['total'];
    }
    
    function get_recursos($perfil_id=0){        
        $query = $this->db->get_where('sis_perfil_recurso', array('perfil_id' => (int)$perfil_id));
        $arr_recurso = array();
        if($query->num_rows >0 )
            foreach($query->result_array() as $pos => $recurso){
                $arr_recurso[$recurso['recurso_id']] = $recurso;
            }
        return $arr_recurso;
    }

    function insert($post)
    {
	if(isset($post['nombre'])){
            $this->db->insert("sis_perfil",$post);
            $id = $this->db->insert_id();

            if(!$this->db->_error_message()) $this->add_track("sis_perfil", $id, $post, "insert" );
            return  $id;
        }
    }

    function update($post)
    {
        if(is_array($post)){
            $this->db->where("id",(int)$post['id']);
            $this->db->update("sis_perfil",$post);

            if($this->db->affected_rows() > 0 ){
                $this->add_track("sis_perfil", $post['id'], $post, "update");
                return true;
            }
        }
    }
    
    function save_perfil_recurso($perfil_id=0){        
        $perfil_id = (int)$perfil_id;
        
        if($perfil_id > 0){            
            $this->db->delete("sis_perfil_recurso", array('perfil_id'=>$perfil_id)); //LIMPIA LOS DATOS DEL PERFIL        
            
            $arr_recursos = $this->input->post('recurso_id');
            $arr_permisos = $this->input->post('permisos');
            if($arr_recursos)
                foreach ($arr_recursos as $recurso_id){
                    $info['perfil_id'] = $perfil_id;
                    $info['recurso_id'] = $recurso_id;
                    $info['permisos'] = null;
                    if($arr_permisos[$recurso_id])
                        $info['permisos'] = json_encode ($arr_permisos[$recurso_id]);
                    
                    $this->db->insert("sis_perfil_recurso",$info);
                }
        }    
            
    }

    function delete($id)
    {
        $post['borrado'] = 1;
        $this->db->where("id",(int)$id);
	$this->db->update("sis_perfil", $post );
        $affected = $this->db->affected_rows();

        if($affected) $this->add_track("sis_perfil", $id, $post, "delete");

	return $affected;
    }
    
    function cbo_perfil($op_ini="",$omitir=""){   
        $sWhere = "";
        
        $perfil_id = (int)$this->user['perfil_id'];      
        if($perfil_id > 1) $sWhere = " and id not in(1) ";
        $sql = "SELECT id, nombre, pos FROM sis_perfil WHERE ifnull(borrado,0) = 0 $sWhere ORDER BY pos, nombre asc";
        
        $query = $this->db->query($sql);
        $cbo = array();
        if($op_ini) $cbo[0] = $op_ini;
        if($query->num_rows)
            foreach($query->result_array() as $pos => $row){
                $cbo[$row['id']] = $row['nombre'];
            }
        
        return $cbo;        
    }
    
    function json_arr_acciones($acciones=""){
        $json_accion = array();
        if($acciones) $json_accion = (array)json_decode($acciones);
        $arr_accion = array();
        if($json_accion) foreach($json_accion as $val) $arr_accion[$val] = $val;
        return $arr_accion;
    }
    
    
}
