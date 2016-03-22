<html>
<head>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>

</div>
<div id="prueba">

</div>
<table id="tablaVehiculos"><thead><tr>
<th>Numero</th><th>Marca</th><th>Modelo</th><th>Patente</th><th>Año</th><th>Tipo</th><th>Kilometros</th><th>Estado</th></tr></thead><tbody></tbody>

</table>
<button id="btnAgregarVehiculo" type="button">Agregar</button>
<h3>Vehiculos incluidos en el plan de mantenimiento</h3>

<table id="tablaVehiculosPorPlan"><thead><tr>
    <th>Numero</th><th>Marca</th><th>Modelo</th><th>Año</th>
    </tr></thead><tbody></tbody>

</table>
<button id="btnQuitarVehiculo" type="button">Quitar</button>

<button id="btnAceptarVehiculosPlan" type="button">Aceptar</button>




<script>
var $planActual;
var $vehiculoActual=0;
var $vehiculoPlan=0;
var addFila;
$(document).on({
    ajaxStart: function() { $("body").addClass("loading");    },
     ajaxStop: function() { $("body").removeClass("loading"); }    
});
 
 //FILTRO

loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
		
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadTableFromDb("#tablaVehiculos","cargarTablaVehiculos",$tipo);
	
	
});


//---FIN FILTRo


$('#tablaVehiculos').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	addFila="<tr>";
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoActual=item.innerHTML;
			}
			if(i<=3){
				addFila=addFila+"<td>"+item.innerHTML+"</td>";
			}
	});
	addFila=addFila+"</tr>";
	$('tr.seleccionFila:first').removeClass("seleccionFila");
    			$(this).closest("tr").addClass("seleccionFila");
	
});

$("#btnQuitarVehiculo").on("click",this,function(){
	if($vehiculoPlan!=0){
		var rows=$("#tablaVehiculosPorPlan tbody").find('tr');
		var columns;
		rows.each(function(index, element) {
				columns=rows.find('td');
				columns.each(function(index, element) {
					if(element.innerHTML==$vehiculoPlan){
						element.closest('tr').remove();
						return false
					}
				});
			
    	});
		
	}
	
});


$('#tablaVehiculosPorPlan').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoPlan=item.innerHTML;
			}
	});
	$('tr.seleccionFila:first').removeClass("seleccionFila");
    			$(this).closest("tr").addClass("seleccionFila");
	
	
});

$("#btnAgregarVehiculo").on("click",this,function(){
	if($vehiculoActual!=0){
		var arrayTabla1=[];
		arrayTabla1=getTableIntoArray("#tablaVehiculosPorPlan");
		if($.inArray($vehiculoActual,arrayTabla1)==-1){
			$("#tablaVehiculosPorPlan > tbody:last").append(addFila);
		}
	}
	
});


$("#btnAceptarVehiculosPlan").on("click",this,function(){
	
	var data= getTableIntoJsonArray("#tablaVehiculosPorPlan");
	var tarea={tarea:"setVehiculoEnPlanMantenimiento"};
	var plan={planmantenimiento:$planActual};
	$.extend(tarea,data);
	$.extend(tarea,plan);
	$("#prueba").append(JSON.stringify(tarea));
	sendAjaxHtml(tarea,function(response){
		cerrarModal();
	});
	
		
});

function getTableIntoArray(nombreTabla){
	var rows=$(nombreTabla+" tbody").find('tr');
	var columns;
	var arrayTabla=[];
	rows.each(function(index, elementFila) {		
		$('td', $(this)).each(function(index, element) {
			arrayTabla.push(element.innerHTML);
		});
    });
	return arrayTabla;
}


function getTableIntoJsonArray(nombreTabla){
	var rows=$(nombreTabla+" tbody").find('tr');
	var columns;
	var arrayTabla=[];
	var headers = [];
	var i=0;
    $(nombreTabla+' th').each(function(index, item) {
        headers[index] = $(item).html();
    });
	rows.each(function(index, elementFila) {
		var arrayFila={};	
		$('td', $(this)).each(function(index, element) {
			arrayFila[headers[index]]=element.innerHTML;
		});
		arrayTabla.push(arrayFila);
		i++;
    });
	var numero={index:i};
	$.extend(arrayTabla,numero);
	
	
	return arrayTabla;
}



$(document).ready(function(e) {
	$planActual=localStorage['planActual'];
    loadTableFromDb("#tablaVehiculosPorPlan","listarVehiculosPorPlanDeMantenimiento",$planActual);
});


</script>
<div class="modalWait"><!-- Place at bottom of page --></div>
</body>
</html>