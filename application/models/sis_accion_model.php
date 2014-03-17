<?php
class sis_accion_model extends MY_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_data($id)
    {
        $query = $this->db->query("SELECT * FROM sis_accion WHERE id = '".(int)$id."' and ifnull(borrado,0) = 0 ");
        return $query->row_array();
    }

    function get_list()
    {	
        $sql = "SELECT * FROM sis_accion WHERE ifnull(borrado,0) = 0 order by pos asc ";        
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function insert($post)
    {
	if(isset($post['nombre'])){
            $this->db->insert("sis_accion",$post);
            $id = $this->db->insert_id();

            if(!$this->db->_error_message()) $this->add_track("sis_accion", $id, $post, "insert" );
            return  $id;
        }
    }

    function update($post)
    {
        if(is_array($post)){
            $this->db->where("id",(int)$post['id']);
            $this->db->update("sis_accion",$post);

            if($this->db->affected_rows() > 0 ){
                $this->add_track("sis_accion", $post['id'], $post, "update");
                return true;
            }
        }
    }


}
