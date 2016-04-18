<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting"><!-- InstanceBegin template="/Templates/Template_Base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/x-icon" href="Imagenes/sermico.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SERMICO SRL</title>
<script src="Includes/JSON-js-master/json2.js"></script>
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
<p id="descripcionVehiculo"> </p>
</div>
  

<div id="nuevo_mantenimiento">
<form id="formAltaMantenimiento">

 <li> <label> Proveedor</label>
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
 
<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="60" row="20"></textarea></li>
 
 <li> <button id="btnSubmitMantenimiento" type="submit" onclick="altaMantenimiento()">Cargar</button> </li> 
 
</form>
</div>



<div id="detalleMantenimiento" style="display:none">


<h2>Componentes</h2>
<div id="filtros">Filtrar por:
<select id="comboBoxFiltroPartes"> </select>
</div> 

<table id="tablaPartes"><thead><tr>
<th>ID</th><th>Nombre</th><th>Colocacion(Km)</th><th>Vencimiento(Km)</th><th>Vencimiento(Fecha)</th></tr>
</thead><tbody></tbody></table>



<div id="tablaPartesMantenimientos">
<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><thead><tr>
<th>ID</th><th>Nombre</th><th>Operacion</th><th>Detalles y Observaciones</th></tr></thead>
<tbody>

</tbody>
</table>
</div>
</div>

<div id="detalles_Modal" style="display:none">
<form id="form_detalles_partes" action="#">
<li><label>Descripcion</label></li>
<li><textarea id="descripcionParte" rows="5" cols="30"></textarea></li>

<li><label>Observaciones</label></li>
<li><textarea id="observacionesParte" rows="5" cols="30"></textarea></li>

<button type="submit" id="btnDetallesPartes">Aceptar</button>

</form>
 	
</div>
<button id="btnCommit" style="display:none">Cargar</button>
<div id="prueba">

</div>

<script>
 
var $vehiculoActual;
var $tipoPartes;
var mantenimiento=[];
var detalles=[];
var parteActual;


		
$(document).ready(function(e) {
	
	
$(document).ready(function(e) {
    var user=window.sessionStorage.getItem('user_name');
	var perfil=window.sessionStorage.getItem(user);
	//COMPARA CON EL ID DE LA VENTANA...SI ES CORRECTO LO DEJA ENTRAR
	var permiso=perfil&8;
	if(permiso==0){
		window.stop();
		alert("No tiene permisos para acceder a esta funcion");
		window.history.back();
	}
});
	
	

//FILTRO
loadComboFromDB("#comboBoxProveedores","cargarComboBoxProveedores");
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
		$("#km").val(dato.km);
	});
	});
	
	
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	 sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
		$("#km").val(dato.km);
	});
	});
	
	
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	$("#tablaMantenimiento").find("tr:gt(0)").remove();
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
		$("#km").val(dato.km);
	});
	
});
//---FIN FILTRO 






function cargarDetallesMantenimiento(){
	$("#detalleMantenimiento").css("display","block");
	loadComboFromDB("#comboBoxFiltroPartes","cargarComboBoxTiposPartes",function(){	
		$tipoPartes=$("#comboBoxFiltroPartes").val();
		loadTableFromDb("#tablaPartes","cargarTablaPartes",$tipoPartes,$vehiculoActual);
		$('html,body').animate({
			scrollTop: $("#detalleMantenimiento").offset().top
		}, 2000);
	});
	
}



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
$("#btnCommit").css("display","block");
$("#btnSubmitMantenimiento").css("display","none");
	
	mantenimiento={tarea:"altaMantenimiento",nuevoMantenimiento:[{vehiculo:$vehiculo,titulo:$titulo,proveedor:$proveedor,fechaInicio:$fechaInicio,fechaFin:$fechaFin,km:$km,precio:$precio,estado:$estado,descripcion:$descripcion}],partes:[]};
	cargarDetallesMantenimiento();

	
	
	
});

 function altaProveedor(){
	var $proveedor=$("#proveedores").val();
	if($proveedor!=""){
		sendAjaxHtml({tarea:"altaProveedorSimple",nombre:$proveedor},function(data){
			$("#prueba").append(data);});
	}
	return;
 }
 

 





	
	//FILTRO PARTES
	

