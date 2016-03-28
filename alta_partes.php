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

<div id="prueba2">

</div>

<div id="prueba">
<table  id="tablaPendientes">
<thead><th>ID</th><th>Nombre</th><th>Operacion</th></thead>
<tbody>
</tbody>
</table>


</div>
<script>

$.ajax({
	url: 'Includes/pendientes_mantenimiento.php',
	type: 'POST',
	dataType:"json",
	success: function(data){
		$("#tablaPendientes tr").each(function(index, element) {
            if(index!=0){
				$(this).remove();
			}
        });
		$.each(data,function(index,element){
		var boton="<button id=\"btnOperacion\">"
		if((element.tipo=="Documentacion")||(element.tipo=="Seguridad")){
			boton=boton+"Renovar"+"</button>";
		}else if((element.tipo=="Lubricantes")||(element.tipo=="Filtros")){
			boton=boton+"Cambiar"+"</button>";
		}
		$("#tablaPendientes > tbody:last").append("<tr><td>"+element.idpartes+"</td><td>"+element.nombre+"</td><td>"+boton+"</td></tr>");
		});
		
		
		
		
	},
	error: function(jqXHR, textStatus, errorThrown){
	alert(textStatus);
	}
	});

$("#tablaPendientes").on('click','#btnOperacion',function(){
	var idParte=$(this).parents('tr').find('td:first').text();
	var operacion=$(this).text();
	if(operacion=='Renovar'){
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);	
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
		sendAjaxHtml({tarea:'updatePartes',idPartes:idParte,fechaVencimiento:today,kmVencimiento:null});
	}else if(operacion=="Cambiar"){
		
	}
	$(this).closest('tr').remove();
	
});	


</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
