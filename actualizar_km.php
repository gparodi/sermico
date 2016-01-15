<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/x-icon" href="Imagenes/sermico.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SERMICO SRL</title>
 
 
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="Includes/Remodal-1.0.6/dist/remodal.css">
<link rel="stylesheet" href="Includes/Remodal-1.0.6/dist/remodal-default-theme.css">
</head>

<script src="Includes/Remodal-1.0.6/dist/remodal.min.js"></script>
<body>
<div class="superior">



    <?php include("Includes/Menu.php"); ?>
    
    <!-- end .header -->
  
</div>
<div class="container">
    
  <!-- InstanceBeginEditable name="EditRegion2" -->

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>
Vehiculo:
<select id="comboBoxVehiculo">Vehiculo: </select>
<p id="descripcionVehiculo"> </p>
</div>
 
<div id="actulizarKm">
<form id="formActualizarKm">
<li> Km anterior: <input type="text"  id="kmAnterior" readonly="readonly"/> </li>
<li> Km actual:  <input type="text" id="km"/> </li>
<li> <button id="submitKm" type="submit">Aceptar</button> </li>
</form>
</div>



 <script>
 
  //FILTRO
var $vehiculoActual;
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	cargarKm()
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	});
	
	
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	 cargarKm()
	 sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	});
	
	
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	$("#tablaMantenimiento").find("tr:gt(0)").remove();
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	cargarKm()
});
//---FIN FILTRO
 

function cargarKm(){
	
	
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(data){
		var kmAnterior=0;
		if(data.km!=null){
			kmAnterior=data.km;
		}
		$("#kmAnterior").val(kmAnterior);
	});
	
	
	
}
 
 
 $(document).ready(function(e) {
    



	 
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
				cleanForm("#formActualizarKm");
			},
			
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
