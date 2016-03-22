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
</div> 
  



<form id="formAltaMantenimiento" action="" title="" method="post">

 <li> <label> Proveedores</label>
 <input list="comboBoxProveedores" id="proveedores">
 <datalist id="comboBoxProveedores">
 </datalist>
 </li>
 
 <li> <label>Titulo</label> 
 <input type="text" id="titulo" placeholder="Cambio de aceite" required /> </li> 
 <li> <label>Fecha de Inicio</label> 
 <input type="date" id="fechaInicio" required /></li>
  <li> <label>Fecha de Fin</label> 
  <input type="date" id="fechaFin" required /></li> 
 <li> <label>Km</label> 
 <input type="text" id="km"  /> </li> 

<li> <label>Precio($)</label>
 <input type="text" id="precio" /> </li> 
 <li><label>Estado</label>
 <select  id="estados" > 
 <option>Realizado</option>
 <option>Programado</option>
 <option>En curso</option>
 </select>
 </li>
 
<li><label>Descripcion:</label>
<li><textarea id="descripcion" cols="60" row="20"></textarea></li>
 
 <li> <button id="submitMantenimiento" type="submit" onclick="altaMantenimiento()">Agregar Mantenimiento</button> </li> 
 
</form>

<div id="prueba">

</div>

<script>
$vehiculoActual=0;

		//loadTableFromDb("#tablaPartesDePartes","cargarTablaPartesDePartes",'1','parte','1');
$(document).ready(function(e) {
     

   
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
			$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"json",
		data: {tarea:"getVehiculo",idVehiculo:$vehiculoActual},
		success: function(data) {
			if(data.km!=null)
				$("#km").val(parseFloat(data.km));
			else
				$("#km").val("");
		},
		error: function(){
		alert('Error en combo');
		}
		});	

	
	
	});
	
});

$("#comboBoxFiltro").on("input",function(){
	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	
		$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"json",
		data: {tarea:"getVehiculo",idVehiculo:$vehiculoActual},
		success: function(data) {
			if(data.km!=null)
				$("#km").val(parseFloat(data.km));
			else
				$("#km").val("");
		},
		error: function(){
		alert('Error en combo');
		}
		});	
	});
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
			$.ajax({
		url: 'Includes/FuncionesDB.php',
		type: 'POST',
		dataType:"json",
		data: {tarea:"getVehiculo",idVehiculo:$vehiculoActual},
		success: function(data) {
			if(data.km!=null)
				$("#km").val(parseFloat(data.km));
			else
				$("#km").val("");
		},	
		error: function(){
		alert('Error en combo');
		}
		});	

});


//loadComboFromDB("#comboBoxVechiculoMantenimiento","cargarComboBoxVehiculos");
loadComboFromDB("#comboBoxProveedores","cargarComboBoxProveedores");

var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

$('#fechaInicio').val(today);
$('#fechaFin').val(today);




	
	
$("#formAltaMantenimiento").on("submit",this,function(e){	
e.preventDefault();
var $idMantenimiento;
var $proveedor=$("#proveedores").val();
var $titulo=$("#titulo").val();
var $fechaInicio=$("#fechaInicio").val();
var $fechaFin=$("#fechaFin").val();
var $km=$("#km").val();
var $precio=$("#precio").val();
var $estado=$("#estados").val();
var $vehiculo=$("#comboBoxVehiculo").val();
var $descripcion=$("#descripcion").val();


///,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado	

	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'json',
	data: {tarea:"altaMantenimiento",vehiculo:$vehiculo,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado,descripcion:$descripcion},
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		
		localStorage['vehiculo']=$vehiculo;
		localStorage['idMantenimiento']=data.id;
		var $idMantenimiento=data.id;
		
		if (confirm('¿Desea agregar multiples tareas al mantenimiento?')){ 
    		$(location).attr('href','alta_partes_mantenimiento.php');
    	}else{
			$.ajax({
				url: 'Includes/FuncionesDB.php',
				type: 'POST',
				async:true,
				dataType:'html',
				data: {tarea:"altaPartesMantenimiento",descripcion:"",observaciones:"",idPartes:"-",idMantenimiento:$idMantenimiento,operacion:"",vehiculo:$vehiculo},
				timeout:5000,
				success: function(data, textStatus, jqXHR) {
					$("#prueba").append(data);			
					
				},
				error: function( obj,text,error ){
					
				}
				});
			//$(location).attr('href','alta_mantenimiento.php');	
		}
		
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
 });
</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
