<tr id="tr_<?php echo $max_detalle?>">
    <td>
        <?php echo form_hidden("detalle_id[]", $detalle['id']);?>
        <?php
            if($detalle['recibo_tipo_id']==1){
                echo form_dropdown("detalle_ofrenda_tipo_id[]",$cbo_ofrenda_tipo,$detalle['ofrenda_tipo_id'],"style='width:95%'");
            }elseif($detalle['recibo_tipo_id']==2){
                echo form_dropdown("detalle_gasto_tipo_id[]",$cbo_gasto_tipo,$detalle['gasto_tipo_id'],"style='width:95%'");
            }
            
        ?>
    </td>
    
    <?php if($detalle['recibo_tipo_id']==2):?>
    <td>
        <?php echo form_dropdown("detalle_iglesia_departmento_id[]",$cbo_iglesia_departamento,$detalle['iglesia_departmento_id'],"style='width:95%'");?>
    </td>
    <?php endif;?>
    
    <td>
        <?php echo form_input("detalle_monto[]",$detalle['monto'],"style='width:150px' class='detalle-monto'  onblur='check_detalle_total();' ")?>
    </td>
    <td>
        <?php if( (int)$detalle['id'] > 0): ?>
            <input type="checkbox" name="detalle_borrar[<?php echo $detalle['id']?>]" value="1"> Borrar
        <?php else:?>
            <a href="###" onclick="rem_variable(<?php echo (int)$max_detalle?>)">[-]Remover</a>
        <?php endif;?>
    </td>
</tr>
