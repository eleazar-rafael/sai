<?php  
class MY_Model extends CI_Model {
    var $user;
    
    function __construct()
    {
        parent::__construct();            
        $this->user = $this->session->userdata("arrUser");
    }

    function add_track( $table, $id, $data, $action ){
        /*$user = $this->session->userdata("arrUser");
        $this->db->insert("sys_track",array('table'=>$table, 'row_id'=>$id, 'row_data'=>  json_encode($data) ,
                                            'action'=>$action, 'sys_user_id'=>$user['id']));*/
    }
    
    function get_cbo($table="", $select="id,nombre", $where="", $order_by="", $opInicial=""){
        $this->db->select($select,FALSE);
        if(is_array($where)) $this->db->where($where);        
        if($order_by) $this->db->order_by($order_by);
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        $arr = array();
        if($opInicial) $arr[] = $opInicial;
        if($query->num_rows >0 ) 
            foreach($query->result_array() as $row )
                $arr[$row['id']] = $row['nombre'];
        
        return $arr;
    }

}
