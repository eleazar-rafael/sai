<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>
<?php echo $output?>
<?php
    $accion =  ""; $mensual_id =0;
    if(is_numeric($this->uri->segment(4))){
        $mensual_id = $this->uri->segment(4);
        $accion = $this->uri->segment(5);
    }else{
        $accion = $this->uri->segment(4);
    }
    if($mensual_id == 0){
        $mensual_id = $periodo_mensual_id;
    }
?>


<script>
<?php if($accion == "add" ): ?>    
    $("#field-iglesia_id").val('<?php echo $iglesia_id?>');    
    $("#field-fecha_alta").val('<?php echo date("d/m/Y H:i:s")?>');   
    $("#field-periodo_mensual_id").val('<?php echo $mensual_id?>');
    $("#field-periodo_estatus_tipo_id").val('1');
         
<?php endif; ?>
    $("#iglesia_id_field_box").hide();
    $("#borrado_field_box").hide();
    $("#fecha_alta_field_box").hide();
    $("#form-button-save").hide();
    
    $("#field-codigo").attr("style","width:150px;");
    $("#field-codigo").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner A&ntilde;o-Mes-Semana, Ejemplo: <?php echo date("Y")?>-03-S1 <span>");
    $("#field-nombre").attr("style","width:150px;");
    $("#field-nombre").after("<span style='margin-left:20px; font-size:13px;'>Se suguiere poner el N&uacute;mero de la Semana, Ejemplo: Semana 1<span>");
    $("#field-descripcion").after("<span style='margin-left:20px; font-size:13px;'>Una descripcion o nota a criterio personal<span>");
    $("#fecha_inicial_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Inicial del la semana, empezando por Domingo<span>");
    $("#fecha_final_input_box").after("<span style='margin-left:20px; padding-top:10px; font-size:13px;'>Fecha Final del semana, terminando con el Sabado<span>");
    
    $(".ftitle").html("<?php echo $frm_titulo?>")
</script>

