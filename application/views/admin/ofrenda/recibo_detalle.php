<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>

<?php echo $output?>

<script>
<?php if($this->uri->segment(5) == "add" ): ?>
    $("#field-recibo_id").val(<?php echo $recibo_id?>);    
    $("#field-fecha").val('<?php echo date('d/m/Y')?>')
<?php endif; ?>
    $("#recibo_id_field_box").hide();
    $(".ftitle").html("<?php echo $frm_titulo;?>")
</script>



