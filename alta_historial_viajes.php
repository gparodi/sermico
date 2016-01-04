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
<script type="text/javascript" src="Includes/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="Includes/Utilities.js"></script>
<script type="text/javascript" src="Includes/js/jquery.leanModal.min.js"></script>
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
  







<div id="formularioMantenimientoGral">


  <li> Km <input type="text" id="kmActual" required /></li>
  <li> Litros <input type="text" id="litros" required /></li>
  <li> Lugar <input type="text" id="lugar" required /></li>
  <li> Forma de pago <input list="comboBoxFormasDePago" id="formaDePago">
 <datalist id="comboBoxFormasDePago">
 <option>Efectivo</option>
 <option>Cheque</option>
 <option>Tarjeta</option>
 <option>TicketCard</option>
 </datalist>
 </li>
  <li> Promedio por tramo (km/l)<input type="text" id="promedioParcial" readonly="readonly"/></li>
 <li> <button id="agregar" type="button">Agregar carga</button> </li>  
</div>

<table id="tablaHistorialViajes">
	<tr><th>Km</th><th>Litros</th><th>Lugar</th><th>Forma de pago</th><th>Promedio Parcial</th></tr>


</table>
<li> Kilometros por viaje <input type="text" id="kmTotal" readonly="readonly" /></li>
 <li>Promedio total <input type="text" id="promedioTotal" readonly="readonly" /></li>

<script>
var $kmAnterior=0;
var $vehiculo;
var $kmTotales=0;
var $litrosTotales=0;
var $kmActual=0;
var $litros=0;
$(document).ready(function(e) {
    $.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	dataType:"json",
	data: {tarea:"getVehiculo",idVehiculo:"01"},
	success: function(data) {
		$vehiculo=data;
		$kmAnterior=parseFloat($vehiculo.km);
	},
	error: function(){
	alert('Error en combo');
	}
});	 
});

$("#kmActual").on("focusout",this,function(){
	$kmActual=parseFloat($("#kmActual").val());
	if($kmAnterior>$kmActual){
		alert("El kilometraje debe ser mayor al kilometraje anterior ("+$kmAnterior+")");
	$kmActual=0;
	}
		
	
});

$("#litros").on("focusout",this,function(){
	$litros=parseFloat($("#litros").val());
	if($kmActual!=0){
		var $promedioParcial=(($kmActual-$kmAnterior)/$litros).toFixed(2);
		$("#promedioParcial").val($promedioParcial);
		$kmTotales+=$kmActual-$kmAnterior;
	}
	
});

$("#agregar").on("click",this,function(){
	var $km=$("#kmActual").val();
	var $litros=$("#litros").val();
	var $lugar=$("#lugar").val();
	var $pago=$("#formaDePago").val();
	var $promedioParcial=$("#promedioParcial").val();
	var values;
	values ="<tr><td>"+$km+"</td>";
	values+="<td>"+$litros+"</td>";
	values+="<td>"+$lugar+"</td>";
	values+="<td>"+$pago+"</td>";
	values+="<td>"+$promedioParcial+"</td></tr>";
	$("#tablaHistorialViajes tr:last").after(values);
	$litrosTotales=parseFloat($litrosTotales)+parseFloat($litros);
	$kmAnterior=$km;
	$("#kmTotal").val($kmTotales);
	$("#promedioTotal").val(($kmTotales/$litrosTotales).toFixed(2));
	
});


</script>

<!--
$("#tablas").on("click", ".add", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr><td>';
    
    jQuery.each($columns, function(i, item) {
        values = values + item.innerHTML ;
    });
	
	values += '</tr>';
	$("#mitabla2").append(values);
});

  
  <!--
deleteRow("#mitabla1","#mitabla2",".delete","#tablas");
addRowAtTableOnClick("#tablas","#mitabla",".add");
-->
  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
