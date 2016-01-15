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
<table id="tablaPartes"><tr>
	<th>ID</th><th>Nombre</th>
	</tr>
</table>
</div>

<div id="tablaPartesDePartes">
<h2>Partes que componen partes</h2>
<table id="tablaPartesDePartes"><tr>
	<th>ID</th><th>Nombre</th>
	</tr>
</table>
</div>




<h2>Descripcion de parte</h2>
<form id="formAltaPartes" action="" title="" method="post">

<li><label>Tipo:</label>
<select id="tipo">
<option>Parte</option>
<option>Accesorio</option>
<option>Insumo</option>
<option>Lubricante</option>
<option>Cubiertas</option>
</select></li>
<li><label>Nombre:</label>
<input id="nombre" type="text" /></li>
<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="40" rows="5"></textarea>

<li> <button id="submitParte" type="submit">Agregar</button> 
</form></li>


<script>



function agregarCampo(){
	var tipo=$("#tipo").val();
	var nuevoCampo="";
	if(tipo=='Parte'){
		
		
		
	}
	if(tipo=='Accesorio'){
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de colocacion:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaInicio\" class=\"agregado\" required /></li>";
		
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de vencimiento:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaFin\" class=\"agregado\" required /></li>";
			
		
	}
	if(tipo=='Insumo'){
		nuevoCampo+="<li><label class=\"agregado\" >Km de colocacion:</label>";
		nuevoCampo+="<input type=\"text\" id=\"kmColocacion\" class=\"agregado\" required /></li>";
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de colocacion:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaInicio\" class=\"agregado\" required /></li>";
		
		nuevoCampo+="<li><label class=\"agregado\" >Fecha de vencimiento:</label>";
		nuevoCampo+="<input type=\"date\" id=\"fechaFin\" class=\"agregado\" required /></li>";
			
		
	}
	$(".agregado").remove();
	$("#nombre").after(nuevoCampo);
	
	var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

$('#fechaInicio').val(today);
$('#fechaFin').val(today);
}

$("#tipo").on("change",function()
{
	agregarCampo();	
});

$(window).on("load",this,function(){
	agregarCampo();
	
});

$(document).ready(function(e) {
	
    
    loadTable("#tablaPartes tr:last","cargarTablaPartes",$vehiculoActual,'parte');
	
	
});



</script>  
  
  <!-- InstanceEndEditable -->
  <div class="footer">
      
      <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