$("#comboBoxFiltroPartes").on("input",function(){	
	
    $tipoPartes=$("#comboBoxFiltroPartes").val();
	loadTableFromDb("#tablaPartes","cargarTablaPartes",$tipoPartes,$vehiculoActual);
		
	
});


//---FIN FILTRO



   


$("#tablaPartes").on("click", ".addParte", function(){

	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

    var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
		}
		
    });
	
	values+="<td><select class=\"sltOperacion\"><option>Cambio</option><option>Reparacion</option><option>Limpieza</option><option>Inspeccion</option><option>Renovacion</option></select></td>";
	values +="<td><button class=\"detalleParte\"><img src=\"Imagenes/details.png\" width=\"20\" height=\"20 \" /></button></td>";
	values +="<td><button class=\"deleteParte\"><img src=\"Imagenes/minus.png\" width=\"20\" height=\"20 \" /></button></td>";
	
	values += '</tr>';
	$("#tablaPartesMantenimientos > tbody:last").append(values);
	$(this).closest ('tr').remove ();
});




$("#tablaPartesMantenimientos").on("click", ".deleteParte", function(){
	
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	var idPartesDelete=0;
	
     var values = '<tr>';
    jQuery.each($columns, function(i, item) {
		if(i<=1){
        	values = values +"<td>"+ item.innerHTML + "</td>" ;
			if(i==0){
				idPartesDelete=item.innerHTML;
			}
		}
		
    });
	$.each(detalles,function(index,item){
		if(idPartesDelete==item.idPartes){
			detalles.splice(index,1);	
		}
		//alert(detalles.index.descripcion);
	});
	$(this).closest ('tr').remove ();
});

$("#tablaPartesMantenimientos").on("click", ".detalleParte", function(){

	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');

   
    jQuery.each($columns, function(i, item) {
		if(i==0){
        	parteActual=item.innerHTML;
		}
		
		
    });
	$("#descripcionParte").val("");
	$("#observacionesParte").val("");
	$('#detalles_Modal').dialog({
			 resizable: false,
			 title: "Agregar detalles a mantenimiento",
			  height:500,
			  width:900,
			  modal: true,
      		
    	});
	
});

function cerrarModalPartes(){
	$("#detalles_Modal").dialog("close");
}

$("#form_detalles_partes").on("submit",this,function(e){
	e.preventDefault();
	var descripcion=$("#descripcionParte").val();
	var observaciones=$("#observacionesParte").val();
	cerrarModalPartes();
	detalles.push({idPartes:parteActual,descripcion:descripcion,observaciones:observaciones});
	
	
	
});

$("#btnCommit").on("click",this,function(){
	var id;
	var operacion;
	$("#tablaPartesMantenimientos tbody tr").each(function(index, element) {
    	$(element).children("td").each(function(i, item) {
			switch(i){
            	case 0:
						id=item.innerHTML;
				break;
				case 2:
						operacion=$(item).children("select").val();
				break;
			}  		
				
			
        });
		if(detalles.length!=0){
		$.each(detalles,function(j,item1){
			if(id==item1.idPartes){
			mantenimiento.partes.push({idPartes:id,operacion:operacion,descripcion:item1.descripcion,observaciones:item1.observaciones});	
			}else{
				mantenimiento.partes.push({idPartes:id,operacion:operacion,descripcion:null,observaciones:null});
			}
			});
		}
		else{
			mantenimiento.partes.push({idPartes:id,operacion:operacion,descripcion:null,observaciones:null});
		}
	});
	altaProveedor();
	sendAjaxHtml(mantenimiento,function(data){
		$("#prueba").append(data);
	});
	
	//$(location).attr('href','alta_mantenimiento.php');
		
    });
	
	


});

</script>  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
