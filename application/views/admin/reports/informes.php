<h1 class="swTitle"><?php echo($title); ?></h1>
<form action="/sai/<?php //echo base_url();?>reports/sai-reports.php" method="POST" name="topmenu" id="criteriaform" class="swPrpForm" target="_blank">
  <input type="hidden" value="true" name="sai_reporte">
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
  <input type="hidden" value="FORM" name="target_style">
  <table id="critbody" class="swPrpCritBox">
    <tbody>
      <tr>
        <td>
        </td>
      </tr>
    </tbody>
  </table>
  <div id="criteriabody">
    <table cellpadding="0" class="swPrpCritBox">
      <!---->
      <tbody>
        <tr id="swPrpCriteriaBody">
          <td class="swPrpCritEntry">
            <table class="swPrpCritEntryBox">
              <tbody>
                <tr id="criteria_Fecha" class="swPrpCritLine">
                  <td class="swPrpCritTitle"> Fecha Inicio - Fecha Fin</td>
                  <td class="swPrpCritSel"><input type="hidden" value="2014-01-01" maxlength="0" size="0" name="HIDDEN_Fecha_FROMDATE">
                    <input type="text" value="2014-01-01" maxlength="20" size="20" name="MANUAL_Fecha_FROMDATE" id="swDateField_Fecha_FROMDATE" class="swDateField hasDatepicker">
                    &nbsp;-
                    <input type="hidden" value="2014-03-19" maxlength="0" size="0" name="HIDDEN_Fecha_TODATE">
                    <input type="text" value="2014-03-19" maxlength="20" size="20" name="MANUAL_Fecha_TODATE" id="swDateField_Fecha_TODATE" class="swDateField hasDatepicker">
                  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_PPlanDesarrollo" class="swPrpCritLine">
                  <td class="swPrpCritTitle"> Porcentaje Plan Desarrollo </td>
                  <td class="swPrpCritSel"><input type="text" value="20" size="5%" name="MANUAL_PPlanDesarrollo" class="swPrpTextField" readonly><b>&nbsp;%</b>
                  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_POfrendasMisioneras" class="swPrpCritLine">
                  <td class="swPrpCritTitle"> Porcentaje Ofrendas Misioneras </td>
                  <td class="swPrpCritSel"><input type="text" value="20" size="5%" name="MANUAL_POfrendasMisioneras" class="swPrpTextField" readonly><b>&nbsp;%</b>
                  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_POfrendaGlobalSeccion" class="swPrpCritLine">
                  <td class="swPrpCritTitle"> Porcentaje Ofrenda Global Seccion </td>
                  <td class="swPrpCritSel"><input type="text" value="40" size="5%" name="MANUAL_POfrendaGlobalSeccion" class="swPrpTextField" readonly><b>&nbsp;%</b>
                  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_POfrendaGlobalIglesia" class="swPrpCritLine">
                  <td class="swPrpCritTitle"> Porcentaje Ofrenda Global Iglesia </td>
                  <td class="swPrpCritSel"><input type="text" value="60" size="5%" name="MANUAL_POfrendaGlobalIglesia" class="swPrpTextField" readonly><b>&nbsp;%</b>
                  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_target_format" class="swPrpCritLine">
                  <td class="swPrpCritTitle">Formato</td>
                  <td class="swPrpCritSel"><input type="radio" checked="" value="HTML" name="target_format" id="rpt_format_html">
                    HTML
                    <input type="radio" value="PDF" name="target_format" id="rpt_format_pdf">
                    PDF
                    <!-- input type="radio" value="CSV" name="target_format" id="rpt_format_csv">
                    CSV -->
					</td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
                <tr id="criteria_POfrendaGlobalIglesia" class="swPrpCritLine">
                  <td class="swPrpCritTitle">&nbsp;</td>
                  <td class="swPrpCritSel">
					<!-- input type="checkbox" value="0" name="target_show_graph" -->
				  </td>
                  <td class="swPrpCritExpandSel"></td>
                </tr>
              </tbody>
            </table>
            <div id="swPrpSubmitPane" align="right">
              <input type="submit" value="Generar" name="submitPrepare" id="prepareAjaxExecute" class="prepareAjaxExecute swHTMLGoBox">
              <!--input type="submit" class="reporticoSubmit" name="clearform" value="Reset"-->
            </div></td>
          <td class="swPrpExpand" valign="top">
		  <table class="swPrpExpandBox">
              <tbody>
                <tr class="swPrpExpandRow">
                  <td valign="top" rowspan="0" id="swPrpExpandCell"><div style="float:right; ">
                      <!--a class="swLinkMenu" style="float:left;" href="/sai/reports/run.php?execute_mode=MENU&amp;session_name=te2meav6og72mhn9ak7d4l44c1_">&lt;&lt; Menu</a-->
                    </div>
                    <p> &nbsp;<br>
                      Informe de Diezmos y Ofrendas <br>
					  1. B&uacute;squeda por rango de fechas.
					</p></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
  </div>
</form>