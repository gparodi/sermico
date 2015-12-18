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
<button type="button" id="boton"> Probar </button>

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>
Vehiculo:
<select id="comboBoxVehiculo">Vehiculo: </select>
</div> 
  



<form id="formAltaPlanMantenimiento" action="" title="" method="post">

  
 <li> <label>Titulo:</label> 
 <input type="text" id="titulo" placeholder="Cambio de aceite" required /> </li> 
 <h3> Criterio de mantenimiento </h3>
 
<p>Por kilometros</p>
 
 <li> <label>Kilometros:</label> 
 <input type="text" id="km"  /> </li> 
 
 <p>Por tiempo</p>
  <li> <label>Horas:</label> 
 <input type="text" id="horas"  /> </li> 
 
 <li> <label>Dias:</label> 
 <input type="text" id="dias"  /> </li> 
 
 <li> <label>Meses:</label> 
 <input type="text" id="meses"  /> </li>
 
 <li> <label>Años:</label> 
 <input type="text" id="años"  /> </li>  

 
<li><label>Descripcion:</label>
<li><textarea id="descripcion" cols="60" row="20"></textarea></li>
 
 <li> <button id="submitMantenimiento" type="submit" onclick="altaMantenimiento()">Agregar Mantenimiento</button> </li> </ul> 

</form>

<script>
$vehiculoActual=0;


$("#boton").on("click",this,function(){
	$.ajax({
		url: 'Includes/mailSender.php',
		type: 'POST',
		dataType:"html",
		data: {tarea:"getVehiculo"},
		success: function(data) {
			alert(data);
		},
		error: function(){
		alert('Error en combo');
		}
		});
	
});
		//loadTableFromDb("#tablaPartesDePartes","cargarTablaPartesDePartes",'1','parte','1');
$(document).ready(function(e) {
     	



   
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
			$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"json",
		data: {tarea:"getVehiculo",idVehiculo:$vehiculoActual},
		success: function(data) {
				
		},
		error: function(){
		alert('Error en combo');
		}
		});	

	
	
	});
	
});

$("#comboBoxFiltro").on("input",function(){
	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	
		$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"json",
		data: {tarea:"getVehiculo",idVehiculo:$vehiculoActual},
		success: function(data) {
			
		},
		error: function(){
		alert('Error en combo');
		}
		});	
	});
	
});






$("#formAltaPlanMantenimiento").on("submit",this,function(e){	
e.preventDefault();



	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'json',
	data: {tarea:"altaMantenimiento",vehiculo:$vehiculo,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado,descripcion:$descripcion},
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		
		localStorage['vehiculo']=$vehiculo;
		localStorage['idMantenimiento']=data.id;
		/*
		var persona = {
   		 nombre: "pepe",
    	 edad: 20,
    	 locura: true
		};
		var personaAGuardar = JSON.stringify(persona);

		localStorage.setItem("persona", personaAGuardar);*/
		
		
		$(location).attr('href','alta_partes_mantenimiento.php'); 
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
	
	
	
});

 
 });
</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
