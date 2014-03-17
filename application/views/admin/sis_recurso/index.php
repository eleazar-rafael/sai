<div class="panel">    
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message warning"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div style="float: left; padding: 5px 0 0 10px; font-size: 115%; font-weight: bold"><?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right">
            <ul>
                <?php /*<li><?php echo anchor("admin/producto/index"," regr",'class="ic-16 ic-arrow-out"')?></li>*/?>
                <li  class="p-add"><?php echo anchor("admin/sis_recurso/insert"," Agregar Recurso",'class="ic-16 ic-add"')?></li>                
            </ul>
        </div>

        <table class="table-list" >
        <thead>
            <tr>
                <?php /*<th width="40">Id</th> */?>
                <th width="60">Orden</th>
                <th>Nombre</th>	
                <th>Depende de</th>	
                <th>Link</th>                
                <th width="18" class="p-edit-view"></th>
                <th width="18" class="p-delete"></th>
            </tr>
        </thead>
        <tbody>        
        <?php if($arrInfo): ?>
            <?php foreach($arrInfo as $pos => $data):                    
                    $class = ($class == "even") ? "odd" : "even";   
            ?>
                <tr class="<?php echo $class?>" >
                    <?php /*<td><?php echo $data['id']?></td> */?>
                    <td align="center"><?php echo $data['orden']?></td>
                    <td align="left"><?php echo $data['nombre']?></td>
                    <td align="left"><?php echo $data['padre_nombre']?></td>
                    <td align="left"><?php echo $data['link']?></td>			
                    
                    <td class="p-edit-view">	
                        <?php echo anchor("admin/sis_recurso/update/$page/?id=".$data['id'], img("public/images/icons/page_white_edit.png"),'title="Editar Registro"')?>
                    </td>		
                    <td class="p-delete">
                        <a href="javascript:;" onclick="borrar('<?php echo $data['id']?>');"><img src="<?php echo base_url()?>public/images/icons/cross.png" title="Borrar Registro" ></a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else:?>	
            <tr>
                    <td colspan="6"> No se encontraron registros</td>
            </tr>	
        <?php endif;?>
        </tbody>
        </table>

    </div>    
    <?php echo $links?>    
</div>
        
<script type="text/javascript"><!--
    function filter() {
        $('#form').submit();        
    }
    $('#form input').keydown(function(e) {
        if (e.keyCode == 13) filter();            
    });
    function borrar(id){
        if(confirm('Desea borrar el registro seleccionado?')){
            location = '<?php echo site_url("admin/sis_recurso/delete/?id=")?>'+id;
        }
        
    }
//--></script>
