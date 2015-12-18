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
  
 



<form id="formAltaVehiculo" action="" title="" method="post">

<li><label>Tipo:</label>
<select id="tipo">
<option>Camioneta</option>
<option>Camión</option>
<option>Manipulador Telescopico</option>
<option>Minibus</option>
<option>Semi Remolque</option>
</select></li>

<li><label>Numero:</label>
<input id="numero" type="text" /></li>

<li><label>Marca:</label>
<input id="marca" type="text" /></li>

<li><label>OT:</label>
<input id="ot" type="text" /></li>


<li><label>Modelo:</label>
<input id="modelo" type="text" /></li>

<li><label>Patente:</label>
<input id="patente" type="text" /></li>

<li><label>Kilometros:</label>
<input id="km" type="text" /></li>

<li><label>Año:</label>
<input id="año" type="text" /></li>

<li><label>Modelo de motor:</label>
<input id="modeloMotor" type="text" /></li>

<li><label>Codigo de motor:</label>
<input id="motor" type="text" /></li>

<li><label>Numero de chasis:</label>
<input id="chasis" type="text" /></li>

<li><label>Consumo promedio:</label>
<input id="consumo" type="text" /></li>

<li><label>Combustible:</label>
<select id="combustible">
<option>Gasoil grado 2</option>
<option>Nafta grado 2</option>
<option>Gasoil grado 3</option>
<option>Nafta grado 3</option>
</select></li>


<li><label>Descripcion:</label></li>
<li><textarea id="descripcion" cols="40" rows="5"></textarea>

<li> <button id="submitParte" type="submit">Agregar</button> 
</form></li>

<div id="result">

</div>

<script>

$("#formAltaVehiculo").on("submit",this,function(e){
	e.preventDefault();
	var $tipo=$("#tipo").val();
	var $numero=$("#numero").val();
	var $año=$("#año").val();
	var $combustible=$("#combustible").val();
	var $consumo=$("#consumo").val();
	var $descripcion=$("#descripcion").val();
	var $km=$("#km").val();
	var $marca=$("#marca").val();
	var $modelo=$("#modelo").val();
	var $modeloMotor=$("#modeloMotor").val();
	var $motor=$("#motor").val();
	var $ot=$("#ot").val();
	var $patente=$("#patente").val();
	var $chasis=$("#chasis").val();
	
	var datos={tarea:"altaVehiculo",tipo:$tipo,numero:$numero,año:$año,combustible:$combustible,consumo:$consumo,descripcion:$descripcion,km:$km, marca:$marca, modelo:$modelo,modeloMotor:$modeloMotor, motor:$motor, ot:$ot, patente:$patente,chasis:$chasis};
	$.ajax({
	url: 'Includes/FuncionesDB.php',
	type: 'POST',
	async:true,
	dataType:'html',
	data: datos,
	timeout:1000,
	success: function(data, textStatus, jqXHR) {
		$("#result").append(data);
	},
	error: function( obj,text,error ){
		alert(text);
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
