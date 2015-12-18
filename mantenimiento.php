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
<script type="text/javascript" src="Includes/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
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
<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>
Vehiculo:
<select id="comboBoxVehiculo">Vehiculo: </select>
</div>
  
<h2>Mantenimientos realizados</h2>

<div id="tablaMantenimientos">

</div>


 <li><label>Proveedor:</label>
<input type="text" id="proveedor" readonly="readonly"/></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="60" row="20" readonly="readonly"></textarea></li>




<div id="tablaPartesMantenimientos">
<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><tr>
<th>ID</th><th>Nombre</th></tr>

</table>
</div>


<h2>Descripcion del mantenimiento</h2>
 <li> <label>Parte:</label>
 <input type="text" id="parteSeleccionada"/> </li>
 <li><label>Operacion:</label>
 <input type="text" id="operacion"/> </li>
 
  <li>  <label>Descripcion:</label> </li>
  <li>
 <textarea id="descripcion" rows="10" cols="40"></textarea> </li> 
 <li> <label>Observaciones:</label> </li>
 <li> <textarea id="observaciones" rows="10" cols="40"></textarea></li>


<div id="prueba">

</div>

<script>


loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",					$vehiculoActual);
	});
	
});


$('#tablaMantenimientos').on( 'click', 'td', function (e) {
	$("#descripcion").val("");
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
		if(i<=0){
        	values = item.innerHTML ;
			if(i==0){
				idParteActual=item.innerHTML;
			}
		}
		
    });
	
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'json',
	data: {tarea:'getMantenimiento',idMantenimiento:values},
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		$("#descripcion").val(data.descripcion);
		$("#proveedor").val(data.proveedor);
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});/*
	
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'html',
	data: {tarea:'getPartes',idMantenimiento:2,idVehiculo:1},
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		alert(data);
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});*/
	 
} );


$("#comboBoxFiltro").on("input",function(){
	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",					$vehiculoActual);
	});
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",					$vehiculoActual);
});

</script>


  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
