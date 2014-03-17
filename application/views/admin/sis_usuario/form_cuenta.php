<style>
    .op-principal{font-weight: bold; font-size: 103%!important}
    tr.tr-menu-principal td{ background: #d0d0d0; border:solid 1px #a0a0a0  } 
</style>
<div class="panel">       
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message error"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div style="float: left; padding: 5px 0 0 10px; font-size: 115%; font-weight: bold"><?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right" >            
            <ul>
                <li><a href="javascript:;" onclick="btn_guardar(); " class="ic-16 ic-disk" title="">Guardar</a></li>                
                <?php /*<li><?php echo anchor($cancel,"Regresar",'class="ic-16 ic-arrow-left"')?></li>     */?>           
            </ul>
        </div>
        <div style="padding:10px;">
            <?php echo form_open($action,"id='form'" );?>
            <?php if((int)$usuario['id'] > 0 ):?>
                <input type="hidden" name="usuario[id]" value="<?php echo $usuario['id'];?>">
            <?php endif;?>
            <table id='tbl_form' class="backform">
            <tr>
                <td width="150">Nombre Completo</td>
                <td><?php echo form_input("usuario[nombre]", $usuario['nombre']," id='nombre' size ='65' " )?></td>
            </tr>
            <tr>
                <td >Email</td>
                <td><?php echo form_input("usuario[email]", $usuario['email']," id='email' size ='65' " )?></td>
            </tr>
            <tr>
                <td >Perfil</td>
                <td><b><?php echo $cbo_perfil[$usuario['perfil_id']]; //echo form_dropdown("usuario[perfil_id]", $cbo_perfil, $usuario['perfil_id']," id='perfil_id' " )?></b></td>
            </tr>
            </table>
                
            <h3>Cambiar Password </h3>   
            
            <table id='tbl_form' class="backform">
            <tr>
                <td width="150">Usuario</td>
                <td><b><?php echo $usuario['username']; //echo form_hidden("usuario[username]", $usuario['username']," id='username'  " )?></b></td>
            </tr>
            <tr>
                <td >Contrase&ntilde;a</td>
                <td><?php echo form_password("usuario[password]", $usuario['password']," id='password' size ='65' " )?></td>
            </tr>
            <tr>
                <td >Confirmar contrase&ntilde;a</td>
                <td><?php echo form_password("confirmar_password", $usuario['password']," id='confirmar_password' size ='65' " )?></td>
            </tr>
            </table>
                
                
            <?php echo form_close();?>
        </div>            
        <div style="padding: 10px; margin-left: 160px">
            <button class="button gray" onclick="btn_guardar();"><?php echo img("public/images/icons/disk.png")?> Guardar</button>
        </div>
    </div>
</div>         
<?php //pre($usuario_recurso)?>

<script>
    
    function btn_guardar(){
        if($("#nombre").val() == "" ){
            alert('Por favor, teclee el nombre completo del usuario');
            $("#nombre").focus();
        }/*else if($("#perfil_id").val() == 0 ){
            alert('Por favor, seleccione el Perfil');
            $("#perfil_id").focus();        
        }else if($("#username").val() == "" ){
            alert('Por favor, teclee el nombre de usuario');
            $("#username").focus();        
        }*/else if($("#password").val() == "" ||  $("#confirmar_password").val() == "" ){            
            alert('Por favor, teclee la contrase\u00f1a  y la confirmaci\u00f3n. Minimo 6 caracteres');
            if($("#password").val() == "" ) $("#password").focus(); else  $("#confirmar_password").focus();
            
        }else if($("#password").val() !=  $("#confirmar_password").val() ){
            alert('La contrase\u00f1a y la confirmaci\u00f3n no coinciden, favor de verificar');
            $("#confirmar_password").focus();            
        }else if($("#password").val().length < 6 ){
            alert('La contrase\u00f1a tiene menos de 6 caracteres');
            $("#password").focus();            
        }
        else{
            if(confirm('Guargar los cambios del usuario?')){
                $('#form').submit();
            }
        }
    }

</script>
