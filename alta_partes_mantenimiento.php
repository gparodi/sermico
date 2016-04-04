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
 




<h2>Partes del vehiculo</h2>

<h2>Componentes</h2>
<div id="filtros">Filtrar por:
<select id="comboBoxFiltroPartes"> </select>
</div> 

<table id="tablaPartes"><thead>
<th>ID</th><th>Nombre</th><th>Colocacion(Km)</th><th>Vencimiento(Km)</th><th>Vencimiento(Fecha)</th></thead><tbody></tbody></table>



<div id="tablaPartesMantenimientos">
<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><thead>
<th>ID</th><th>Nombre</th><th>Operacion</th><th>Detalles y Observaciones</th></thead>
<tbody>

</tbody>
</table>
</div>




<script>
$vehiculoActual=localStorage['vehiculo'];
$idMantenimiento=localStorage['idMantenimiento'];
var idTablaPartes=[];
var idTablaPartesDePartes=[];
var idParteActual=0;
var $tipoPartes;

$(document).ready(function(e) {
	
	//FILTRO PARTES
	loadComboFromDB("#comboBoxFiltroPartes","cargarComboBoxTiposPartes",function(){
	$tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaPartes","cargarTablaPartes",$tipoPartes,$vehiculoActual);
	
		
});

$("#comboBoxFiltroPartes").on("input",function(){	
	
    $tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaPartes","cargarTablaPartes",$tipoPartes,$vehiculoActual);
		
	
});


//---FIN FILTRO
   
	/*	
	var personaGuardada = localStorage.getItem("persona");
	var personaGuardada = JSON.parse(personaGuardada);
	var parte=localStorage.getItem("parte");
	alert(parte);*/
	
	
});


$('#tablaPartes').not("first").on( 'click', 'td', function (e) {
	
	$('tr.seleccionFila:first').removeClass("seleccionFila");
   	$(this).closest("tr").addClass("seleccionFila");
	
	
});

/*
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
	 
} );
*/


$("#formAltaMatenimiento").on("submit",this,function(e){
e.preventDefault();	

var $descripcion=$("#descripcion").val();
var $observacion=$("#observaciones").val();
var $operacion=$("#operaciones").val();
var $parte=$("#parteSeleccionada").val();

if($parte!=null){

$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'html',
	data: {tarea:"altaPartesMantenimiento",descripcion:$descripcion,observaciones:$observacion,idPartes:$parte,idMantenimiento:$idMantenimiento,operacion:$operacion,vehiculo:$vehiculoActual},
	timeout:5000,
	success: function(data, textStatus, jqXHR) {
		$("#tablaPartesMantenimientos").find("tr:contains("+idParteActual+")").remove();
		
		cleanForm("#formAltaMatenimiento");
		
		
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
	
}else{
	alert("Seleccione una parte del vehiculo");
}

});


$("#submitFin").on("click",this,function(e){
	if (confirm('¿Desea cargar otro mantenimiento?')){ 
    	$(location).attr('href','alta_mantenimiento.php');
    }else{
		$(location).attr('href','mantenimiento.php');	
	}
	
});



 /*
$('#tablaPartes').on( 'click', 'td', function (e) {
	
	var $idParte=$(this).closest('tr').find('td:eq(0)').html();

	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"html",
	data: {tarea:'cargarTablaPartesDePartes',atributo1:$vehiculoActual,atributo2:'null',atributo3:$idParte},
	success: function(response) {
		$("#tablaPartesDePartes").find("tr:gt(0)").remove();
		$("#tablaPartesDePartes tr:last").after(response);
	},
	error: function(){
	alert('Error!');
	}
	});
	
	
	
	 
} );*/

/*

$("#tablaPartesDePartes").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>";
			
			if(i==0){
				idTablaPartesDePartes.push(item.innerHTML);
			}
		}
		
    });
	
	values +="<td><button class=\"deleteParte\"><img src=\"Imagenes/add.png\" width=\"20\" height=\"20 \" /></button></td>";
	values += '</tr>';
	$("#tablaPartesMantenimientos tr:last").after(values);
	$(this).closest ('tr').remove ();
});

*/

$("#tablaPartes").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		if(i==0){
				idTablaPartes.push(item.innerHTML);
			}
		
    });
	
	values+="<td><select class=\"sltOperacion\"><option>Reparacion</option><option>Reparacion</option><option>Reparacion</option><option>Reparacion</option><option>Reparacion</option></select></td>";
	values +="<td><button class=\"detalleParte\"><img src=\"Imagenes/details.png\" width=\"20\" height=\"20 \" /></button></td>";
	values +="<td><button class=\"deleteParte\"><img src=\"Imagenes/minus.png\" width=\"20\" height=\"20 \" /></button></td>";
	
	values += '</tr>';
	$("#tablaPartesMantenimientos > tbody:last").append(values);
	$(this).closest ('tr').remove ();
});

$("#tablaPartesMantenimientos").on("click", ".deleteParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	var idPartes=0;
	
     var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
			if(i==0){
				idPartes=item.innerHTML;
			}
		}
		
    });
	
	$(this).closest ('tr').remove ();
});

  

</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
