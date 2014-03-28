<?php

if(isset($_REQUEST['execute_mode'])) {
    params_session();
    include("sai-run.php");
    //echo('<br>Session: <pre>'.print_r($_SESSION, 1).'</pre>');
} else {
		header('HTTP/1.1 403 Forbidden');
		print '<h1>Error: Access Denied<br/></h1>';
		die("You do not have access to this reports section.");
}

function params_session() {
		$_REQUEST['target_show_criteria'] 			= 0;
		$_REQUEST['show_print_button'] 				= 0;
		//
        $REPORTICO['project'] 						= "SAI";
        $REPORTICO['execute_mode']					= "EXECUTE";
        $REPORTICO['target_menu'] 					= ""; 
        //$REPORTICO['language']						= "es_es";
        $REPORTICO['firstTimeIn'] 					= ""; 
        $REPORTICO['latestRequest'] 				= $_REQUEST;
        $REPORTICO['template'] 						= "sai";
        $REPORTICO['reportico_template'] 			= "sai";
        $REPORTICO['forward_url_get_parameters'] 	= ""; 
        //$REPORTICO['linkbaseurl'] 					= "/../reports/run.php";
        $REPORTICO['loggedin'] 						= "1";
        //$REPORTICO['database'] = "";
        //$REPORTICO['hostname'] = "localhost";
        //$REPORTICO['driver'] = "";
        //$REPORTICO['server'] = "";
        //$REPORTICO['protocol'] = "";
        $REPORTICO['progress_text'] 				= "Ready";
        $REPORTICO['progress_status'] 				= "READY";
        $REPORTICO['target_format'] 				= "HTML";
        $REPORTICO['xmlin'] 						= $_REQUEST['xmlin'];
        $REPORTICO['xmlout'] 						= $_REQUEST['xmlout'];
        $REPORTICO['target_show_detail'] 			= 1;
        $REPORTICO['target_show_graph']				= 1;
        $REPORTICO['target_show_group_headers']		= 1;
        $REPORTICO['target_show_group_trailers'] 	= 1;
        $REPORTICO['target_show_column_headers'] 	= 1;
        //$REPORTICO['target_show_criteria'] 			= "0";
        $REPORTICO['run_ok'] 						= 1;
        $REPORTICO['show_refresh_button'] 			= 0;
        $REPORTICO['access_mode'] 					= 'ONEREPORT';//to hide admin and project buttons on template
        
        $_SESSION['reportico'] 						= $REPORTICO;
        
}
