<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" /> 
<?php endforeach; ?>
    
<?php foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 12px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 12px;
}
a:hover
{
    text-decoration: underline;
}

.tbl-menu{border-collapse: collapse}
.tbl-menu td,.tbl-menu th {border: solid 1px #C2CBE0}
.tbl-menu td {padding: 5px;}
.tbl-menu td a{color: #000; text-decoration: underline;}
/*.btn-detalle{ border: solid 1px #c0c0c0; padding:3px;}*/
</style>
</head>
<body>
<!-- Beginning header -->
<h3 style="text-align:center">SISTEMA DE ADMINISTRACION DE IGLESIA V 0.0.1</h3>
    <div style="padding:0px;">
        <table width="100%" border="0" class="tbl-menu">
            <tr>                
                <th>IGLESIA</th>
                <th>PROCESOS</th>
                <th>CUENTAS</th>                
                <th>USUARIO</th>
            </tr>
            <tr>
                <td valign="top" width="25%">
                    <a href='<?php echo site_url('admin/catalogo/iglesia')?>'>Iglesias</a> &nbsp;| &nbsp;  
                    <a href='<?php echo site_url('admin/catalogo/iglesia_departamento')?>'>Departamentos</a> &nbsp;| &nbsp;
                    <a href='<?php echo site_url('admin/catalogo/persona')?>'>Persona</a> &nbsp;| &nbsp;
                    <a href='<?php echo site_url('admin/catalogo/persona_tipo')?>'>Persona Tipo</a> &nbsp;| &nbsp;
                    <a href='<?php echo site_url('admin/catalogo/ofrenda_tipo')?>'>Ofrenda Tipo</a> 
                </td>
                <td valign="top" width="25%">                    
                    <a href='<?php echo site_url('admin/ofrenda/anual')?>'>Proceso de Captura</a><br>

                </td>
                <td valign="top" width="25%">
                    <a href='<?php echo site_url('admin/catalogo/cuenta')?>'>Catalogo de cuenta</a> &nbsp;| &nbsp; 
                    <a href='<?php echo site_url('admin/catalogo/cuenta_tipo')?>'>Cuenta Tipo</a> &nbsp;| &nbsp; 
                    <a href='<?php echo site_url('admin/catalogo/cuenta_accion_tipo')?>'>Cuenta Accion Tipo</a> &nbsp;| &nbsp; 
                    <a href='<?php echo site_url('admin/catalogo/cuenta_actividad')?>'>Cuenta Actividad</a> &nbsp;| &nbsp; 
                    <a href='<?php echo site_url('admin/catalogo/gasto_tipo')?>'>Gastos tipo</a>
                </td>
                <td valign="top">
                    <a href='<?php echo site_url('app/logout')?>'>Salir del sitema</a><br>                    
                </td>
            </tr>
        </table>
         <?php /*|
        <a href='<?php echo site_url('main/customers_management')?>'>Customers</a> |
        <a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
        <a href='<?php echo site_url('examples/products_management')?>'>Products</a> | 
        <a href='<?php echo site_url('examples/film_management')?>'>Films</a> */?>
 
    </div>
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
        <?php echo $titulo;?>
        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div style="margin-top:40px; text-align: center; color: #2f96b4">
    Ejemplos del Grocery Crud
</div>
<!-- End of Footer -->
</body>
</html>