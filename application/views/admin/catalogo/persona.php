<?php echo $output?>
<?php
    
    $accion = $this->uri->segment(4);
        
?>
<script>
<?php if($accion == "add" ): ?>    
    $("#field-iglesia_id").val('<?php echo $iglesia_id?>');    
    $("#field-fecha_alta").val('<?php echo date("d/m/Y H:i:s")?>');   
    
         
<?php endif; ?>
    $("#iglesia_id_field_box").hide();
    $("#borrado_field_box").hide();
    $("#form-button-save").hide();
    $("#fecha_alta_field_box").hide();
    //$(".ftitle").html("<?php //echo $frm_titulo?>")
</script>

