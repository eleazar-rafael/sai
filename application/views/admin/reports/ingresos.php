<h1 class="swTitle"><?php echo($title); ?></h1>
<form action="<?php echo base_url()?>reports/sai.php" method="POST" name="topmenu" id="criteriaform" class="swPrpForm" target="_blank">
  <input type="hidden" value="1" name="user_criteria_entered">
  <input type="hidden" value="0" name="target_show_criteria">
  <input type="hidden" value="1" name="target_show_group_headers">
  <input type="hidden" value="1" name="target_show_detail">
  <input type="hidden" value="1" name="target_show_group_trailers">
  <input type="hidden" value="1" name="target_show_column_headers">
  <input type="hidden" value="<?php echo($iglesia_id); ?>" name="MANUAL_Iglesia">
  <input type="hidden" value="<?php echo($xml); ?>" name="xmlin">
  <input type="hidden" value="<?php echo($xml); ?>" name="xmlout">
  <input type="hidden" value="EXECUTE" name="execute_mode">
  <input type="hidden" value="0" name="show_refresh_button">
  <!-- input type="radio" checked="" value="TABLE" name="target_style" id="rpt_style_detail">
  <input type="radio" value="FORM" name="target_style" id="rpt_style_form" -->
  <table id="critbody" class="swPrpCritBox">
    <tbody>
      <tr>
        <td>
          <!-- div style="width: 35%; float: left; vertical-align: bottom;text-align: right" class="swPrpToolbarPane">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Generate JSON Report" class="prepareAjaxExecute swJSONBox">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Generate XML Output" style="margin-left: 20px" class="prepareAjaxExecute swXMLBox">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Generate CSV Report" class="prepareAjaxExecute swCSVBox">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Generate PDF Report" class="prepareAjaxExecute swPDFBox">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Generate HTML Report" class="prepareAjaxExecute swHTMLBox">
            <input type="submit" value="" name="submitPrepare" id="prepareAjaxExecute" title="Printable HTML" style="margin-right: 30px" class="prepareAjaxExecute swPrintBox">
          </div -->
          <!-- div style="width: 50%; padding-top: 15px;float: left;vertical-align: bottom;text-align: center"> <b>Show</b> </div -->
		</td>
      </tr>
    </tbody>
  </table>
  <div id="criteriabody">
    <table cellpadding="0" class="swPrpCritBox">
