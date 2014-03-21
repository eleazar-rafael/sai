<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>
<?php echo $output?>
<script>
<?php if($this->uri->segment(4) == "add" ): ?>    
    $("#field-iglesia_id").val('<?php echo $iglesia_id?>');    
    $("#field-fecha_alta").val('<?php echo date("d/m/Y H:i:s")?>'); 
    $("#field-periodo_estatus_tipo_id").val('1');
    //$("#field-periodo_semanal_id").val('<?php //echo $semanal_id?>');
    
    //$("#field-fecha").val('<?php echo date("d/m/Y")?>')        
<?php endif; ?>
    $("#iglesia_id_field_box").hide();
    $("#borrado_field_box").hide();
    $("#fecha_alta_field_box").hide();
    $("#form-button-save").hide();
    
    $("#field-codigo").attr("style","width:200px;");
    $("#field-codigo").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner el A&ntilde;o, Ejemplo: <?php echo date("Y")?><span>");
    $("#field-nombre").attr("style","width:200px;");
    $("#field-nombre").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner A&ntilde;o Eclesiastico + A&ntilde;o  , Ejemplo: A&ntilde;o Eclesiastico <?php echo date("Y")?><span>");
    $("#field-descripcion").after("<span style='margin-left:20px; font-size:13px;'>Una descripci&oacute;n o nota a criterio personal<span>");
    
    $("#fecha_inicial_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Inicial del A&ntilde;o, Ejemplo: 01/01/<?php echo date("Y")?><span>");
    $("#fecha_final_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Final del A&ntilde;o, Ejemplo: 31/12/<?php echo date("Y")?><span>");
    
    $("#field-folio_ofrenda").attr("style","width:150px;");
    $("#folio_ofrenda_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Consecutivo del folio de Recibo para sobres de ofrendas, Ejemplo: 100 <span>");
    $("#field-folio_gasto").attr("style","width:150px;");
    $("#folio_gasto_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Consecutivo del folio de Recibo de gastos, Ejemplo: 50<span>");
    
    
    $(".ftitle").html("<?php echo $frm_titulo?>")
</script>