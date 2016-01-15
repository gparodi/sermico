<html>
<head>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>

</div>

<table id="tablaVehiculos"><thead><tr>
<th>Numero</th><th>Marca</th><th>Modelo</th><th>Patente</th><th>Año</th><th>Tipo</th><th>Kilometros</th><th>Estado</th></tr></thead><tbody></tbody>

</table>
<h3>Vehiculos incluidos en el plan de mantenimiento</h3>

<table id="tareasPorPlan"><thead><tr>
    <th>ID</th><th>Titulo</th><th>Operacion</th><th>Descripcion</th>
    </tr></thead><tbody></tbody>

</table>


<script>

$(document).on({
    ajaxStart: function() { $("body").addClass("loading");    },
     ajaxStop: function() { $("body").removeClass("loading"); }    
});
var $vehiculoActual=0;
 
 //FILTRO
var $vehiculoActual;
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
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$vehiculoActual=item.innerHTML;
			}
	});
	$('tr.seleccionFila:first').removeClass("seleccionFila");
    			$(this).closest("tr").addClass("seleccionFila");
	
	
});


</script>
<div class="modalWait"><!-- Place at bottom of page --></div>
</body>
</html>