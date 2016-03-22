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
  
<h2>Mantenimientos realizados</h2>



<table id="tablaMantenimientos"><tr>
	<td>ID</td><td>Titulo</td><td>Proveedor</td><td>KM</td><td>Fecha de Inicio</td>
    <td>Fecha de Fin</td><td>Horas</td><td>Precio($)</td><td>Estado</td>
	</tr>
    
</table>

<div id="prueba">

</div>


<li><label>Proveedor:</label> <input type="text" id="proveedor" readonly="readonly"/></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="60" row="20" readonly="readonly"></textarea></li>


<button id="botonDetalles" style="display:none"> Ver detalles </button>

<div id="detallesMantenimiento" style="display:none">

<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><tr>
	<th>ID</th><th>Nombre</th></tr>
</table>


<h2>Descripcion del mantenimiento</h2>
 <li> <label>Parte:</label><input type="text" id="parteSeleccionada"/></li>
 <li><label>Operacion:</label><input type="text" id="operacionParte"/></li> 
  <li>  <label>Descripcion:</label> </li>
  <li><textarea id="descripcionParte" rows="10" cols="40"></textarea> </li> 
 <li> <label>Observaciones:</label> </li>
 <li> <textarea id="observacionesParte" rows="10" cols="40"></textarea></li>

</div>


<script>

 //FILTRO
var $vehiculoActual;
var estadoDetalle=1;
var datosPartes;
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",$vehiculoActual);
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
	 loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",$vehiculoActual);
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
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",					$vehiculoActual);
});
//---FIN FILTRO


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
	
	function detallesMantenimiento(data){
		$("#descripcion").val(data.descripcion);
		$("#proveedor").val(data.proveedor);		
		//sendAjaxJson({tarea:'getPartesPorMantenimiento',idMantenimiento:"5"},verPartesPorMantenimiento);
	}
	function verPartesPorMantenimiento(data){
			
		if(data.operacion=="OK"){
			$("#botonDetalles").css({'display':'block'});		
			$("#botonDetalles").text("Ver detalles");
			var size=Object.keys(data).length;
			datosPartes=data;
			$("#tablaPartesMantenimientos tr").each(function(index, element) {
                if(index!=0){
					$(this).remove();	
				}
            });
			$.each(data,function(index,element){
				if(index<size){
					
					$("#tablaPartesMantenimientos tr:last").after("<tr><td>"+element.idPartes+"</td><td>"+element.nombre+"</td></tr>");
				}
			});
			
		}else{
			
			$("#botonDetalles").css({'display':'none'});
			$("#detallesMantenimiento").css({'display':'none'});
		}
		
		
	}
	
	sendAjaxJson({tarea:'getMantenimiento',idMantenimiento:values},detallesMantenimiento);
	sendAjaxJson({tarea:'getPartesPorMantenimiento',idMantenimiento:values},verPartesPorMantenimiento);
	
	$("#botonDetalles").on("click",this,function(){
		if($("#botonDetalles").text()=="Ver detalles"){
			$("#detallesMantenimiento").css({'display':'block'});
			estadoDetalle=0;
			$(this).text("Ocultar detalles");
		} else if(estadoDetalle==0){
			$("#detallesMantenimiento").css({'display':'none'});
			estadoDetalle=1;
			$(this).text("Ver detalles");
		}
			
		
	});
	
	 
} );

$('#tablaPartesMantenimientos').on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = item.innerHTML ;
			if(i==0){
				idParteActual=item.innerHTML;
			}
		}
		
    });
	$("#parteSeleccionada").val(values.toString());
	$.each(datosPartes,function(index,element){
		if(element.idPartes==idParteActual){
			$("#descripcionParte").val(element.descripcion);
		}
	});
	 
} );


</script>


  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
