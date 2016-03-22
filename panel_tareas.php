<html>
<head>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div id="prueba">

</div>
<h3>Nueva tarea </h3>
<form id="formTareas">
<li><label>Titulo:</label>
<input type="text" id="tituloTarea"/></li>
<li><label>Operacion:</label>
<select id="operacionTarea">
<option>Cambio</option>
<option>Inspeccion</option>
<option>Rotacion</option>
<option>Reparacion</option>
</select></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcionTarea" cols="40" rows="5"></textarea></li>
</form>
<button id="btnAgregarTarea" type="button">Agregar tarea</button>
<h3>Tareas existentes </h3>
<table id="tablaTareas"><thead><tr>
<th>ID</th><th>Titulo</th><th>Operacion</th><th>Descripcion</th></tr></thead><tbody></tbody>
</table>

<button id="btnBorrarTarea" type="button">Borrar tarea</button>
<button id="btnAceptarTareasPlan" type="button">Aceptar</button>



<script>
var $planActual;
var $tareaActual=0;
$(document).on({
    ajaxStart: function() { $("body").addClass("loading");    },
     ajaxStop: function() { $("body").removeClass("loading"); }    
});
 

$(document).ready(function(e) {
	$planActual=localStorage['planActual'];
    loadTableFromDb("#tablaTareas","listar_tareas_por_planmantenimiento",$planActual);
});





$('#tablaTareas').not("first").on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
			if(i==0){
				$tareaActual=item.innerHTML;
			}
	});
	$('tr.seleccionFila:first').removeClass("seleccionFila");
    			$(this).closest("tr").addClass("seleccionFila");
	
	
});


$("#btnBorrarTarea").on("click",this,function(){
	if($tareaActual!=0){
		var rows=$("#tablaTareas tbody").find('tr');
		var columns;
		rows.each(function(index, element) {
				columns=rows.find('td');
				columns.each(function(index, element) {
					if(element.innerHTML==$tareaActual){
						element.closest('tr').remove();
						return false
					}
				});
			
    	});
		
	}
	
});



$("#btnAgregarTarea").on("click",this,function(){
	var titulo=$("#tituloTarea").val();
	var operacion=$("#operacionTarea").val();
	var descripcion=$("#descripcionTarea").val();
	
	sendAjaxHtml({tarea:'altaTarea',"titulo":titulo,"idPlanMantenimiento":$planActual,"descripcion":descripcion,"operacion":operacion},function(){
		
		loadTableFromDb("#tablaTareas","listar_tareas_por_planmantenimiento",$planActual);
	});
		
	
	
	
});


$("#btnAceptarTareasPlan").on("click",this,function(){
	
	var data= getTableIntoJsonArray("#tablaTareas");
	var tarea={tarea:"borrarTarea"};
	var plan={planmantenimiento:$planActual};
	$.extend(tarea,data);
	$.extend(tarea,plan);
	//$("#prueba").append(JSON.stringify(tarea));
	sendAjaxHtml(tarea,function(response){
		cerrarModalTareas();
		//$("#prueba").append(response);
		
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






</script>

<div class="modalWait"><!-- Place at bottom of page --></div>
</body>
</html>