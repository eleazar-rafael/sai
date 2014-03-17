<?php
class menu_model extends MY_Model{
    var $permisos = null;    
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }

    function get_menu_principal(){      
        
        /*if($_SESSION['menu']){
            $menu = $_SESSION['menu'];
        }else{*/
            $menu = $this->create_menu();
            $_SESSION['menu'] = $menu;
            $_SESSION['permisos'] = $this->permisos;
        //}
        //pre($menu); die();
        return $menu;
    }
    
    
    function create_menu(){
                
        $sql ="select * from sis_recurso where ifnull(borrado,0)=0 order by orden ";
        
        $perfil_id =(int)$this->user['perfil_id'];        
        if($perfil_id > 0)
            $sql = "select r.*, pr.permisos  
                    from sis_perfil_recurso pr 
                    inner join sis_recurso r on r.id = pr.recurso_id
                    where pr.perfil_id = $perfil_id and ifnull(r.borrado,0)=0 order by r.orden ";
        
        
        $query = $this->db->query($sql);
        
        $open_li = "<li>";$close_li = "</li>";
        $open_ul = "<ul>";$close_ul = "</ul>";
        $arr_padre_id =array(); 
        
        $arr_recurso = $query->result_array();     
        //pre($arr_recurso, '---arr_recurso---');
        $menu ="";
        if($query->num_rows >0 ){   
            $max_ren = $query->num_rows;
      
            //return false;
            for($ren = 0; $ren < $max_ren; $ren++){     
                               
                //DATOS DEL REGISTRO ACTUAL
                $cur_id = (int)$arr_recurso[$ren]['id'];
                $cur_padre_id = (int)$arr_recurso[$ren]['padre_id'];
                $cur_nombre = $arr_recurso[$ren]['nombre'];
                $cur_link = $arr_recurso[$ren]['link'];
                $cur_seleccion = $arr_recurso[$ren]['seleccion'];
                //$cur_acciones = $arr_recurso[$ren]['acciones'];
                //if(isset($arr_recurso[$ren]['permisos'])) 
                $cur_acciones =$arr_recurso[$ren]['permisos'];
                //DATOS DEL SIGUIENTE REGISTRO                
                $next_padre_id = (int)$arr_recurso[$ren+1]['padre_id'];
                
                //ULTIMO PADRE ID    
                $last_padre_id = (int)end($arr_padre_id);
                $nivel = count($arr_padre_id);
                
                //ASIGNACION DEL LINK                
                $s_link = $this->split_link($cur_link,$cur_acciones, $cur_seleccion);
                
                if(!$cur_link and $nivel==0 ){                    
                    $id = strtolower(str_replace(" ", "_", $cur_nombre));
                    $menu .= str_replace(">", " id=\"".$id."\" >", $open_li);                    
                    $menu .="<a class=\"top\" >$cur_nombre</a>";
                }else if($cur_link and $nivel == 0){                    
                    $menu .= str_replace(">", " id=\"".$s_link['controller']."\" >", $open_li);                    
                    $menu .=anchor($cur_link,$cur_nombre,"class='top' ");
                }else if(!$cur_link and $nivel > 0){
                    $menu .=$open_li."<a class=\"parent\">$cur_nombre</a>";
                }else if(!$cur_link){
                    $menu .=$open_li."<a>$cur_nombre</a>"; 
                }else{
                    $menu .=$open_li.anchor($cur_link,$cur_nombre); 
                } 
                    
                //LOGICA DE DISTRIBUCION DE ETIQUETAS
                //PREGUNTA SI EL SIGUIENTE PADRE SERA IGUAL EL ID DEL REGISTRO ALTUAL
                if($next_padre_id == $cur_id){                                         
                    $menu .=$open_ul;
                    $arr_padre_id[] = $cur_padre_id;
                    continue;
                //PREGUNTA SI EL ULTIMO Y EL SIGUIENTE PADRE SON IGUALES, SIEMPRE Y CUANDO EL ULTIMO PADRE SEA MAYOR A 0
                }else if($last_padre_id > 0 and $last_padre_id == $next_padre_id){                    
                    $menu .=$close_li.$close_ul.$close_li;
                    array_pop($arr_padre_id);
                    continue;
                //PREGUNTA SI EL SIGUIENTE PADRE == 0, SIEMPRE Y CUANDO EL NIVEL SEA > 0
                }else if( $nivel >0 and $next_padre_id == 0){
                    $menu .=$close_li;
                    for($p=0; $p < $nivel; $p++){
                        $menu .=$close_ul.$close_li;
                    }
                    $arr_padre_id = null;
                    continue;
                }else{
                    $menu .=$close_li;
                }
            }
        }
        
        //die();
                 
        return $menu;
    }
    
    function split_link($link="", $acciones="", $seleccion="" ){
        if($link){
            $tmp = explode("/", $link);        
            //pre($tmp);
            $arr_link = array('modulo'=>$tmp[0], 'controller'=>$tmp[1],'method'=>$tmp[2], 'var1'=>$tmp[3]);
            $this->set_permisos($arr_link, $seleccion);
        }
        $this->split_acciones($acciones, $seleccion);
        return $arr_link;
    }
    
    function split_acciones($acciones="", $seleccion=""){
        $arr_link = null;
        if($acciones){
            $arr_accion = (Array)json_decode($acciones);
            foreach($arr_accion as $pos=>$accion){
                $tmp = explode("/", $accion);
                $arr_link = array('modulo'=>$tmp[0], 'controller'=>$tmp[1],'method'=>$tmp[2], 'var1'=>$tmp[3]);
                $this->set_permisos($arr_link, $seleccion);                
            }
        }        
        return $arr_link;
    }
    
    
    function set_permisos($arr_link="", $seleccion=""){
        //pre($arr_link);
        $modulo = $arr_link['modulo'];  $controller = $arr_link['controller']; 
        $method = $arr_link['method']; $var1 = $arr_link['var1'];
        
        if($modulo and $controller and $method){
            $this->permisos[$modulo][$controller][$method][0]=1;
            $this->permisos[$modulo][$controller][$method]['seleccion'] = $seleccion;
        }else if($modulo and $controller){
            $this->permisos[$modulo][$controller]['index'][0]=1;
            $this->permisos[$modulo][$controller]['index']['seleccion'] = $seleccion;
        }else if($modulo and $controller and $method and $var1){
            $this->permisos[$modulo][$controller][$method][$var1][0]=1;
            $this->permisos[$modulo][$controller][$method][$var1]['seleccion'] = $seleccion;
        }
        
    }
    
    function get_seleccion($controller="", $method="", $var1=""){
        if($controller){
            if(!$method) $method = "index";
            
            if($var1 and !is_numeric($var1)){
                if(isset($_SESSION['permisos']['admin'][$controller][$method][$var1]))
                    return $_SESSION['permisos']['admin'][$controller][$method][$var1]['seleccion'];
            }            
            if(isset($_SESSION['permisos']['admin'][$controller][$method])){
                return $_SESSION['permisos']['admin'][$controller][$method]['seleccion'];
            }            
        }
        return false;
    }
    
    function permitir_link($controller="", $method="", $var1=""){
        
        if($controller){
            if(!$method) $method = "index";            
            if($var1 and !is_numeric($var1)){
                if(isset($_SESSION['permisos']['admin'][$controller][$method][$var1]))
                    return true;
            }            
            if(isset($_SESSION['permisos']['admin'][$controller][$method])){
                return true;
            }            
        }
        
        return false;
    }
    
}    
