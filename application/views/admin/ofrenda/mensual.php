<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>
<?php echo $output?>
<?php
    $accion =  ""; $anual_id =0;
    if(is_numeric($this->uri->segment(4))){
        $anual_id = $this->uri->segment(4);
        $accion = $this->uri->segment(5);
    }else{
        $accion = $this->uri->segment(4);
    }
    if($anual_id == 0){
        $anual_id = $periodo_anual_id;
    }
?>


<script>
<?php if($accion == "add" ): ?>    
    $("#field-iglesia_id").val('<?php echo $iglesia_id?>');    
    $("#field-fecha_alta").val('<?php echo date("d/m/Y H:i:s")?>');   
    $("#field-periodo_anual_id").val('<?php echo $anual_id?>');
    $("#field-periodo_estatus_tipo_id").val('1');
    //$("#field-fecha").val('<?php echo date("d/m/Y")?>')        
<?php endif; ?>
    $("#iglesia_id_field_box").hide();
    $("#borrado_field_box").hide();
    $("#fecha_alta_field_box").hide();
    $("#form-button-save").hide();
    
    $("#field-codigo").attr("style","width:150px;");
    $("#field-codigo").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner A&ntilde;o-Mes, Ejemplo: <?php echo date("Y")?>-03<span>");
    $("#field-nombre").attr("style","width:150px;");
    $("#field-nombre").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner el Nombre del Mes + A&ntilde;o, Ejemplo: Marzo <?php echo date("Y")?><span>");
    $("#field-descripcion").after("<span style='margin-left:20px; font-size:13px;'>Una descripcion o nota a criterio personal<span>");
    $("#fecha_inicial_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Inicial del Mes<span>");
    $("#fecha_final_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Final del Mes<span>");
    
    $(".ftitle").html("<?php echo $frm_titulo?>")
</script>

<?php //echo " [periodo_anual_id] ".$periodo_anual_id." [anual_id]$anual_id "?>