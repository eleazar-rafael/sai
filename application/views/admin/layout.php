<!doctype html>
<html lang="es">
<head>
    <title>SAI - Administrador</title>
    <meta charset="utf-8"/>
    <script type="text/javascript">
        var base_url = '<?php echo base_url()?>';        
        var admin_url = "<?php echo site_url()?>/admin/"        
    </script> 
    <?php foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" /> 
    <?php endforeach; ?>

    <?php foreach($js_files as $file): ?> 
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
    <?php      
        $theme_ui = "smoothness";
        $theme="mws"; 
        echo link_tag("public/jquery/d-bundle/themes/".$theme_ui."/jquery.ui.all.css");        
        echo link_tag("public/theme/$theme/css/style.css");                
        echo link_tag("public/theme/$theme/css/theme.css");
        
        echo link_tag("public/theme/$theme/css/icons/16x16.css");
        echo link_tag("public/theme/$theme/css/icons/24x24.css");
        echo $css;      
        if(!$js_files) echo script_tag("public/jquery/js/jquery-1.8.2.min.js");
        
        echo script_tag("public/jquery/plugins/jquery.currency.min.js");
        echo script_tag("public/jquery/plugins/superfish/js/superfish.js");
        echo $script;
    ?>    
        
        
        
    <?php      
    /*
        $theme = "default";
        $theme_ui = "smoothness";
        echo link_tag("public/jquery/jquery-ui/themes/".$theme_ui."/jquery-ui.css"); 
        echo link_tag("public/theme/$theme/css/style.css");                
        echo link_tag("public/theme/$theme/css/theme.css");        
        echo link_tag("public/theme/$theme/css/icons/16x16.css");         
        echo $css;     
        echo $permiso_css;        
        echo script_tag("public/jquery/jquery-1.8.2.min.js");
        echo script_tag("public/jquery/plugins/superfish/js/superfish.js");
        echo $script;*/
    ?>	
    <style type='text/css'>
        body{/*font-family: Arial;font-size: 12px;*/}
        a{color: blue;text-decoration: none;font-size: 12px;}
        a:hover{text-decoration: underline;}
        .tbl-menu{border-collapse: collapse}
        .tbl-menu td,.tbl-menu th {border: solid 1px #C2CBE0}
        .tbl-menu td {padding: 5px;}
        .tbl-menu td a{color: #000; text-decoration: underline;}
        /*.btn-detalle{ border: solid 1px #c0c0c0; padding:3px;}*/
        .breadcrumb{margin:5px 0px; padding: 5px; background: #F2F2F2; /*border: solid 1px #c0c0c0;*/ border-left: none; border-right: none;}
        
    </style>
</head>
<body>
   <div id="header"   class="clearfix">				
        <div id="logo-container" >
                <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
                <div id="mws-logo-wrap" ><?php echo img(array('src'=>"public/images/logo_iasd.jpg", 'height'=>'45','style'=>'margin-top:5px;'))?></div>
                
        </div>    
       <div style="float: left; padding-left:10%; padding-top: 10px; font-weight: bold; font-size: 135%">
           <?php /*SISTEMA DE ADMINISTRACION DE IGLESIA V 0.0.1 [SAI] */?>
           Sistema de Administraci&oacute;n de Iglesia V 0.0.1 ( SAI )
       </div>
        <div id="user-tools" class="clearfix">
            <div id="user-info" class="">
                <?php /*
                <div id="user-photo">
                        <img src="example/profile.jpg" alt="User Photo" />
                </div>*/?>
                
                <?php /*echo img("public/images/icons/application_side_contract.png")?>&nbsp;<?php echo anchor("admin/app/logout","Salir") */?>
                <div id="user-functions">
                    <div id="username">
                        <b><?php echo $arrUser['nombre'].' '.$arrUser['apellidos']?></b>
                    </div>
                    <ul>
                        <?php /*<li><a href="#">Mi Perfil</a></li>
                        <li><a href="#">Change Password</a></li>*/?>
                        <li><?php echo anchor("app/logout", img("public/images/icons/disconnect.png")." Salir del sistema")?></li>
                    </ul>
                </div>
            </div>    
        </div>
       
    </div> 
    <?php $this->load->view("admin/menu");?>
    
    <div id="content">         
            <?php echo $msg?>
            <?php echo $layout_content?>
    </div>
    
    <div id="dialog" title="Basic dialog" style="display: none;"></div>
    
    <?php /*
    <div id="wrapper">
        <h3 style="text-align:center">SISTEMA DE ADMINISTRACION DE IGLESIA V 0.0.1</h3>
        <?php $this->load->view("admin/menu");?>

        <div id="content-admin">
            
                <?php echo $msg?>
                <?php echo $layout_content?>
        </div>
    </div> */?>
      
    <script>
        function form_currency(amount)
        {
            $("#temp_currency").html(amount);            
            $("#temp_currency").currency({c:2});
            return $("#temp_currency").html();
        }
        
        function form_numeric(text_number)
        {
            var number = text_number.replace(/\,/g, "");
            if($.isNumeric(number)) return parseFloat(number);
            return 0;
        }
        //$(".form-message").click(function(){ $(this).fadeOut() })
    </script>
    <span id="temp_currency" style="display:none;"></span> 
</body>
</html>