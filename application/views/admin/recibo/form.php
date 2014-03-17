<script type="text/javascript">var max_detalle = 0;</script>

<div class="breadcrumb"> 
    <?php echo $path_navegador?>
</div>

<div class="panel" >      
    <div class="panel-body">
        <?php if ($error_warning) { ?><div class="form-message warning"><?php echo $error_warning; ?></div><?php } ?>
        <?php if ($success) { ?><div class="form-message success"><?php echo $success; ?></div><?php } ?>
        <div class="titulo"><?php echo $heading_title; ?></div>
        <div class="panel-toolbar top clearfix right" >            
            <ul>      
                   
                <li><a href="javascript:;" onclick="btn_guardar(); " class="ic-16 ic-disk" title="">Guardar</a></li>   
                <li><?php echo anchor($cancel,"Regresar",'class="ic-16 ic-arrow-left"')?></li>
                
            </ul>
        </div>     
    
        <?php echo form_open($action,"id='form'");?>
        <div style="padding:10px;">        
            <?php if((int)$recibo['id'] > 0){ 
                    echo form_hidden("recibo[id]", $recibo['id']); 
                  }else{
                      echo form_hidden("recibo[iglesia_id]",$iglesia_id);
                      echo form_hidden("recibo[periodo_semanal_id]",$recibo['periodo_semanal_id']);
                      echo form_hidden("recibo[recibo_tipo_id]",$recibo['recibo_tipo_id']);
                      
                  }  
                    
            ?>            
            
            <table class="form" border="0">
                <tr>
                    <td width="160">Fecha</td>
                    <td>
                        <input type="text" name="recibo[fecha]" value="<?php echo $recibo['fecha']?>"  id="fecha"  style="width:100px" maxlength="200" >&nbsp;&nbsp;&nbsp;
                        
                        Num de recibo
                        <input type="text" name="recibo[recibo_numero]" value="<?php echo $recibo['recibo_numero']?>"  id="recibo_numero"  style="width:100px" maxlength="200" >
                    </td>
                    <td width="100">Monto Efectivo</td>
                    <td>
                        <input type="text" name="recibo[monto_efectivo]" value="<?php echo $recibo['monto_efectivo']?>"  id="monto_efectivo"  style="width:100px" maxlength="200" >
                    </td>
                </tr>
                <tr>
                    <td>Miembro</td>
                    <td>
                        <?php echo form_dropdown("recibo[persona_id]", $cbo_persona, $recibo['persona_id'],'id="persona_id" style="width:60%" ') ?>
                    </td>
                    <td>Monto Cheque</td>
                    <td>
                        <input type="text" name="recibo[monto_cheque]" value="<?php echo $recibo['monto_cheque']?>"  id="monto_cheque"  style="width:100px" maxlength="200" >
                    </td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td>
                        <input type="text" name="recibo[descripcion]" value="<?php echo $recibo['descripcion']?>"  id="descripcion"  style="width:60%" maxlength="200" >&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>Numero Cheque</td>
                    <td>
                        <input type="text" name="recibo[numero_cheque]" value="<?php echo $recibo['numero_cheque']?>"  id="numero_cheque"  style="width:100px" maxlength="200" >
                    </td>
                </tr>                
            </table>
        </div>
        
        <div id="frm-tabs">
            
                <div style="margin:0px 10px 0px 0; float:right">
                  <a href="javascript:btn_add_detalle();" class="" title="" ><?php echo img("public/images/icons/add.png")?> Agregar Concepto</a>
                </div>
                <div>&nbsp;&nbsp;<strong>Detalles del recibo</strong></div>

                <table class="table-list" id="tbl_detalle">
                    <thead>
                        <tr>
                            <?php if($recibo['recibo_tipo_id'] == 1): ?>
                                <th width="40%">Concepto Ofrenda</th>            
                            <?php elseif($recibo['recibo_tipo_id'] == 2):?>
                                <th width="30%">Concepto Gasto</th>
                                <th width="30%">Departamento</th>
                            <?php endif;?>
                            <th align="left">Monto</th>                            
                            <th width="80"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $max_detalle = 0;    
                        $total = 0;
                        if($recibo_detalle){
                            if($recibo['recibo_tipo_id'] == 1){
                                $det['cbo_ofrenda_tipo'] = $cbo_ofrenda_tipo;
                            }elseif($recibo['recibo_tipo_id'] == 2){
                                $det['cbo_gasto_tipo'] = $cbo_gasto_tipo;
                                $det['cbo_iglesia_departamento'] = $cbo_iglesia_departamento;
                            }
                            
                            foreach($recibo_detalle as $detalle){
                                $max_detalle++;
                                $det['max_detalle'] = $max_detalle;
                                $detalle['recibo_tipo_id'] =$recibo['recibo_tipo_id'];
                                $det['detalle'] = $detalle;
                                $total += $detalle['monto'];
                                $this->load->view("admin/recibo/form_detalle",$det);
                            }
                        }elseif($recibo['recibo_tipo_id'] == 1){
                            $det['cbo_ofrenda_tipo'] = $cbo_ofrenda_tipo;
                            $max_detalle++;
                            $det['max_detalle'] = $max_detalle;
                            $det['detalle'] = array('recibo_tipo_id'=>1,'ofrenda_tipo_id'=>1);                            
                            $this->load->view("admin/recibo/form_detalle",$det);
                            
                            $max_detalle++;
                            $det['max_detalle'] = $max_detalle;
                            $det['detalle'] = array('recibo_tipo_id'=>1,'ofrenda_tipo_id'=>8);
                            $this->load->view("admin/recibo/form_detalle",$det);
                            
                        }
                    ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" style="font-weight: bold; font-size: 14px;" <?php if($recibo['recibo_tipo_id'] == 2) echo 'colspan="2"'?> >
                                TOTAL
                            </td>
                            <td style="padding-left:10px;  font-weight: bold; font-size: 14px;" id="detalle_total">
                                <?php echo number_format($total,2);?>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            
            
        </div>                

        <?php echo form_close();?>
    
        <div style="padding: 10px; margin-left: 10px">
            <button class="button gray" onclick="btn_guardar();"><?php echo img("public/images/icons/disk.png")?> Guardar</button>
        </div>
    </div>    
</div>
<script  type="text/javascript">
    max_detalle = parseInt("<?php echo (int)$max_detalle?>");
        
    //$(document).ready(function(){  });
    
    function btn_guardar(){
        /*if($("#recibo_nombre").val() == "" ){
            alert('Por favor, teclee el nombre del recibo');
            $("#recibo_nombre").focus()
        }else{*/
            if(confirm('Guargar los cambios del recibo?')){
                $('#form').submit();
            }
        //}        
    }

    function rem_variable(nren){
        $("#tr_"+nren).remove();
        check_detalle_total();
    }
    
   
    function btn_add_detalle(){
        
        var var_url = "<?php echo site_url("admin/$controller/add_tr_detalle");?>";
        max_detalle++;
        
        $.get(var_url+"/<?php echo (int)$recibo['recibo_tipo_id'];?>/"+max_detalle, function(tr){
            $("#tbl_detalle > tbody:last").append(tr);
        });
    }
    
    function check_detalle_total(){
        var total = 0;
        var monto = 0;
        $("input.detalle-monto").each(function() {
            monto = form_numeric( $(this).val() );
            total +=  monto; //($(this).val())? parseFloat($(this).val()) : 0;
            if(monto > 0)$(this).val(form_currency(monto));
        });
        $("#detalle_total").html( form_currency(total) );
        $("#monto_efectivo").val( form_currency(total) );
    }

</script>
