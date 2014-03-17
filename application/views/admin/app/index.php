<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


        
<div class="panel" >      
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message warning"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div class="titulo">Bienvenido al Sistema de Administración de Iglesia<?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right" >            
            <?php /*
            <ul>      
                   
                <li><a href="javascript:;" onclick="btn_guardar(); " class="ic-16 ic-disk" title="">Guardar</a></li>   
                <li><?php echo anchor($cancel,"Regresar",'class="ic-16 ic-arrow-left"')?></li>
                
            </ul>*/?>
        </div>   
        <?php echo form_open("admin/app/update","id='form'");?>
        <div style="padding:10px;">
            <?php if($user_iglesia_id > 0):?>
                <input type="hidden" name="iglesia_id" value="<?php echo $user_iglesia_id?>" id="iglesia_id">
            <?php endif;?>
                        
            <table class="form" border="0">
                <?php if($user_iglesia_id == 0):?>
                <tr>
                    <td width="150">Iglesia</td>
                    <td>
                        <?php echo form_dropdown("iglesia_id",$cbo_iglesia, $conf['iglesia_id']," id='iglesia_id' onchange='check_periodo_anual();'");?>
                    </td>
                </tr>
                <?php endif;?>
                <tr>
                    <td width="150">Año Eclesiastico</td>
                    <td id="td_cbo_periodo_anual">
                        <?php echo form_dropdown("periodo_anual_id",$cbo_periodo_anual,$conf['periodo_anual_id']," id='periodo_anual_id' onchange='check_periodo_mensual();' ");?> 
                    </td>
                </tr>
                <tr>
                    <td>Periodo Mensual</td>
                    <td id="td_cbo_periodo_mensual">
                        <?php echo form_dropdown("periodo_mensual_id",$cbo_periodo_mensual,$conf['periodo_mensual_id']," id='periodo_mensual_id' onchange='check_periodo_semanal();' ");?> 
                    </td>
                </tr>
                <tr>
                    <td>Semana del mes</td>
                    <td id="td_cbo_periodo_semanal">
                        <?php echo form_dropdown("periodo_semanal_id",$cbo_periodo_semanal,$conf['periodo_semanal_id']," id='periodo_semanal_id' ");?>                        
                    </td>
                </tr>
            </table> 
            <button type="submit" style="margin:10px 0 0 158px">Establecer Periodos</button>
        </div> 
        <?php form_close()?>
    </div>    
</div>

<script>
    function check_periodo_anual(){
        $.get('<?php echo site_url("admin/app/ajax_cbo_periodo_anual")?>/'+$("#iglesia_id").val(), function( data ) {
            $("#td_cbo_periodo_anual" ).html( data );            
        });
    }
    
    function check_periodo_mensual(){
        $.get('<?php echo site_url("admin/app/ajax_cbo_periodo_mensual")?>/'+$("#periodo_anual_id").val(), function( data ) {
            $("#td_cbo_periodo_mensual" ).html( data );            
        });
    }
    
    function check_periodo_semanal(){
        $.get('<?php echo site_url("admin/app/ajax_cbo_periodo_semanal")?>/'+$("#periodo_mensual_id").val(), function( data ) {
            $("#td_cbo_periodo_semanal" ).html( data );
        });
    }
</script>