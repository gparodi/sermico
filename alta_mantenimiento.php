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
  
<span>Vehiculo
<select id="comboBoxVechiculoMantenimiento">Vehiculo: </select>

</span>  
  


<div id="tablaPartes">

</div>






<div id="formularioMantenimientoGral">


 <li>Proveedor: 
 <input list="comboBoxProveedores" id="proveedores">
 <datalist id="comboBoxProveedores">

 </datalist>
 </li>
 
 <li> <label for="name">Titulo</label> <input type="text" id="titulo" placeholder="Cambio de aceite" required /> </li> 
 <li> <label for="fechaInicio">Fecha de Inicio</label> <input type="date" id="fechaInicio" required /></li>
  <li> <label for="fechaFin">Fecha de Fin</label> <input type="date" id="fechaFin" required /></li> 
 <li> <label for="km">Km</label> <input type="text" id="km"  required /> </li> 

<li> <label for="precio">Precio($)</label> <input type="text" id="precio"  required /> </li> 
 <li>Estado
 <input list="estado" id="estados">
 <datalist id="estado">
 <option value="Realizado">
 <option value="Programado">
 <option value="En curso">
 </datalist>
 </li>
 
 <li> <button id="submitMantenimiento" type="submit" onclick="altaMantenimiento()">Añadir Mantenimiento</button> </li> </ul> 
</div>



<script>
$vehiculoActual=0;

		//loadTableFromDb("#tablaPartesDePartes","cargarTablaPartesDePartes",'1','parte','1');
   



loadComboFromDB("#comboBoxVechiculoMantenimiento","cargarComboBoxVehiculos");
loadComboFromDB("#comboBoxProveedores","cargarComboBoxProveedores");

var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

$('#fechaInicio').val(today);
$('#fechaFin').val(today);



$("#submitMantenimiento").on("click",this,function(e){
	
var $idMantenimiento;
var $proveedor=$("#proveedores").val();
var $titulo=$("#titulo").val();
var $fechaInicio=$("#fechaInicio").val();
var $fechaFin=$("#fechaFin").val();
var $km=$("#km").val();
var $precio=$("#precio").val();
var $estado=$("#estados").val();
var $vehiculo=$("#comboBoxVechiculoMantenimiento").val();

///,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado	

	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'json',
	data: {tarea:"altaMantenimiento",vehiculo:$vehiculo,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado},
	timeout:10000,
	success: function(data, textStatus, jqXHR) {
		
		localStorage['vehiculo']=$vehiculo;
		localStorage['idMantenimiento']=data.id;
		
		var persona = {
   		 nombre: "pepe",
    	 edad: 20,
    	 locura: true
		};
		var personaAGuardar = JSON.stringify(persona);

		localStorage.setItem("persona", personaAGuardar);
		
		
		$(location).attr('href','alta_partes_mantenimiento.php'); 
	},
	error: function( obj,text,error ){
		alert(text);
	}
	});
	
	
	
});

 $("#proveedores").on("focusout",this,function(e){
	var $proveedor=$(this).val();
	if($proveedor!=""){
		$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		async:true,
		dataType:'html',
		data: {tarea:"altaProveedorSimple",nombre:$proveedor}
		});
	}
 });
 



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


  

//deleteRow("#mitabla1","#mitabla2",".delete","#tablas");
//addRowAtTableOnClick("#tablas","#mitabla",".add");

</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
