<?php

function set_filter($list="", $fields=""){    
    unset($_SESSION[$list]['filter']);    
    if(!$list or !$fields) return;
        
    foreach($fields as $field =>$val)
       if((is_numeric($val) and  (int)$val> 0) or (!is_numeric($val) and $val!="")) $_SESSION[$list]['filter'][$field] = $val;     
}

function get_filter($list=""){
    if(!$list) return "";   
    $filter = isset($_SESSION[$list]['filter'])? $_SESSION[$list]['filter'] : null;
    return $filter;
}

function filter($list="", $field=""){
    if(!$list or !$field) return "";    
    return isset($_SESSION[$list]['filter'][$field])? $_SESSION[$list]['filter'][$field] : "";
}

function set_page($list="",$page=0){
    if(!$list) return;
    $_SESSION[$list]['page'] = (int)$page;
}

function get_page($list=""){
    if(!$list) return;
    return isset($_SESSION[$list]['page'])? (int)$_SESSION[$list]['page']: 0;
}

function clean_page($list=""){
    if(!$list) return;
    unset($_SESSION[$list]['page']);
}

function set_sort($list="", $field="", $order=""){
    if(!$list) return;
    $_SESSION[$list]['sort'] = array('sort'=>$field,'order'=>$order);
}

function get_sort($list){
    if(!$list) return;
    return isset($_SESSION[$list]['sort'])? $_SESSION[$list]['sort'] : null;
}

function clean_page_list($list=""){
    if(!$list) return;
    unset($_SESSION[$list]);
}

function paginator_config($row_total=0, $base_url ="", $per_page=20, $num_links=5, $uri_segment=4){
    $config['base_url'] = $base_url;//site_url("admin/ac_proceso/index");
    $config['total_rows'] = (int)$row_total;
    $config['per_page'] = (int)$per_page;
    $config['uri_segment'] = (int)$uri_segment;
    $config['num_links'] = (int)$num_links;
    $config['first_link'] = "&lsaquo; Primero";
    $config['last_link'] = "Ultimo &rsaquo;";
    $config['suffix'] = "";
    
    return $config;
}

function page_rango($total_rows=0, $per_page=0,$cur_page=0 ){
    
    if($total_rows<=$per_page){
        $str="Total de registros: ".$total_rows;
    }else{    
        $r1 = (($cur_page -1 ) * $per_page)+1;
        $r2 = $cur_page * $per_page;

        if($r2 > $total_rows) $r2 = $total_rows;

        $str="Registros: $r1 - $r2  de ".$total_rows;
    }
    return $str;
}

?>