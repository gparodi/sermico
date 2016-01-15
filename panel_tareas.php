<html>
<head>
<link href="Estilos/estilo_Template.css" rel="stylesheet" type="text/css"/>

</head>
<body>
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
<table id="tablaTarea"><thead><tr>
<th>ID</th><th>Titulo</th><th>Operacion</th><th>Descripcion</th></tr></thead><tbody></tbody>
</table>

<button id="btnBorrarTarea" type="button">Borrar tarea</button>



<script>

$(document).on({
    ajaxStart: function() { $("body").addClass("loading");    },
     ajaxStop: function() { $("body").removeClass("loading"); }    
});
$("#btnAgregarTarea").click(function(){
sendAjaxJson({tarea:"getVehiculo",idVehiculo:'01'},function(dato){
		$("#descripcionTarea").val(dato.idInterno);
	});
});
</script>
<div class="modalWait"><!-- Place at bottom of page --></div>
</body>
</html>