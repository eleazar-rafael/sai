<div id="menu">    
    <ul class="left" style="display: none;">
        <li id="app" class=""><?php echo anchor("admin/app/index" ,"Principal", "class='top'")?></li>
        <?php echo $this->menu_model->get_menu_principal();?>        
    </ul>
</div>

<?php
    $seleccion = "app";     
    if($this->controller <> "app") $seleccion = $this->menu_model->get_seleccion($this->controller,$this->method, $this->var1);    
?>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('#menu > ul').superfish({
		hoverClass	 : 'sfHover',
		pathClass	 : 'overideThisToUse',
		delay		 : 900,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows   : false,
		dropShadows  : false,
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});

	$('#menu > ul').css('display', 'block');
        
        <?php if($seleccion):?>
            $("#<?php echo $seleccion?>").addClass("selected");
        <?php endif?>
        
});

//--></script> 


<?php /*<div id="menu">    
    <ul class="left" style="display: none;">
        <li id="app" class=""><?php echo anchor("admin/app/index" ,"Principal", "class='top'")?></li>        
        <li id="captura" class=""><?php echo anchor("admin/ofrenda/anual" ,"Proceso de Captura", "class='top'")?></li>
        <li id="catalogo">
            <a class="top">Catalogos</a>
            <ul>
                <li><?php echo anchor("admin/catalogo/iglesia" ,"Iglesias")?></li>
                <li><?php echo anchor("admin/catalogo/iglesia_departamento" ,"Departamentos")?></li>
                <li><?php echo anchor("admin/catalogo/persona" ,"Personas")?></li>
                <li><?php echo anchor("admin/catalogo/persona_tipo" ,"Tipo Personas")?></li>
                <li><?php echo anchor("admin/catalogo/ofrenda_tipo" ,"Tipo Ofrendas")?></li>
                <li><?php echo anchor("admin/catalogo/gasto_tipo" ,"Tipo Gastos")?></li>
            </ul>
        </li>
        <li id="cuenta">
            <a class="top">Cuentas</a>
            <ul>
                <li><?php echo anchor("admin/catalogo/cuenta" ,"Catalogo de Cuenta")?></li>
                <li><?php echo anchor("admin/catalogo/cuenta_tipo" ,"Tipos de Cuenta")?></li>
                <li><?php echo anchor("admin/catalogo/cuenta_accion_tipo" ,"Acciones de Cuentas")?></li>
                <li><?php echo anchor("admin/catalogo/cuenta_actividad" ,"Actividad de Cuentas")?></li>
            </ul>
        </li>
    </ul>
</div>*/?>

<?php /*
<div style="padding:0px;">
    <table width="100%" border="0" class="tbl-menu">
        <tr>                
            <th>IGLESIA</th>
            <th>PROCESOS</th>
            <th>CUENTAS</th>                
            <th>USUARIO</th>
        </tr>
        <tr>
            <td valign="top" width="25%">
                <a href='<?php echo site_url('admin/catalogo/iglesia')?>'>Iglesias</a> &nbsp;| &nbsp;  
                <a href='<?php echo site_url('admin/catalogo/iglesia_departamento')?>'>Departamentos</a> &nbsp;| &nbsp;
                <a href='<?php echo site_url('admin/catalogo/persona')?>'>Persona</a> &nbsp;| &nbsp;
                <a href='<?php echo site_url('admin/catalogo/persona_tipo')?>'>Persona Tipo</a> &nbsp;| &nbsp;
                <a href='<?php echo site_url('admin/catalogo/ofrenda_tipo')?>'>Ofrenda Tipo</a> 
            </td>
            <td valign="top" width="25%">                    
                <a href='<?php echo site_url('admin/ofrenda/anual')?>'>Proceso de Captura</a><br>

            </td>
            <td valign="top" width="25%">
                <a href='<?php echo site_url('admin/catalogo/cuenta')?>'>Catalogo de cuenta</a> &nbsp;| &nbsp; 
                <a href='<?php echo site_url('admin/catalogo/cuenta_tipo')?>'>Cuenta Tipo</a> &nbsp;| &nbsp; 
                <a href='<?php echo site_url('admin/catalogo/cuenta_accion_tipo')?>'>Cuenta Accion Tipo</a> &nbsp;| &nbsp; 
                <a href='<?php echo site_url('admin/catalogo/cuenta_actividad')?>'>Cuenta Actividad</a> &nbsp;| &nbsp; 
                <a href='<?php echo site_url('admin/catalogo/gasto_tipo')?>'>Gastos tipo</a>
            </td>
            <td valign="top">
                <a href='<?php echo site_url('app/logout')?>'>Salir del sitema</a><br>                    
            </td>
        </tr>
    </table>
</div> */?>
