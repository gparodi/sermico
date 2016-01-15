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
  
 


<div id="tablaPartes">
<h2>Partes del vehiculo</h2>
<table id="tablaPartes"><thead><tr>
	<th class="headcol">ID</th><th>Nombre</th><th>Operacion</th>
	</tr></thead><tbody>
    
    </tbody>
</table>
</div>

<div id="tablaPartesDePartes">
<h2>Partes que componen partes</h2>
<table id="tablaPartesDePartes"><tr>
	<th>ID</th><th>Nombre</th>
	</tr>
</table>
</div>


<div id="tablaPartesMantenimientos">
<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><tr>
<th>ID</th><th>Nombre</th></tr>

</table>
</div>

<h2>Descripcion del mantenimiento</h2>
<form id="formAltaMatenimiento" action="" title="" method="post">
 <li> <label>Parte:</label>
 <input type="text" id="parteSeleccionada"/> </li>
 <li><label>Operacion:</label>
 <select id="operaciones"> 
 <option>Reparacion</option>
 <option>Cambio</option>
 <option>Revision</option>
  <option>Limpieza</option>
 </select>
 </li> 
 
  <li>  <label>Descripcion:</label> </li>
  <li>
 <textarea id="descripcion" rows="10" cols="40"></textarea> </li> 
 <li> <label>Observaciones:</label> </li>
 <li> <textarea id="observaciones" rows="10" cols="40"></textarea></li>


<li> <button id="submitParte" type="submit">Cargar</button> 
 <button id="submitFin" type="submit">Finalizar</button> </li>
</form>








<script>
$vehiculoActual=localStorage['vehiculo'];
$idMantenimiento=localStorage['idMantenimiento'];
var idTablaPartes=[];
var idTablaPartesDePartes=[];
var idParteActual=0;
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
			if(i==0){
				idParteActual=item.innerHTML;
			}
		}
		
    });
	$("#parteSeleccionada").val(values.toString());
	 
} );



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
	
	
	/*
	
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	var id;
    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		if(i==0){
				id=item.innerHTML;
			}
		
    
	});
	
	
	
	var  base=0,bandera=0;
	$("#tablaPartesDePartes tr td").each(function (indice,elemento) {
		if(base==indice){
			if(id==elemento.innerHTML){
				bandera=1;
			}
			base =parseInt(base)+3;
		}
	
	});	
	values +="<td><button class=\"deleteParte\">Quitar Parte</button></td>";
	values += '</tr>';
	if(bandera!=1){
		$("#tablaPartesDePartes tr:last").after(values);
	}
	
	
	
	loadTable("#tablaPartesDePartes tr:last","cargarTablaPartesDePartes",$vehiculoActual,'parte',$(this).html().toString());*/
	 
} );



$("#tablaPartesDePartes").on("click", ".addParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
			if(i==0){
				idTablaPartesDePartes.push(item.innerHTML);
			}
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
		if(i==0){
				idTablaPartes.push(item.innerHTML);
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
	
	values +="</td><td><button class=\"addParte\">Agregar Parte</button></td>";
	values += '</tr>';
	if(idTablaPartesDePartes.indexOf(idPartes)==-1){
		$("#tablaPartes tr:last").after(values);
	}else{
		$("#tablaPartesDePartes tr:last").after(values);
	}
	$(this).closest ('tr').remove ();
});

  

</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
