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

<div id="filtros">Filtrar por:
<select id="comboBoxFiltro"> </select>
Vehiculo:
<select id="comboBoxVehiculo">Vehiculo: </select>
<p id="descripcionVehiculo"> </p>
</div>
 


<div>
<table id="tablaDocumentacion">
<th>ID</th><th>Nombre del documento</th><th>Otorgado</th><th>Vence</th><th>Descripcion</th>

</table>
</div>

<div id="prueba">

</div>

 <script>
 
 //FILTRO
var $vehiculoActual;
loadComboFromDB("#comboBoxFiltro","cargarComboBoxTipos",function(){
	var $tipo=$("#comboBoxFiltro").val();
	loadComboFromDBWithType("#comboBoxVehiculo","getVehiculosPorTipo",$tipo,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
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
	 loadTable("#tablaDocumentacion tr:last","cargarTablaDocumentacion",$vehiculoActual,'Documentacion');
	 sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	});
	
	
	
});

$("#comboBoxVehiculo").on("click",this,function(){
	$vehiculoActual=$("#comboBoxVehiculo").val();
	$("#tablaDocumentacion").find("tr:gt(0)").remove();
	sendAjaxJson({tarea:"getVehiculo",idVehiculo:$vehiculoActual},function(dato){
		$("#descripcionVehiculo").empty();
		$("#descripcionVehiculo").append(dato.marca + " " + dato.modelo +"/"+dato.año);
	});
	
	
	 loadTable("#tablaDocumentacion tr:last","cargarTablaDocumentacion",$vehiculoActual,'Documentacion');
});
//---FIN FILTRO
	

    $("#tablaDocumentacion").on("dblclick","td",function () {
		var th = $('#tablaDocumentacion th').eq($(this).index());
    if(th.text()!="ID"){
	var originalContent = $(this).text(); 
	$(this).addClass("cellEditing"); 
	$(this).html("<input type='text' value='" + originalContent + "' />"); 
	$(this).children().first().focus(); 
	$(this).children().first().keypress(function (e) { 
		if (e.keyCode == 13) { 
			var newContent = $(this).val(); 
			$(this).parent().text(newContent);
			$(this).parent().removeClass("cellEditing"); 
			
			if(originalContent!=newContent){
				var $nombre;
				var $descripcion;
				var $fechaInicio;
				var $fechaFin;
				var $id;
				$("#tablaDocumentacion td").each(function(index){
					if(index==0){
	                    $id=$(this).text();
					}
					if(index==1){
	                    $nombre=$(this).text();
					}
					if(index==2){
	                    $fechaInicio=$(this).text();
					}
					if(index==3){
	                    $fechaFin=$(this).text();
					}
					if(index==4){
	                    $descripcion=$(this).text();
					}
                });
				var dato={tarea:"modificarDocumentacion",idParte:$id,nombre:$nombre,fechaInicial:$fechaInicio,fechaVencimiento:$fechaFin,descripcion:$descripcion};
					$("#prueba").append(sendAjaxHtml(dato));
				
				
			}
		}
		}); 
			$(this).children().first().blur(function(){ 
				//$(this).parent().text(originalContent); 
				$(this).parent().removeClass("cellEditing"); 
			}); 
	}
	
});
	



</script>
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
