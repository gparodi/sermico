<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/x-icon" href="Imagenes/sermico.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SERMICO SRL</title>
 
 
<!-- InstanceEndEditable -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="Includes/JS_Cookies/jquery.cookie.js"></script>
<script type="text/javascript" src="Includes/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
<script type="text/javascript" src="Includes/js/jquery.leanModal.min.js"></script>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>
</head>


<body>
<div class="superior">
<?php include("Includes/Cabecera.php"); ?>
  <div class="header">
    <div class="clearfloat"></div>
    <?php include("Includes/Menu.php"); ?>
    
    <!-- end .header -->
  </div>

</div>
<div class="container">
    
  <!-- InstanceBeginEditable name="EditRegion2" -->

<span>Filtrar por:
<select id="comboBoxVechiculo"> </select>

</span>  
 
<div id="tablaVehiculos">

</div>


 <script>
 loadComboFromDB("#comboBoxVechiculo","cargarComboBoxTipos");
loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",null);
</script>
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
