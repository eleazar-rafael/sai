<?php
class sis_usuario_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        
    }  
    
    function get_data($id)
    {
        $query = $this->db->query("SELECT * FROM sis_usuario WHERE id = '".(int)$id."' and ifnull(borrado,0) = 0 ");
        return $query->row_array();
    }

    function get_data_list($data = array())
    {	        
        //pre($this->user);
        $sWhere ="";
        $perfil_id = (int)$this->user['perfil_id']; 
        if($perfil_id > 1) $sWhere = " and perfil_id not in(1) ";
        $sql = "SELECT sis_usuario.id, sis_usuario.nombre, email,perfil_id, username, p.nombre as perfil_nombre 
                FROM sis_usuario 
                LEFT JOIN sis_perfil p ON p.id = sis_usuario.perfil_id
                WHERE ifnull(sis_usuario.borrado,0) = 0 $sWhere ";

        if( $data ){
            if (!empty($data['filter_nombre'])) $sql .= " AND LCASE(sis_usuario.nombre) LIKE '%" . $data["filter_nombre"] . "%'";
            if (!empty($data['filter_email'])) $sql .= " AND LCASE(email) LIKE '%" . $data["filter_email"] . "%'";
            if (!empty($data['filter_username'])) $sql .= " AND LCASE(username) LIKE '%" . $data["filter_username"] . "%'";
            if (!empty($data['filter_perfil'])) $sql .= " AND perfil_id = '" . $data["filter_perfil_id"] . "' ";

            $sort_data = array('nombre, email, perfil, username');
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $tsort = $data['sort'];
                if($data['sort'] == 'nombre') $tsort = 'sis_usuario.nombre';
                if($data['sort'] == 'perfil') $tsort = 'p.nombre';                
                $sql .= " ORDER BY " . $tsort;
            } else {
                $sql .= " ORDER BY sis_usuario.nombre ";
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
            $sql .= "order by  sis_usuario.nombre asc ";
        }
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_total($data = array())
    {
        $sWhere ="";
        $perfil_id = (int)$this->user['perfil_id']; 
        if($perfil_id > 1) $sWhere = " and perfil_id not in(1) ";
        
        $sql ="Select COUNT(DISTINCT id) AS total from sis_usuario where ifnull(borrado,0) = 0 $sWhere";

        if (!empty($data['filter_nombre'])) $sql .= " AND LCASE(nombre) LIKE '%" . $data["filter_nombre"] . "%'";
        if (!empty($data['filter_email'])) $sql .= " AND LCASE(email) LIKE '%" . $data["filter_email"] . "%'";
        if (!empty($data['filter_username'])) $sql .= " AND LCASE(username) LIKE '%" . $data["filter_username"] . "%'";
        if (!empty($data['filter_perfil'])) $sql .= " AND perfil_id = '" . $data["filter_perfil_id"] . "' ";          
        
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row['total'];
    }
    
    function insert($post)
    {
	if(isset($post['nombre'])){
            $this->db->insert("sis_usuario",$post);
            $id = $this->db->insert_id();

            if(!$this->db->_error_message()) $this->add_track("sis_usuario", $id, $post, "insert" );
            return  $id;
        }
    }

    function update($post)
    {
        if(is_array($post)){
            $this->db->where("id",(int)$post['id']);
            $this->db->update("sis_usuario",$post);

            if($this->db->affected_rows() > 0 ){
                $this->add_track("sis_usuario", $post['id'], $post, "update");
                return true;
            }
        }
    }
    
    function delete($id)
    {
        $post['borrado'] = 1;
        $this->db->where("id",(int)$id);
	$this->db->update("sis_usuario", $post );
        $affected = $this->db->affected_rows();

        if($affected) $this->add_track("sis_usuario", $id, $post, "delete");

	return $affected;
    }
    
    public function get_user($username="",$password=""){
        $sql ="SELECT id, nombre, username, email,iglesia_id, perfil_id FROM sis_usuario WHERE username='".$username."' AND password='".$password."'";
       
        $query = $this->db->query($sql);
        return $query->row_array(); 
    }
    
    function get_exist_new($username){
						
        $sql ="SELECT id  FROM sis_usuario WHERE username='".$username."' AND  ifnull(borrado,0)=0 ";
        //echo $sql; 

        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
                return true;
        }

        return false;	
    }

    function get_exist_update($id, $username){

        $sql ="SELECT id FROM sis_usuario WHERE username = '$username' AND id NOT IN('$id') AND  ifnull(borrado,0)=0 ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0 ){
                return true;
        }
        return false;
    }
    
}
