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
  
 


<div id="tablaPartes">
<table id="tablaPartes"><tr>
	<th>ID</th><th>Nombre</th>
	</tr>
</table>
</div>
<!--
<div id="tablaPartesDePartes">
<table id="tablaPartesDePartes"><tr><th>
	<td>ID</td><td>Nombre</td></th>
	</tr>
    </table>
</div>
-->

<div id="tablaPartesMantenimientos">
<table id="tablaPartesMantenimientos"><tr>
<th>ID</th><th>Nombre</th></tr>

</table>
</div>


<div id="formularioMantenimientoPartes">

 <li> Parte:  <input type="text" id="parteSeleccionada"/> </li>
 <li> <label for="descripcion">Descripcion</label> <input type="text" id="descripcion"/> </li> 
 <li> <label for="observaciones">Observaciones</label> <input type="text" id="observaciones"></li>

<li>Operacion
 <input list="operacion" id="operaciones">
 <datalist id="operacion">
 <option value="Reparacion">
 <option value="Cambio">
 <option value="Revision">
 </datalist>
 </li>
<li> <button id="submitParte" type="submit">Cargar</button> </li>
 
  </ul> 

</div>








<script>
$vehiculoActual=localStorage['vehiculo'];
$idMantenimiento=localStorage['idMantenimiento'];
$(document).ready(function(e) {
	
    
    loadTable("#tablaPartes tr:last","cargarTablaPartes",$vehiculoActual,'parte');
	/*	
	var personaGuardada = localStorage.getItem("persona");
	var personaGuardada = JSON.parse(personaGuardada);
	var parte=localStorage.getItem("parte");
	alert(parte);*/
	
	
});


$('#tablaPartesMantenimientos').on( 'click', 'td', function (e) {
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = item.innerHTML ;
		}
		
    });
	$("#parteSeleccionada").val(values.toString());
	 
} );



$("#submitParte").on("click",this,function(e){
	

var $descripcion=$("#descripcion").val();
var $observacion=$("#observaciones").val();
var $operacion=$("#operaciones").val();
var $parte=$("#parteSeleccionada").val();

$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'html',
	data: {tarea:"altaPartesMantenimiento",descripcion:$descripcion,observaciones:$observacion,idPartes:$parte,idMantenimiento:$idMantenimiento,operacion:$operacion,vehiculo:$vehiculoActual},
	timeout:5000,
	success: function(data, textStatus, jqXHR) {
		
		if (confirm('¿Desea cargar otro mantenimiento?')){ 
       		$(location).attr('href','alta_mantenimiento.php');
    	}else{
			$(location).attr('href','mantenimiento.php');	
		}
		
		
		 
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});

});


/*
 
$('#tablaPartes').on( 'click', 'td', function (e) {
	loadTable("#tablaPartesDePartes tr:last","cargarTablaPartesDePartes",$vehiculoActual,'parte',$(this).html().toString());
	 
} );


/*
$("#mitabla1").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$("#mitabla2").append(values);
	$(this).closest ('tr').remove ();
});

$("#mitabla2").on("click",".delete", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$("#mitabla1").append(values);
	
	
	$(this).closest ('tr').remove ();
});
*/

$("#tablaPartesDePartes").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		
    });
	
	values +="<td><button class=\"deleteParte\">Quitar Parte</button></td>";
	values += '</tr>';
	$("#tablaPartesMantenimientos tr:last").after(values);
	$(this).closest ('tr').remove ();
});



$("#tablaPartes").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		
    });
	
	values +="<td><button class=\"deleteParte\">Quitar Parte</button></td>";
	values += '</tr>';
	$("#tablaPartesMantenimientos tr:last").after(values);
	$(this).closest ('tr').remove ();
});

$("#tablaPartesMantenimientos").on("click", ".deleteParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

     var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		
    });
	values +="</td><td><button class=\"addParte\">Agregar Parte</button></td>";
	values += '</tr>';
	$("#tablaPartes tr:last").after(values);
	$(this).closest ('tr').remove ();
});

  

//deleteRow("#mitabla1","#mitabla2",".delete","#tablas");
//addRowAtTableOnClick("#tablas","#mitabla",".add");

</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
