<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>
<?php echo $output?>

<script>
<?php if($this->uri->segment(6) == "add" ): ?>
    $("#field-iglesia_id").val(<?php echo $iglesia_id?>);    
    $("#field-periodo_semanal_id").val('<?php echo $semanal_id?>');
    $("#field-recibo_tipo_id").val('<?php echo $recibo_tipo_id?>');
    $("#field-fecha").val('<?php echo date("d/m/Y")?>')        
<?php endif; ?>
    $("#iglesia_id_field_box").hide();
    $("#periodo_semanal_id_field_box").hide();
    $("#recibo_tipo_id_field_box").hide();
    $(".ftitle").html("<?php echo $frm_titulo?> ")
    
    $(document).ready(function(){
        
        $("a.add_button").attr("href", "<?php echo site_url("admin/$controller/insert/?recibo_tipo_id=$recibo_tipo_id&periodo_semanal_id=$semanal_id")?>");
    });
    
</script>
