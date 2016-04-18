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
<p id="descripcionVehiculo"> </p>
</div>

<button id="btn_nuevoMantenimiento">Nuevo mantenimiento</button>
<button id="btn_nuevoPlanMantenimiento">Ejecutar mantenimiento</button>
<button id="btn_mantenimientoProgramado">Mantenimiento Programado</button>
  
<h2>Mantenimientos realizados</h2>

<div id="planes_mantenimiento" style="display:none">

</div>
<div id="mantenimiento_programados" style="display:none">

</div>

<table id="tablaMantenimientos"><thead>
	<th>ID</th><th>Titulo</th><th>Proveedor</th><th>KM</th><th>Fecha de Inicio</th>
    <th>Fecha de Fin</th><th>Horas</th><th>Precio($)</th><th>Estado</th>
	</thead><tbody>
    
    </tbody>
    
</table>

<div id="prueba">

</div>


<li><label>Proveedor</label></li><li> <input type="text" id="proveedor" readonly="readonly"/></li>
<li><label>Descripcion</label></li>
<li><textarea id="descripcion" cols="60" row="20" readonly="readonly"></textarea></li>


<button id="btnDetalles" style="display:none"> Ver detalles </button>

<div id="detallesMantenimiento" style="display:none">

<h2>Partes incluidas en el mantenimiento</h2>
<table id="tablaPartesMantenimientos"><thead>
	<th>ID</th><th>Nombre</th></thead>
    <tbody>
    </tbody>
</table>


<h2>Descripcion del mantenimiento</h2>
<form id="detallesParte" class="dataform">
 <li> <label>Parte</label></li><li><input type="text" id="parteSeleccionada" readonly="readonly"/></li>
 <li><label>Operacion</label></li><li><input type="text" id="operacionParte" readonly="readonly"/></li> 
  <li>  <label>Descripcion</label> </li>
  <li><textarea id="descripcionParte" rows="10" cols="40" readonly="readonly"></textarea> </li> 
 <li> <label>Observaciones</label> </li>
 <li> <textarea id="observacionesParte" rows="10" cols="40" readonly="readonly"></textarea></li>
</form>
</div>


<script>

 //FILTRO
var $vehiculoActual;
var estadoDetalle='A';
var datosPartes;
$(document).ready(function(e) {



$(document).ready(function(e) {
    var user=window.sessionStorage.getItem('user_name');
	var perfil=window.sessionStorage.getItem(user);
	//COMPARA CON EL ID DE LA VENTANA...SI ES CORRECTO LO DEJA ENTRAR
	var permiso=perfil&4;
	if(permiso==0){
		window.stop();
		alert("No tiene permisos para acceder a esta funcion");
		window.history.back();
	}
});


   

loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",$vehiculoActual);
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	});
	
	
});

$("#comboBoxFiltro").on("input",function(){	
	
    var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	 loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",$vehiculoActual);
	 sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	});
	
	
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	$("#tablaMantenimiento").find("tr:gt(0)").remove();
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	loadTableFromDb("#tablaMantenimientos","cargarTablaMantenimiento",					$vehiculoActual);
});
//---FIN FILTRO


$('#tablaMantenimientos :not(first)').on( 'click', 'td', function (e) {
	$("#descripcion").val("");
	var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
	$('tr.seleccionFila:first').removeClass("seleccionFila");
   	$(this).closest("tr").addClass("seleccionFila");
	jQuery.each($columns, function(i, item) {
		if(i<=0){
        	values = item.innerHTML ;
			if(i==0){
				idParteActual=item.innerHTML;
			}
		}
		cleanForm("#detallesParte");
    });
	
	function detallesMantenimiento(data){

		$("#descripcion").val(data.descripcion);
		$("#proveedor").val(data.proveedor);		
		
	}
	function verPartesPorMantenimiento(data){
		if(data.operacion=="OK"){
			if(!$("#detallesMantenimiento").is(":visible")){
				$("#btnDetalles").css({'display':'block'});		
				$("#btnDetalles").text("Ver detalles");
			}
			var size=Object.keys(data).length;
			datosPartes=data;
			$("#tablaPartesMantenimientos tr").each(function(index, element) {
                if(index!=0){
					$(this).remove();	
				}
            });
			$.each(data,function(index,element){
				if(index<size){
					
					$("#tablaPartesMantenimientos tbody:last").append("<tr><td>"+element.idPartes+"</td><td>"+element.nombre+"</td></tr>");
				}
			});
			
		}else{
			
			$("#btnDetalles").css({'display':'none'});
			$("#detallesMantenimiento").css({'display':'none'});
		}
		
		
	}
	
	sendAjaxJson({tarea:'getMantenimiento',idMantenimiento:values},detallesMantenimiento);
	
	sendAjaxJson({tarea:'getPartesPorMantenimiento',idMantenimiento:values},verPartesPorMantenimiento);
	
} );
	$("#btnDetalles").on("click",function(){
		if(estadoDetalle=='A'){
			$("#detallesMantenimiento").css({'display':'block'});
			$('html,body').animate({
			scrollTop: $("#detallesMantenimiento").offset().top
			}, 2000);
			estadoDetalle='D';
			$(this).text("Ocultar detalles");
		} else {
			$("#detallesMantenimiento").css({'display':'none'});
			estadoDetalle='A';
			$(this).text("Ver detalles");
		}
			
		
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
	$.each(datosPartes,function(index,element){
		if(element.idPartes==idParteActual){
			$("#descripcionParte").val(element.descripcion);
			$("#observacionesParte").val(element.observaciones);
			$("#operacionParte").val(element.operacion);
		}
	});
	 
} );

});
/*

 $("#btn_nuevoMantenimiento").on("click",this,function(){
	$("#nuevo_mantenimiento").css("display","block"); 
	 
 });
 
 $("#btn_mantenimientoProgramado").on("click",this,function(){
	$("#nuevo_mantenimiento").css("display","none");
	$("#mantenimiento_programados").css("display","block");
	mantenimientoProgramado();
	 
 });
 
 function mantenimientoProgramado(){
	sendAjaxHtml({tarea:'getMantenimientoProgramado','idVehiculo':$vehiculoActual},function(data){
		$("#mantenimiento_programados").empty();
		$("#mantenimiento_programados").append(data);
		
	});
 }
 
 $("#mantenimiento_programados").on("click","#btn_borrar_mp",function(){
	var idMantenimiento=$(this).parent().attr("id").toString(); 
	sendAjaxHtml({tarea:"borrar_mantenimiento","idMantenimiento":idMantenimiento},function(data){
		$("#prueba").append(data);
	});
	mantenimientoProgramado();
 });
 
 $("#mantenimiento_programados").on("click","#btn_ejecutar_mp",function(){
	var idMantenimiento=$(this).parent().attr("id").toString(); 
	sendAjaxHtml({tarea:"ejecutar_mantenimientoProgramado","idMantenimiento":idMantenimiento},function(data){
		$("#prueba").append(data);
	});
	mantenimientoProgramado();
 });
 
*/

</script>


  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
