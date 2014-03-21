<?php

//20140312-azlara-added- section to use SAI DB information
//require_once ('../application/config/database.php');
if(isset($_REQUEST['execute_mode'])) {
    params_session();
    include("run.php");
}

function params_session() {
        //$_SESSION['execute_mode']="PREPARE";//EXECUTE
    //if($_REQUEST){
        //$_SESSION['project'] = "SAI";
        $_SESSION['reportico']['project'] = "SAI";
        $_SESSION['reportico']['target_menu'] = ""; 
        $_SESSION['reportico']['language'] = "es_es";
        $_SESSION['reportico']['firstTimeIn'] = ""; 
        $_SESSION['reportico']['latestRequest'] = $_REQUEST;
        //$_SESSION['template'] = ""; 
        $_SESSION['forward_url_get_parameters'] =""; 
        //$_SESSION['linkbaseurl'] = "/../reports/run.php";
        $_SESSION['loggedin'] = "1";
        //$_SESSION['database'] = "";
        //$_SESSION['hostname'] = "localhost";
        //$_SESSION['driver'] = "";
        //$_SESSION['server'] = "";
        //$_SESSION['protocol'] = "";
        $_SESSION['progress_text'] = "Ready";
        $_SESSION['progress_status'] = "READY";
        //$_SESSION['target_format'] = "HTML";
        $_SESSION['xmlin'] =  $_REQUEST['xmlin']; //$_REQUEST['reporte_xml'];
        $_SESSION['xmlout'] = $_REQUEST['xmlout']; //$_REQUEST['reporte_xml'];
        $_SESSION['target_show_detail'] = 1;
        $_SESSION['target_show_graph'] = "";
        $_SESSION['target_show_group_headers'] = 1;
        $_SESSION['target_show_group_trailers'] = 1;
        $_SESSION['target_show_column_headers'] = 1;
        $_SESSION['target_show_criteria'] = 1;
        $_SESSION['run_ok'] = 1;
        $_SESSION['show_refresh_button'] = 0;
        //}
}
