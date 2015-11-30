<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
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
  


<div id="tablaMantenimientos">

</div>


<script>

$vehiculoActual=0;
loadComboFromDB("#comboBoxVechiculoMantenimiento","cargarComboBoxVehiculos");

$("#comboBoxVechiculoMantenimiento").on('input', function () {
    var val = this.value;
    if($('option').filter(function(){
        return this.value === val;        
    }).length) {
        //send ajax request
		$vehiculoActual=this.value;
loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",$vehiculoActual);
}
});

 $.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:"cargarComboBoxTipos"},
	success: function(response) {
		$("#comboBoxFiltro").html(response);
		 var $tipo=$("#comboBoxFiltro").val();

 
 
$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:"getVehiculosPorTipo",tipo:$tipo},
	success: function(response) {
		$("#comboBoxVehiculo").html(response);
	},
	error: function(){
	alert('Error en combo');
	}
});	 
	 
	},
	error: function(){
	alert('Error en combo');
	}
	});

$("#comboBoxFiltro").on("input",function(){
	
    var $tipo=$("#comboBoxFiltro").val();
	$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"html",
		data: {tarea:"getVehiculosPorTipo",tipo:$tipo},
		success: function(response) {
			$("#comboBoxVehiculo").html(response);
			 var $vehiculo=$("#comboBoxVehiculo").val();
	 $.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'json',
	data: {tarea:"getKm",vehiculo:$vehiculo},
	timeout:5000,
	success: function(data, textStatus, jqXHR) {
		var kmAnterior=0;
		if(data.km!=null){
			kmAnterior=data.km;
		}
		$("#kmAnterior").val(kmAnterior);
		 
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
		},
		error: function(){
		alert('Error en combo');
		}
	});	

	
});

</script>

<!--
$("#tablas").on("click", ".add", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$("#mitabla2").append(values);
});

  
  <!--
deleteRow("#mitabla1","#mitabla2",".delete","#tablas");
addRowAtTableOnClick("#tablas","#mitabla",".add");
-->
  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
