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

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>
Vehiculo:
<select id="comboBoxVehiculo"> </select>
</div>
 
<div id="actulizarKm">
<li> Km anterior: <input type="text"  id="kmAnterior" readonly="readonly"/> </li>
<li> Km actual:  <input type="text" id="km"/> </li>
<li> <button id="submitKm" type="submit">Aceptar</button> </li>
</div>



 <script>
 $(document).ready(function(e) {
    

// loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos");
 
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

$("#comboBoxVehiculo").on("input",function(){
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
		$("#km").val("");
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
	
});

	 
 $("#submitKm").on("click",this,function(){
	var $kmActual=parseInt($("#km").val());
	var $kmAnterior=parseInt($("#kmAnterior").val());
	if($kmAnterior>$kmActual){
		alert("El kilometraje debe ser mayor que el km anterior");
	}else{
		var $vehiculo=$("#comboBoxVehiculo").val();
		 $.ajax({
			url: 'Includes/FuncionesDB.php',
			type: 'POST',
			async:true,
			dataType:'html',
			data: {tarea:"actulizarKm",vehiculo:$vehiculo,km:$kmActual},
			timeout:5000,
			success: function(data, textStatus, jqXHR) {
				
			},
			error: function( obj,text,error ){
				alert(text);
			}
			});	
	}
	 
 });
    
	
});
</script>
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