<!---->
		<tbody><tr id="swPrpCriteriaBody">
			<td class="swPrpCritEntry">
			<!-- div id="swPrpSubmitPane">
    				<input type="submit" value="Go" name="submitPrepare" id="prepareAjaxExecute" class="prepareAjaxExecute swHTMLGoBox">
    				<input type="submit" value="Reset" name="clearform" class="reporticoSubmit">
                    &nbsp;
			</div -->

                <table class="swPrpCritEntryBox">
                    <tbody>
                    <tr id="criteria_Fecha" class="swPrpCritLine">
                        <td class="swPrpCritTitle">
                            Fecha                        </td>
                        <td class="swPrpCritSel">
                            <input type="hidden" value="2014-03-14" maxlength="0" size="0" name="HIDDEN_Fecha_FROMDATE"><input type="text" value="2014-03-14" maxlength="20" size="20" name="MANUAL_Fecha_FROMDATE" id="swDateField_Fecha_FROMDATE" class="swDateField hasDatepicker">&nbsp;- <input type="hidden" value="2014-03-14" maxlength="0" size="0" name="HIDDEN_Fecha_TODATE"><input type="text" value="2014-03-14" maxlength="20" size="20" name="MANUAL_Fecha_TODATE" id="swDateField_Fecha_TODATE" class="swDateField hasDatepicker">                        </td>
                        <td class="swPrpCritExpandSel">                        </td>
                    </tr>
                    <tr id="criteria_Recibo" class="swPrpCritLine">
                        <td class="swPrpCritTitle">
                            Recibo                        </td>
                        <td class="swPrpCritSel">
                            <input type="text" value="" size="50%" name="MANUAL_Recibo" class="swPrpTextField">                        </td>
                        <td class="swPrpCritExpandSel">                        </td>
                    </tr>
                    <tr id="criteria_Cheque" class="swPrpCritLine">
                        <td class="swPrpCritTitle">
                            Cheque                        </td>
                        <td class="swPrpCritSel">
                            <input type="text" value="" size="50%" name="MANUAL_Cheque" class="swPrpTextField">                        </td>
                        <td class="swPrpCritExpandSel">                        </td>
                    </tr>
                    <tr id="criteria_TipoDeIngreso" class="swPrpCritLine">
                        <td class="swPrpCritTitle">
                            Tipo De Ingreso                        </td>
                        <td class="swPrpCritSel">
                            <select name="TipoDeIngreso" class="swPrpDropSelectRegular"><option value="" label=""></option><option value="1" label="DIEZMO">DIEZMO</option><option value="2" label="ESCUELA SABATICA ADULTOS">ESCUELA SABATICA ADULTOS</option><option value="3" label="13er SABADO">13er SABADO</option><option value="4" label="OFRENDA SUELTA CULTO DIVINO">OFRENDA SUELTA CULTO DIVINO</option><option value="5" label="FONDO DE INVERSION ADULTOS">FONDO DE INVERSION ADULTOS</option><option value="6" label="GRATITUD">GRATITUD</option><option value="7" label="GASTOS DE IGLESIA">GASTOS DE IGLESIA</option><option value="8" label="PLAN DE DADIVOSIDAD PERSONAL">PLAN DE DADIVOSIDAD PERSONAL</option><option value="9" label="CUMPLEA&Ntilde;OS">CUMPLEA&Ntilde;OS</option><option value="10" label="GRATITUD ANUAL">GRATITUD ANUAL</option><option value="11" label="ESCUELA SABATICA DIVISIONES INFANTILES">ESCUELA SABATICA DIVISIONES INFANTILES</option><option value="12" label="FONDO DE INVERSION DIVISIONES INFANTILES">FONDO DE INVERSION DIVISIONES INFANTILES</option><option value="13" label="CONSTRUCCION">CONSTRUCCION</option><option value="14" label="PRIMICIAS">PRIMICIAS</option><option value="15" label="RECOLECCION">RECOLECCION</option></select>                        </td>
                        <td class="swPrpCritExpandSel">                        </td>
                    </tr>
                    <tr id="criteria_NombreOfrendante" class="swPrpCritLine">
                        <td class="swPrpCritTitle">
                            Nombre Ofrendante                        </td>
                        <td class="swPrpCritSel">
                            <input type="text" value="" size="50%" name="MANUAL_NombreOfrendante" class="swPrpTextField">                        </td>
                        <td class="swPrpCritExpandSel">                        </td>
                    </tr>
                    <tr id="criteria_NombreOfrendante" class="swPrpCritLine">
                      <td class="swPrpCritTitle">Formato</td>
                      <td class="swPrpCritSel"><input type="radio" checked="" value="HTML" name="target_format" id="rpt_format_html">
                    HTML
                    <input type="radio" value="PDF" name="target_format" id="rpt_format_pdf">
                    PDF
                    <input type="radio" value="CSV" name="target_format" id="rpt_format_csv">
                    CSV </td>
                      <td class="swPrpCritExpandSel"></td>
                    </tr>
                    <tr id="criteria_NombreOfrendante" class="swPrpCritLine">
                      <td class="swPrpCritTitle">&nbsp;</td>
                      <td class="swPrpCritSel">&nbsp;</td>
                      <td class="swPrpCritExpandSel"></td>
                    </tr>
                </tbody></table>
<div id="swPrpSubmitPane" align="right">
	<input type="submit" value="Generar" name="submitPrepare" id="prepareAjaxExecute" class="prepareAjaxExecute swHTMLGoBox">
    <!--input type="submit" class="reporticoSubmit" name="clearform" value="Reset"-->
</div>
			</td>
			<td class="swPrpExpand" valign="top">
				<table class="swPrpExpandBox">
					<tbody><tr class="swPrpExpandRow">
						<td valign="top" rowspan="0" id="swPrpExpandCell">
<div style="float:right; ">
<!--a class="swLinkMenu" style="float:left;" href="/sai/reports/run.php?execute_mode=MENU&amp;session_name=koimuhkd99eipelbaj8ch3lem2_">&lt;&lt; Menu</a-->
</div>
<p>
Detalles del Reporte de Ingresos:<br>
1. Busqueda por Iglesia especifica.<br>
2. Busqueda por rango de fechas.<br>
3. Busqueda por numero de recibo interno.<br>
4. Busqueda por numero de Cheque.<br>
5. Busqueda por tipo de ingreso.<br>
6. Busqueda por nombre de ofrendante.
</p>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
			</tbody></table>
  </div>
</form>
