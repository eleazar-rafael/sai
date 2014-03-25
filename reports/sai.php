<?php

//20140312-azlara-added- section to use SAI DB information
//require_once ('../application/config/database.php');
if(isset($_REQUEST['execute_mode'])) {
    params_session();
    //echo "<pre> --SALIENDO DEL SAI --";print_r($_SESSION); echo "</pre>";
    include("run.php");
}

function params_session() {
        //$_SESSION['execute_mode']="PREPARE";//EXECUTE
    
        $REPORTICO['execute_mode']="EXECUTE";
        $REPORTICO['project'] = "SAI";
        $REPORTICO['target_menu'] = ""; 
        $REPORTICO['language'] = "es_es";
        $REPORTICO['firstTimeIn'] = ""; 
        $REPORTICO['latestRequest'] = $_REQUEST;
        $REPORTICO['template'] = ""; 
        $REPORTICO['forward_url_get_parameters'] =""; 
        $REPORTICO['linkbaseurl'] = "/../reports/run.php";
        $REPORTICO['loggedin'] = "1";
        $REPORTICO['database'] = "";
        $REPORTICO['hostname'] = "localhost";
        $REPORTICO['driver'] = "";
        $REPORTICO['server'] = "";
        $REPORTICO['protocol'] = "";
        $REPORTICO['progress_text'] = "Ready";
        $REPORTICO['progress_status'] = "READY";
        $REPORTICO['target_format'] = "HTML";
        $REPORTICO['xmlin'] =  $_REQUEST['xmlin']; //$_REQUEST['reporte_xml'];
        $REPORTICO['xmlout'] = $_REQUEST['xmlout']; //$_REQUEST['reporte_xml'];
        $REPORTICO['target_show_detail'] = 1;
        $REPORTICO['target_show_graph'] = "";
        $REPORTICO['target_show_group_headers'] = 1;
        $REPORTICO['target_show_group_trailers'] = 1;
        $REPORTICO['target_show_column_headers'] = 1;
        $REPORTICO['target_show_criteria'] = 1;
        $REPORTICO['run_ok'] = 1;
        $REPORTICO['show_refresh_button'] = 0;
        //}
        
        $_SESSION['reportico'] = $REPORTICO;
}
