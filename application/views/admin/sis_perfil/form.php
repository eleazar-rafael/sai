<style>
    .op-principal{font-weight: bold; font-size: 103%!important}
    tr.tr-menu-principal td{ background: #d0d0d0; border:solid 1px #a0a0a0  } 
</style>
<div class="panel">       
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message warning"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div style="float: left; padding: 5px 0 0 10px; font-size: 115%; font-weight: bold"><?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right" >            
            <ul>
                <?php $css_save = ((int)$sis_perfil['id'] > 0)? "p-edit":"p-add" ?>
                <li class="<?php echo $css_save?>" ><a href="javascript:;" onclick="btn_guardar(); " class="ic-16 ic-disk" title="">Guardar</a></li>                
                <li><?php echo anchor($cancel,"Regresar",'class="ic-16 ic-arrow-left"')?></li>                
            </ul>
        </div>
        <div style="padding:10px;">
            <?php echo form_open($action,"id='form'" );?>
            <?php if((int)$sis_perfil['id'] > 0 ):?>
                <input type="hidden" name="sis_perfil[id]" value="<?php echo $sis_perfil['id'];?>">
            <?php endif;?>
            <table id='tbl_form' class="backform">
            <tr>
                <td width="150">Nombre</td>
                <td><?php echo form_input("sis_perfil[nombre]", $sis_perfil['nombre']," id='nombre' size ='65' " )?></td>
            </tr>
            <tr>
                <td >Orden num&eacute;rico</td>
                <td><?php echo form_input("sis_perfil[pos]", $sis_perfil['pos']," id='nombre' size ='10' " )?></td>
            </tr>
            </table>
                
            <?php if($opciones):?>    
            <h3>Opciones del Perfil</h3>
            <table id='tbl_form' class="table-list" style="width: 800px!important">            
                <thead>
                    <tr>
                        <td width="60"></td>
                        <td width="60">Orden</td>
                        <td>Opci&oacute;n</td>
                        <?php foreach($sis_acciones as $accion):?>
                        <td width="60"><?php echo $accion['nombre']?></td>
                        <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
                <?php $opcion_raiz = 0;  ?>
                <?php foreach($opciones as $pos=> $opcion):
                        $class = ($class == "even") ? "odd" : "even";
                        $padre_id = (int)$opcion['padre_id'];                        
                        
                        //$json_accion = array(); if($opcion['acciones']) $json_accion = (array)json_decode($opcion['acciones']);
                        $json_accion =  $this->sis_perfil_model->json_arr_acciones( $opcion['acciones'] ); 
                        $class_op = ""; if($padre_id==0 or !$opcion['link'] )  $class_op="op-principal";
                        
                        $class_orden =""; $class_tr ="";
                        if(((int)$opcion['orden'] % 1000) ==0 ){ $class_orden="op-principal";$class_tr="tr-menu-principal"; }
                        $css_raiz = ""; if($padre_id >0 ) $css_raiz ="recurso-raiz-$opcion_raiz"; 
                        
                        $onclick = "$('.recurso-".$opcion['id']."').attr('checked', this.checked);";
                        if($padre_id == 0 ) $onclick .=" $('.recurso-raiz-".$opcion['id']."').attr('checked', this.checked);";
                        
                        $arr_permiso = ($sis_perfil_recurso[$opcion['id']]['permisos'])? (array)json_decode($sis_perfil_recurso[$opcion['id']]['permisos']) : null;
                        $checked = ($sis_perfil_recurso[$opcion['id']])? "checked" :"";
                    ?>
                    <tr class="<?php echo $class." ".$class_tr?>">
                        <td align="center">
                            <input type="checkbox" name="recurso_id[<?php echo $opcion['id']?>]" value="<?php echo $opcion['id']?>" 
                                   id="recurso_<?php echo $opcion['id']?>" onclick="<?php echo $onclick?>" 
                                   class="<?php echo $css_raiz?>" <?php echo $checked;?> > 
                        </td>
                        <td class="<?php echo $class_orden?>" align="center"><?php echo $opcion['orden']?></td>
                        <td class="<?php echo $class_op?>">                            
                            <?php 
                                $ident = ""; if($padre_id > 0 )$ident =  "&raquo;";
                                
                                
                                echo $ident.$opcion['nombre'];
                                if($opcion['link']) echo " (".$opcion['link'].")";                                
                            ?>                        
                        </td>
                        <?php foreach($sis_acciones as $accion):
                                $checked = ($arr_permiso[$accion['codigo']])? "checked":"";
                            ?>
                        <td align="center">
                            
                            <?php if(isset($json_accion[$accion['codigo']])): ?>
                            <input type="checkbox" name="permisos[<?php echo $opcion['id']?>][<?php echo $accion['codigo']?>]" 
                                   value="<?php echo $json_accion[$accion['codigo']]?>"
                                   class="recurso-<?php echo $opcion['id']?> <?php echo $css_raiz?>" <?php echo $checked?> >                               
                            <?php endif;?>
                        
                        </td>
                        <?php endforeach;?>
                    </tr>
                <?php if( (int)$opcion['padre_id'] ==0 )$opcion_raiz = $opcion['id']?>    
                <?php endforeach;?>
                </tbody>                        
            </table>
            <?php endif;?>
            
            
            <?php echo form_close();?>
        </div>            
        <div style="padding: 10px; margin-left: 160px">
            <button class="button gray <?php echo $css_save?>" onclick="btn_guardar();"><?php echo img("public/images/icons/disk.png")?> Guardar</button>
        </div>
    </div>
</div>         
<?php //pre($sis_perfil_recurso)?>

<script>
    
    function btn_guardar(){
        if($("#nombre").val() == "" ){
            alert('Por favor, teclee el nombre del Perfil');
            $("#nombre").focus()
        }else{
            if(confirm('Guargar los cambios del Perfil?')){
                $('#form').submit();
            }
        }
    }

</script>
