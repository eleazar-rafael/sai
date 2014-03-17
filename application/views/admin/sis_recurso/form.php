<div class="panel">       
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message warning"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div style="float: left; padding: 5px 0 0 10px; font-size: 115%; font-weight: bold"><?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right" >            
            <ul>               
                <?php $css_save = ((int)$sis_recurso['id'] > 0)? "p-edit":"p-add" ?>
                <li class="<?php echo $css_save?>"><a href="javascript:;" onclick="btn_guardar(); " class="ic-16 ic-disk" title="">Guardar</a></li>                
                <li><?php echo anchor($cancel,"Regresar",'class="ic-16 ic-arrow-left"')?></li>                
            </ul>
        </div>  
        <div style="padding:10px;">

            <?php echo form_open($action,"id='form'" );?>
            <?php if((int)$sis_recurso['id'] > 0 ):?>
                <input type="hidden" name="sis_recurso[id]" value="<?php echo $sis_recurso['id'];?>">
            <?php endif;?>
            <table id='tbl_form' class="backform">
            <tr>
                <td width="150">Nombre</td>
                <td><?php echo form_input("sis_recurso[nombre]", $sis_recurso['nombre']," id='nombre' size ='65' " )?></td>
            </tr>
            <tr>
                <td>Link</td>
                <td><?php echo form_input("sis_recurso[link]",$sis_recurso['link'], " size='65' ") ?></td>
            </tr>            
            <tr>
                <td>Depende de</td>
                <td><?php echo form_dropdown("sis_recurso[padre_id]",$cbo_padre, $sis_recurso['padre_id'], " id='padre_id' ") ?></td>
            </tr>
            <tr>
                <td>Orden</td>
                <td><?php echo form_input("sis_recurso[orden]",$sis_recurso['orden'], " size='15' ") ?></td>
            </tr>
            <tr>
                <td>Selecci&oacute;n menu</td>
                <td><?php echo form_input("sis_recurso[seleccion]",$sis_recurso['seleccion'], " size='15' ") ?></td>
            </tr>
            </table>            
            <?php if($sis_acciones):
                    /*$json_accion = array();
                    if($sis_recurso['acciones']) $json_accion = (array)json_decode($sis_recurso['acciones']);
                    $arr_accion = array();
                    if($json_accion) foreach($json_accion as $val) $arr_accion[$val] = $val;*/
                    //pre($arr_accion);
                $arr_accion = $this->sis_recurso_model->json_arr_acciones( $sis_recurso['acciones'] );
                ?>
                <h3>Acciones del Recurso</h3>
                <div style="border:solid 0px #c0c0c0; padding: 10px; width: 450px">
                <?php foreach($sis_acciones as $accion):
                        $checked = ($arr_accion[$accion['codigo']])? true: false;
                    ?>
                    <div style="padding:0px 10px; float:left;width: 130px"> 
                        <?php echo form_checkbox("acciones[]",$accion['codigo'],$checked)?><?php echo $accion['nombre']?>                    
                    </div>                
                <?php endforeach;?>
                    <div style="clear:both"></div>
                </div>
            <?php endif;?>
            
            
            <?php echo form_close();?>
        </div>            
        <div style="padding: 10px; margin-left: 160px">
            <button class="button gray <?php echo $css_save?>" onclick="btn_guardar();"><?php echo img("public/images/icons/disk.png")?> Guardar</button>
        </div>
    </div>
</div>         


<script>
    
    function btn_guardar(){
        if($("#nombre").val() == "" ){
            alert('Por favor, teclee el nombre del recurso');
            $("#nombre").focus()
        }else{
            if(confirm('Guargar los cambios del Recurso?')){
                $('#form').submit();
            }
        }
    }

</script>
